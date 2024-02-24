<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Cart;

class DiscountController extends Controller
{
    public function store(Request $request)
    {
        $cart = auth()->user()->cart;

        // Busca el cupón de descuento en la base de datos basado en el código proporcionado en la solicitud
        $discount = Discount::where("code", $request->discount_code)->first();

        if (!$discount) {
            return redirect()->route("cart.viewShipping")->withErrors("Invalid coupon code. Please try again.");
        }

        $subtotal = $cart->subtotal();
        $totalPrice = $subtotal;

        // Calcula el descuento y el precio total
        $discountValue = $totalPrice * ($discount->value / 100);
        $totalPrice = $subtotal - $discountValue;

        // Almacena la información del descuento y el precio total en la sesión
        session()->put("discount", [
            "name" => $discount->code,
            "discount_value" => $discountValue,
        ]);
        session()->put('totalPrice', $totalPrice);

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been applied!");
    }

    public function destroy(Request $request)
    {
        session()->forget("discount");

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been removed.");
    }
}

