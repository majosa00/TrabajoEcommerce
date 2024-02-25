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

        // Busca el cupón de descuento en la base de datos basado en el código proporcionado en la solicitud
        $discount = Discount::where("code", $request->discount_code)->first();

        if (!$discount) {
            return redirect()->route("cart.viewShipping")->withErrors("Invalid coupon code. Please try again.");
        }

        $subtotal = $cart->subtotal();
        $totalPrice = $subtotal;

        // Verifica si el cupón es de tipo 'category'
        if ($discount->type === 'category') {
            $brand = Brand::find($discount->brand_id);

            // Verifica si hay productos de la marca correspondiente al cupón en el carrito
            if ($brand && !$cart->products()->where('brand_id', $brand->id)->exists()) {
                return redirect()->route("cart.viewShipping")->withErrors("Coupon is not applicable as there are no products from the relevant brand in the cart.");
            }
        }

        // Calcula el descuento y el precio total
        $discountValue = $totalPrice * ($discount->value / 100);
        $totalPrice -= $discountValue;

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

