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

        // Busca un registro existente en la lista de deseos
        $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($wishlistItem) {
            // Si el producto ya está en la lista de deseos, lo elimina
            $wishlistItem->delete();
            return back()->with('success', 'Product removed from the wishlist.');
        } else {
            // Si el producto no está en la lista de deseos, lo agrega
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            return back()->with('success', 'Product added to the wishlist.');
        }
    }

    public function removeFromWishlist($wishlistId)
    {
        $wishlist = Wishlist::where('id', $wishlistId)->where('user_id', Auth::id())->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Product removed from the wishlist.');
        }

        return back()->with('error', 'Unable to remove the product from the wishlist.');
    }

    public function showWishlist()
    {
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->with('product')->simplePaginate(5);


        return view('products.wishlist', compact('wishlists'));
    }

    public function showTopWishlist()
    {
        // Recuperar todos los productos que han sido añadidos a la lista de deseos, luego filtrar manualmente
        $allProducts = Product::withCount('wishlists')
            ->orderBy('wishlists_count', 'desc')
            ->get();

        // Filtrar productos con wishlists_count mayor que 0
        $topProducts = $allProducts->filter(function ($product) {
            return $product->wishlists_count > 0;
        })->take(5);

        return view('admin.wishlist', compact('topProducts'));
    }
}
