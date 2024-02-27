<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Image;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    //Productos administrador
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
        $brands = Brand::all(); // Assuming Brand is your brand model

        return view('product.edit', compact('product', 'brands'));
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

            $imagePaths = []; // Para almacenar las rutas de las imágenes

            // Guardar las imágenes
            for ($i = 1; $i <= 3; $i++) {
                if ($request->hasFile("image_$i")) {
                    // Obtener el archivo
                    $image = $request->file("image_$i");

                    // Generar un nombre único para el archivo
                    $imageName = uniqid('image_') . '.' . $image->getClientOriginalExtension();

                    // Crear una nueva instancia de Image
                    $newImage = new Image();
                    $newImage->{"imagen_$i"} = 'images/' . $imageName;

                    // Guardar la imagen en el almacenamiento (storage)
                    $image->storeAs('public/images', $imageName);

                    // Almacenar la ruta de la imagen
                    $imagePaths[] = $newImage->{"imagen_$i"};  // Actualizamos $imagePaths aquí

                    // Vincular la imagen al producto utilizando la relación
                    $productUpdate->images()->save($newImage);
                }
            }

            // Almacenar las rutas de las imágenes en la base de datos
            $productUpdate->images()->update([
                'imagen_1' => $imagePaths[0] ?? null,
            ]);

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
            return redirect()->route('')->with('mensaje', 'Brand deleted successfully and all associated products have been unlinked.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error removing the brand: ' . $e->getMessage());
        }
    }

    // En ProductController.php
    public function showTopFavorites()
    {
        $topProducts = Product::withCount('wishlists')
            ->orderBy('wishlists_count', 'desc')
            ->take(5)
            ->get();

        return view('wishlistadmin', compact('topProducts'));
    }

    public function showProductsByBrand($id)
    {
        // Carga la marca y sus productos relacionados
        $brand = Brand::with('products')->findOrFail($id);
        $products = $brand->products; // Obtén los productos relacionados

        // Pasa la marca y los productos a la vista
        return view('viewbrands', compact('brand', 'products'));
    }

    public function hide($id)
    {
        $product = Product::findOrFail($id);
        $product->is_hidden = true;
        $product->save();

        return back()->with('mensaje', 'Product properly concealed.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product->is_hidden = false;
        $product->save();

        return back()->with('mensaje', 'Product displayed correctly.');
    }

    public function showProductWithBrand($id)
    {
        $product = Product::with('brand')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function showBrands()
    {
        $brands = Brand::all();

        // Pasa 'brands' a la vista.
        return view('products.brands', compact('brands'));
    }

    public function showCreateForm()
    {
        // Cargar productos y marcas
        $products = Product::all();
        $brands = Brand::all(); // Obtén todas las marcas de la base de datos
    
        // Pasar productos y marcas a la vista
        return view('product', compact('products', 'brands'));
    }
    

    public function index()
    {
        $products = Product::where('is_hidden', false)->get();

        // Consulta para obtener los 3 productos más vendidos
        $topSellingProducts = Product::withCount('orders as orders_count')
            ->orderByDesc('orders_count')
            ->take(3)
            ->get();

        // Obtener todos los descuentos
        $discounts = Discount::all();

        return view('logged', compact('products', 'topSellingProducts', 'discounts'));
    }

    public function showProduct($id)
    {
        $product = Product::with('wishlist', 'images')->findOrFail($id);

        // Pasa la marca a la vista
        return view('products.showProducts', compact('product'));
    }

}









