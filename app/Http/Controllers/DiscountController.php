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
            $discountValue = 0;

            foreach ($products as $product) {
                if ($discountcode->brand_id === $product->brand_id) {
                    $categoryDiscountApplicable = true;
                    $discountValue = $product->price * ($discountcode->value / 100);
                    $totalPrice -= $discountValue;
                }
            }

            if ($categoryDiscountApplicable) {
                session()->put("discount", [
                    "name" => $discountcode->code,
                    "discount_value" => $discountValue,
                ]);
                session()->put('totalPrice', $totalPrice);

                return redirect()->route("cart.viewShipping")->with("mensaje", "Category Coupon has been applied!");
            }
        } elseif ($discountcode->type === 'product') {
            // Maneja cupones de tipo 'product'
            $productDiscountApplicable = false;
            $discountValue = 0;

            foreach ($products as $product) {
                if ($discountcode->product_id === $product->id) {
                    $productDiscountApplicable = true;
                    $discountValue = $product->price * ($discountcode->value / 100);
                    $totalPrice -= $discountValue;
                    break; // Solo se aplica a un producto, así que se puede romper el ciclo una vez aplicado
                }
            }

            if ($productDiscountApplicable) {
                session()->put("discount", [
                    "name" => $discountcode->code,
                    "discount_value" => $discountValue,
                ]);
                session()->put('totalPrice', $totalPrice);

                return redirect()->route("cart.viewShipping")->with("mensaje", "Product-specific Coupon has been applied!");
            }
        } else {
            // Maneja cupones de tipo 'simple'
            $discountValue = $totalPrice * ($discountcode->value / 100);
            $totalPrice -= $discountValue;

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
            'code' => 'required|unique:discounts,code',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_users' => 'required|numeric|min:1',
        ], [
            'value.min' => 'The discount value must be a positive number.',
            'max_users.min' => 'The maximum number of users must be a positive number.',
        ]);

        Discount::create([
            'code' => $request->code,
            'type' => 'simple',
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);

        return back()->with('success', 'Simple discount coupon created successfully.');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:discounts,code',
            'brand_id' => 'required|exists:brands,id',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_users' => 'required|numeric|min:1',
        ], [
            'value.min' => 'The discount value must be a positive number.',
            'max_users.min' => 'The maximum number of users must be a positive number.',
        ]);

        Discount::create([
            'code' => $request->code,
            'type' => 'category',
            'brand_id' => $request->brand_id,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);

        return back()->with('success', 'Discount coupon by category created successfully.');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:discounts,code',
            'product_id' => 'required|exists:products,id',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_users' => 'required|numeric|min:1',
        ], [
            'value.min' => 'The discount value must be a positive number.',
            'max_users.min' => 'The maximum number of users must be a positive number.',
        ]);

        Discount::create([
            'code' => $request->code,
            'type' => 'product',
            'product_id' => $request->product_id,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'max_users' => $request->max_users,
        ]);

        return back()->with('success', 'Discount coupon for specific product created successfully.');
    }


}
