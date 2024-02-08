<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; 
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function addToWishlist($productId)
    {
        $userId = Auth::id(); // Obtiene el ID del usuario autenticado

        // Verifica si el producto ya está en la lista de deseos
        $exists = Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists();

        if (!$exists) {
            // Agrega el producto a la lista de deseos si no existe
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);

            return back()->with('success', 'Producto agregado a la lista de deseos.');
        }

        return back()->with('error', 'El producto ya está en tu lista de deseos.');
    }

    public function removeFromWishlist($wishlistId)
    {
        $wishlist = Wishlist::where('id', $wishlistId)->where('user_id', Auth::id())->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Producto eliminado de la lista de deseos.');
        }

        return back()->with('error', 'No se pudo eliminar el producto de la lista de deseos.');
    }

    public function showWishlist()
    {
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->with('product')->get();

        return view('wishlist', compact('wishlists'));
    }
}

