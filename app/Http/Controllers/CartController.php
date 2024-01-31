<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        

        return back()->with('success', 'Producto añadido al carrito.');
    }
}
