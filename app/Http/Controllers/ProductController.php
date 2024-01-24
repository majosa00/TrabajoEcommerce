<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();
        return view('products.product')->with('products', $products);
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('products.detail', @compact('product'));
    }

    public function create(Request $request)
    {

        $request->validate(['title' => 'required', 'text' => 'required']);
        $newProduct = new Product;
        $newProduct->title = $request->title;
        $newProduct->text = $request->text;
        $newProduct->save();
        return back()->with('mensaje', 'Producto agregado exitosamente');
    }

    public function newProduct()
    {
        return view('products.create');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $productUpdate = Product::findOrFail($id);
        $productUpdate->title = $request->name;
        $productUpdate->text = $request->description;
        $productUpdate->save();

        return back()->with('mensaje', 'Producto actualizado');
    }

    public function delete($id)
    {
        $productDelete = Product::findOrFail($id);
        $productDelete->delete();
        return back()->with('mensaje', 'Producto eliminado');
    }
}
