<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
            'price' => 'required|numeric|min:0.1',
            'dimension' => 'required|numeric|min:0.1',
            'udpack' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0.1',
            'stock' => 'required|integer|min:1',
            'iva' => 'required|numeric|min:0.1',
            'brand_id' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();

        try {
            $newProduct = new Product;
            $newProduct->name = $request->name;
            $newProduct->description = $request->description;
            $newProduct->flavor = $request->flavor;
            $newProduct->price = $request->price;
            $newProduct->dimension = $request->dimension;
            $newProduct->udpack = $request->udpack;
            $newProduct->weight = $request->weight;
            $newProduct->stock = $request->stock;
            $newProduct->iva = $request->iva;
            $newProduct->brand_id = $request->brand_id;

            $newProduct->save();

            DB::commit();
            return redirect()->route('products.create')->with('mensaje', 'Product added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error adding the product');
        }
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
            'price' => 'required|numeric|min:0.1',
            'dimension' => 'required|numeric|min:0.1',
            'udpack' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0.1',
            'stock' => 'required|integer|min:1',
            'iva' => 'required|numeric|min:0.1',
            'brand_id' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();

        try {
            $productUpdate = Product::findOrFail($id);
            $productUpdate->name = $request->name;
            $productUpdate->description = $request->description;
            $productUpdate->flavor = $request->flavor;
            $productUpdate->price = $request->price;
            $productUpdate->dimension = $request->dimension;
            $productUpdate->udpack = $request->udpack;
            $productUpdate->weight = $request->weight;
            $productUpdate->stock = $request->stock;
            $productUpdate->iva = $request->iva;
            $productUpdate->brand_id = $request->brand_id;
            $productUpdate->save();

            DB::commit();
            return back()->with('mensaje', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating the product.');
        }
    }


    public function delete($id)
    {
        $productDelete = Product::findOrFail($id);
        $productDelete->delete();
        return back()->with('mensaje', 'Product removed');
    }

    public function brands()
    {
        $brands = Brand::orderBy('created_at', 'desc')->simplePaginate(5); // Asegúrate de usar simplePaginate o paginate
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

        DB::beginTransaction();

        try {
            $newBrand = new Brand;
            $newBrand->name = $request->input('name');
            $newBrand->save();

            DB::commit();
            return redirect()->route('brands.createBrand')->with('mensaje', 'Brand added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error adding the brand');
        }
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
            'name' => 'required|unique:brands,name,' . $id . '|max:255',
        ]);

        DB::beginTransaction();

        try {
            $brandUpdate = Brand::findOrFail($id);
            $brandUpdate->update($request->all());

            DB::commit();
            return back()->with('mensaje', 'Brand updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating the brand');
        }
    }

    public function deleteBrand($id)
    {
        DB::beginTransaction();

        try {
            // Primero, establecer brand_id a null para todos los productos asociados a esta marca
            Product::where('brand_id', $id)->update(['brand_id' => null]);
            
            $brand = Brand::findOrFail($id);
            $brand->delete();

            DB::commit();
            return redirect()->route('ruta_lista_marcas')->with('mensaje', 'Brand deleted successfully and all associated products have been unlinked.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error removing the brand: ' . $e->getMessage());
        }
    }

    public function showTopFavorites()
    {
        $topProducts = Product::withCount('wishlists')
            ->orderBy('wishlists_count', 'desc')
            ->take(5)
            ->get();

        // Cambia 'admin.wishlist' por 'wishlistadmin' para que coincida con el nombre de tu archivo de vista
        return view('wishlistadmin', compact('topProducts'));
    }

    public function showProductsByBrand($id)
    {
        // Carga la marca y sus productos relacionados
        $brand = Brand::with('products')->findOrFail($id);

        // Pasa la marca a la vista
        return view('viewbrands', compact('brand'));
    }

    public function hide($id)
    {
        $product = Product::findOrFail($id);
        $product->is_hidden = true;
        $product->save();

        return back()->with('mensaje', 'Producto ocultado correctamente.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product->is_hidden = false;
        $product->save();

        return back()->with('mensaje', 'Producto mostrado correctamente.');
    }

    public function index()
    {
        $products = Product::where('is_hidden', false)->get();

        // Consulta para obtener los 3 productos más vendidos
        $topSellingProducts = Product::withCount('orders as orders_count')
            ->orderByDesc('orders_count')
            ->take(3) //Si no hay nada comprado muestra 3 igualmente, publicidad engañosa :), sino te los ordena.
            ->get();

        return view('logged', compact('products', 'topSellingProducts'));
    }
}
