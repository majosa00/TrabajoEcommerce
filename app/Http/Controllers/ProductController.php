<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'flavor' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'dimension' => 'required|numeric',
            'udpack' => 'required|integer',
            'weight' => 'required|numeric',
            'stock' => 'required|integer',
            'iva' => 'required|numeric'
        ]);

        $newProduct = new Product;
        $newProduct->name = $request->name;
        $newProduct->description = $request->description;
        $newProduct->flavor = $request->flavor;
        $newProduct->brand = $request->brand;
        $newProduct->price = $request->price;
        $newProduct->dimension = $request->dimension;
        $newProduct->udpack = $request->udpack;
        $newProduct->weight = $request->weight;
        $newProduct->stock = $request->stock;
        $newProduct->iva = $request->iva;

        $newProduct->save();

        return redirect()->route('products.create')->with('mensaje', 'Product added successfully');
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
            'description' => 'required',
            'flavor' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'dimension' => 'required|numeric',
            'udpack' => 'required|integer',
            'weight' => 'required|numeric',
            'stock' => 'required|integer',
            'iva' => 'required|numeric',
        ]);

        $productUpdate = Product::findOrFail($id);
        $productUpdate->name = $request->name;
        $productUpdate->description = $request->description;
        $productUpdate->flavor = $request->flavor;
        $productUpdate->brand = $request->brand;
        $productUpdate->price = $request->price;
        $productUpdate->dimension = $request->dimension;
        $productUpdate->udpack = $request->udpack;
        $productUpdate->weight = $request->weight;
        $productUpdate->stock = $request->stock;
        $productUpdate->iva = $request->iva;
        $productUpdate->save();

        return back()->with('mensaje', 'Product updated');
    }


    public function delete($id)
    {
        $productDelete = Product::findOrFail($id);
        $productDelete->delete();
        return back()->with('mensaje', 'Product removed');
    }

    public function brands()
    {
        $brands = Brand::all();
        return view('brands.brand')->with('brands', $brands);
    }

    public function detailBrands($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.detail', @compact('brand'));
    }

    public function createBrands(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $newBrand = new Brand;
        $newBrand->name = $request->input('name');
        $newBrand->save();

        return redirect()->route('brands.createBrand')->with('mensaje', 'Brand added successfully');
    }

    public function newBrand()
    {
        return view('brands.create');
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $brandUpdate = Brand::findOrFail($id);
        $brandUpdate->update($request->all());

        return back()->with('mensaje', 'Brand updated');
    }


    public function deleteBrand($id)
    {
        $brandDelete = Brand::findOrFail($id);
        $brandDelete->delete();
        return back()->with('mensaje', 'Brand removed');
    }

}
