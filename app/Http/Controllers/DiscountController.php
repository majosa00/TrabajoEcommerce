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

        $discount = Discount::where("code", $request->discount_code)->first();

        if (!$discount) {
            return redirect()->route("cart.viewShipping")->withErrors("Invalid coupon code. Please try again.");
        }

        // Llama al método subtotal en el modelo Cart
        $subtotal = $cart->subtotal();

        session()->put("discount", [
            "name" => $discount->code,
            "discount_value" => $discount->$subtotal,
        ]);

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been applied!");
    }

    public function destroy(Request $request)
    {
        session()->forget("discount");

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been removed.");
    }
}
