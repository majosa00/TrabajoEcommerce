<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        // Ordena los productos por fecha de creación de manera descendente
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(5);
        return view('products.product', compact('products'));        
    }


    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('products.detail', @compact('product'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'description' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'flavor' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'brand' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'price' => 'required|numeric|min:0.1',
            'dimension' => 'required|numeric|min:0.1',
            'udpack' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0.1',
            'stock' => 'required|integer|min:1',
            'iva' => 'required|numeric|min:0.1'
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
            'name' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'description' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'flavor' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'brand' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'price' => 'required|numeric|min:0.1',
            'dimension' => 'required|numeric|min:0.1',
            'udpack' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0.1',
            'stock' => 'required|integer|min:1',
            'iva' => 'required|numeric|min:0.1'
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
        // Ordena las marcas por fecha de creación de manera descendente y las pagina
        $brands = Brand::orderBy('created_at', 'desc')->simplePaginate(5); // Ajusta el número según la cantidad deseada por página
        return view('brands.brand', compact('brands'));
    }


    public function detailBrands($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.detail', @compact('brand'));
    }

    public function createBrands(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name|max:255',
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
            'name' => 'required|unique:brands,name|max:255',
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
