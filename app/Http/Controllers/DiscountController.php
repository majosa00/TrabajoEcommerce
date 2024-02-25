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

    // Verifica si el cupón es específico para la marca 'Monster'
    if ($discount->code === 'CODE2') {
        // Verifica si todos los productos en el carrito son de la marca 'Monster'
        $monsterBrand = Brand::where('name', 'Monster')->first();
        if ($monsterBrand && $cart->products()->where('brand_id', '<>', $monsterBrand->id)->exists()) {
            return redirect()->route("cart.viewShipping")->withErrors("Coupon is not applicable as all products in the cart are not 'Monster' brand products.");
        }

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
    } else {
        // Para otros códigos de cupón, simplemente aplica el descuento sin verificar la marca
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
}




    public function destroy(Request $request)
    {
        session()->forget("discount");

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been removed.");
    }
}

