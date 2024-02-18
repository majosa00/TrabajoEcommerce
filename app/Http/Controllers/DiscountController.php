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
        // Inicializa el totalPrice con el subtotal
        $totalPrice = $subtotal;

        if ($discount) {
            // Calcula el descuento como porcentaje del subtotal
            $discountValue = $subtotal * ($discount->value / 100);
            // Calcula el totalPrice con descuento
            $totalPrice = $subtotal - $discountValue;
            // Almacena en la sesión el descuento
            session()->put("discount", [
                "name" => $discount->code,
                "discount_value" => $discountValue,
            ]);
            //Almacenar en la sesión el totalprice
            session()->put('totalPrice', $totalPrice);
        } else {
            // No hay descuento, almacena el totalPrice sin descuento en la sesión
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
