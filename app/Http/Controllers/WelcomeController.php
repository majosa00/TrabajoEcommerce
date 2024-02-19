<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::take(6)->get();
        $brands = Brand::take(6)->get();

        return view('welcome', ['products' => $products, 'brands' => $brands]);
    }
}
