<?php

// App\Http\Controllers\CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user(); 
        $product = Product::find($productId);
    
        if (!$product) {
            return back()->with('error', 'Producto no encontrado.');
        }
    
        $cart = $user->cart ?? new Cart(['user_id' => $user->id]);
        $cart->save();
    
        $cart->products()->attach($productId, ['amount' => 1]); 
        return back()->with('success', 'Producto añadido al carrito');
    }

    public function viewCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            $products = $cart->products; 
        } else {
            $products = collect(); 
        }

        return view('products.cart', compact('products'));
    }
}
