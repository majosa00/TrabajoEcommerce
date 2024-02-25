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
        // Obtén la marca 'Monster'
        $monsterBrand = Brand::where('name', 'Monster')->first();

        if ($monsterBrand) {
            // Verifica si hay productos de la marca 'Monster' en el carrito
            if ($cart->products()->where('brand_id', $monsterBrand->id)->exists()) {
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
                return redirect()->route("cart.viewShipping")->withErrors("Coupon is not applicable as there are no 'Monster' brand products in the cart.");
            }
        } else {
            return redirect()->route("cart.viewShipping")->withErrors("Coupon is not applicable for this brand.");
        }
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

    public function applyDiscountToBrand()
{
    // Obtener la marca "Monster"
    $monsterBrand = Brand::where('name', 'Monster')->first();

    if ($monsterBrand) {
        // Obtener todos los productos de la marca "Monster"
        $monsterProducts = Product::where('brand_id', $monsterBrand->id)->get();
        
        // Aplicar el descuento a cada producto de la marca "Monster"
        foreach ($monsterProducts as $product) {
            // Calcula el precio con descuento
            $discountedPrice = $product->price * 0.86;
            
            // Actualiza el precio del producto con el descuento aplicado
            $product->update(['price' => $discountedPrice]);
        }
    }
}



    public function destroy(Request $request)
    {
        session()->forget("discount");

        return redirect()->route("cart.viewShipping")->with("mensaje", "Coupon has been removed.");
    }
}

