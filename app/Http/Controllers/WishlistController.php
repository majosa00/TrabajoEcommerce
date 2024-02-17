<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function addToWishlist($productId)
    {
        DB::beginTransaction();

        try {
            $userId = Auth::id(); // Obtiene el ID del usuario autenticado

            // Busca un registro existente en la lista de deseos
            $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

            if (!$wishlist) {
                // Si la lista de deseos no existe, crea una nueva
                $wishlist = new Wishlist();
                $wishlist->user_id = $userId;
                $wishlist->product_id = $productId;
                $wishlist->save();
                $wishlist->products()->attach($productId);
                $message = 'Product added to the wishlist.';
            } else {
                // Si el producto ya está en la lista de deseos, lo elimina
                $wishlist->products()->detach($productId);
                $wishlist->save();
                $message = 'Product removed from the wishlist.';
            }

            DB::commit(); // Confirma los cambios si todo ha ido bien

            return back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte los cambios en caso de error

            // Redirige al usuario con un mensaje de error
            return back()->withErrors(['error' => 'There was a problem updating your wishlist.']);
        }
    }

    public function showWishlist()
    {
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->with('products')->simplePaginate(5);

        return view('products.wishlist', compact('wishlists'));
    }

    public function showTopWishlist()
    {
        // Recuperar todos los productos que han sido añadidos a la lista de deseos, luego filtrar manualmente
        $allProducts = Product::withCount('wishlists')
            ->orderBy('wishlists_count', 'desc')
            ->get();

        // Filtrar productos con wishlists_count mayor a 0
        $topProducts = $allProducts->filter(function ($product) {
            return $product->wishlists_count > 0;
        })->take(5);

        return view('admin.wishlist', compact('topProducts'));
    }

}

