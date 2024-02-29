<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function store(Request $request)
    {
        $cart = auth()->user()->cart;
        $products = $cart->products;

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
        $brands = Brand::all(); // Obtiene todas las marcas
        $products = Product::all(); // Obtiene todos los productos
        $discounts = Discount::all(); // Obtiene todos los descuentos

        return view('discounts.discount', compact('brands', 'products', 'discounts'));
    }

    public function show()
    {
        $brands = Brand::all(); // Obtiene todas las marcas
        $products = Product::all(); // Obtiene todos los productos
        $discounts = Discount::all(); // Obtiene todos los descuentos

        return view('discounts.creatediscount', compact('brands', 'products', 'discounts'));
    }

    public function storeSimple(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_users' => 'required|integer'
        ]);

        Discount::create([
            'code' => $request->code,
            'type' => 'simple',
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);
        return back()->with('success', 'Coupon successfully created.');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:discounts,code',
            'value' => 'required|numeric',
            'brand_id' => 'required|integer|exists:brands,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_users' => 'required|integer',
        ]);

        $discount = Discount::create([
            'code' => $request->code,
            'type' => 'category',
            'value' => $request->value,
            'brand_id' => $request->brand_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);

        return back()->with('success', 'Successfully created category coupon.');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:discounts,code',
            'value' => 'required|numeric',
            'product_id' => 'required|integer|exists:products,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_users' => 'required|integer',
        ]);

        $discount = Discount::create([
            'code' => $request->code,
            'type' => 'product',
            'value' => $request->value,
            'product_id' => $request->product_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);

        return back()->with('success', 'Coupon for specific product successfully created.');
    }

    public function update(Request $request, $id)
    {
        $discountUpdate = Discount::findOrFail($id);

        // Define las reglas de validación para los campos específicos que se pueden actualizar
        $rules = [
            'code' => 'string|max:255|unique:discounts,code,' . $id,
            'value' => 'numeric',
            'type' => 'in:simple,category,product',
            'percent_of' => 'nullable|numeric',
            'user_id' => 'nullable|exists:users,id',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'max_users' => 'nullable|integer',
            'brand_id' => 'nullable|exists:brands,id',
            'product_id' => 'nullable|exists:products,id',
            'max_products' => 'nullable|integer',
        ];

        // Filtra solo los campos que están presentes en la solicitud
        $dataToUpdate = array_filter($request->only(array_keys($rules)));

        // Realiza la validación con las reglas específicas
        $request->validate($rules);

        DB::beginTransaction();

        try {
            // Actualiza solo los campos presentes en la solicitud
            $discountUpdate->update($dataToUpdate);

            DB::commit();
            return back()->with('mensaje', 'Discount updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating the discount.');
        }
    }

    public function delete($id)
    {
        $discountDelete = Discount::findOrFail($id);
        $discountDelete->delete();
        return back()->with('mensaje', 'Discount removed');
    }

}
