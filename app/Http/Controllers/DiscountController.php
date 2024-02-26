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
}

