<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Cart;
use App\Models\Product;

class DiscountController extends Controller
{
    public function store(Request $request)
    {
        $cart = auth()->user()->cart;

        $discount = Discount::where("code", $request->discount_code)->first();

        if (!$discount) {
            return redirect()->route("cart.viewShipping")->withErrors("Invalid coupon code. Please try again.");
        }

        $subtotal = $cart->subtotal();
        $totalPrice = $subtotal;

        // Verifica si el descuento está asociado a una marca específica
        if ($discount->brand_id) {
            // Filtra los productos en el carrito por la marca asociada al descuento
            $cartProducts = $cart->products()->whereHas('product', function ($query) use ($discount) {
                $query->where('brand_id', $discount->brand_id);
            })->get();

            // Calcula el subtotal solo para los productos de la marca específica
            $subtotal = $cartProducts->sum(function ($item) {
                return $item->price * $item->quantity;
            });
        }

        if ($discount) {
            $discountValue = $subtotal * ($discount->value / 100);
            $totalPrice = $subtotal - $discountValue;

            session()->put("discount", [
                "name" => $discount->code,
                "discount_value" => $discountValue,
            ]);
            session()->put('totalPrice', $totalPrice);
        } else {
            session()->put('totalPrice', $totalPrice);
        }

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been applied!");
    }

    public function destroy(Request $request)
    {
        session()->forget("discount");

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been removed.");
    }
}


