<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Brand;



class DiscountController extends Controller
{
    public function store(Request $request)
    {
        $cart = auth()->user()->cart;
        $products = $cart->products;

        // Busca el cupón de descuento en la base de datos basado en el código proporcionado en la solicitud
        $discountcode = Discount::where("code", $request->discount_code)->first();

        if (!$discountcode) {
            return redirect()->route("cart.viewShipping")->withErrors("Invalid coupon code. Please try again.");
        }

        $subtotal = $cart->subtotal();
        $totalPrice = $subtotal;

        // Verifica si el cupón es de tipo 'category'
        if ($discountcode->type === 'category') {
            $categoryDiscountApplicable = false;

            foreach ($products as $product) {
                // Verifica si el descuento está asociado a un id_marca que coincida con el id_marca del producto
                if ($discountcode->brand_id === $product->brand_id) {
                    // El producto es de la marca correspondiente al cupón
                    $categoryDiscountApplicable = true;

                    // Calcula el descuento para el producto
                    $discountValue = $product->price * ($discountcode->value / 100);
                    $totalPrice -= $discountValue;
                }
            }

            // Almacena la información del descuento y el precio total en la sesión
            if ($categoryDiscountApplicable) {
                session()->put("discount", [
                    "name" => $discountcode->code,
                    "discount_value" => $discountValue,
                ]);
                session()->put('totalPrice', $totalPrice);

                return redirect()->route("cart.viewShipping")->with("mensaje", "Category Coupon has been applied!");
            }
        } else {
            // Es un cupón simple que se aplica a todo el carrito
            $discountValue = $totalPrice * ($discountcode->value / 100);
            $totalPrice -= $discountValue;

            // Almacena la información del descuento y el precio total en la sesión
            session()->put("discount", [
                "name" => $discountcode->code,
                "discount_value" => $discountValue,
            ]);
            session()->put('totalPrice', $totalPrice);

            return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been applied!");
        }

        // Si no se aplicó ningún descuento, redirige sin cambios
        return redirect()->route("cart.viewShipping");
    }

    public function destroy(Request $request)
    {
        session()->forget("discount");

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been removed.");
    }



    public function index()
    {
        // Puedes pasar listas de productos o marcas si los necesitas para los formularios
        $brands = Brand::all();
        $products = Product::all();

        return view('discount', compact('brands', 'products'));
    }

    public function storeSimple(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'code' => 'required|string|max:255',
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_users' => 'required|integer'
        ]);

        // Creación del nuevo descuento
        Discount::create([
            'code' => $request->code,
            'type' => 'simple', // Asumiendo que tienes un campo 'type' en tu modelo Discount
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
            // Asegúrate de agregar cualquier otro campo necesario según tu modelo Discount
        ]);

        // Redirección con mensaje de éxito
        return back()->with('success', 'Cupón creado con éxito.');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'value' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id', // Asegúrate de que la categoría exista
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_users' => 'required|integer',
        ]);

        Discount::create([
            'code' => $request->code,
            'type' => 'category', // Asegúrate de manejar este tipo en tu lógica de aplicación
            'value' => $request->value,
            'category_id' => $request->category_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);

        return back()->with('success', 'Cupón de categoría creado con éxito.');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'value' => 'required|numeric',
            'product_id' => 'required|integer|exists:products,id', // Verifica que el producto exista
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_users' => 'required|integer',
        ]);

        $discount = Discount::create([
            'code' => $request->code,
            'type' => 'product', // Asegúrate de manejar este tipo en tu lógica
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);

        // Asocia el descuento con el producto específico
        $discount->products()->attach($request->product_id);

        return back()->with('success', 'Cupón para producto específico creado con éxito.');
    }
}
