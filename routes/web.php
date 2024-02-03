<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', [UserController::class, 'products']);
Route::get('orders', [OrderController::class, 'showOrder']);
Route::get('new_order', [OrderController::class, 'createOrder']);

//Pedir que el correo sea verificado
Route::get('home', function () {
    if (Auth::user()->rol_id == 2) {
        return redirect('admin/products');
    } else {
        return redirect('products');
    }
})->middleware(['auth', 'verified']);

//Si eres administrador
Route::group([
    'middleware' => 'admin',
    // 'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::get('admin/products', [ProductController::class, 'products']);
    Route::get('admin/products/{id}', [ProductController::class, 'detail']);
    Route::get('admin/new_product', [ProductController::class, 'newProduct']);
    Route::post('admin/products', [ProductController::class, 'create'])->name('products.create');
    Route::get('admin/edit_product/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('admin/edit_product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('admin/delete_product/{id}', [ProductController::class, 'delete'])->name('products.delete');
    Route::get('admin/orderadmin', [OrderController::class, 'orders']);
})->middleware(['auth', 'verified']);

//Ruta carrito
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
//Añadir al carrito con formulario
Route::post('/cart/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('cart.addToCart');
//Pagar
Route::post('/cart/pay', [CartController::class, 'pay'])->name('cart.pay');
//Eliminar producto del carrito
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

//Faltan:
// Route::get('/wishlist', [UserController::class, 'products']);
// Route::get('/productsbrands', [UserController::class, 'products']);
// Route::get('/profile', [UserController::class, 'products']);
// Route::get('/shipping', [UserController::class, 'products']);

//nombre de la ruta - controller - nombre función dentro del controlador - nombre es para renombrar la ruta porque est´dentro de un formulario y queremos que tenga ese name
// Route::get('products', [ProductController::class, 'products']);
// Route::get('products/{id}', [ProductController::class, 'detail']);
// Route::get('new_product', [ProductController::class, 'newProduct']);
// Route::post('products', [ProductController::class, 'create'])->name('products.create');
// Route::get('edit_product/{id}', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('edit_product/{id}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('delete_product/{id}', [ProductController::class, 'delete'])->name('products.delete');
// Route::get('productslist', [ProductController::class, 'products'])->name('products.index');
// Route::get('products', [ProductController::class, 'products'])->name('products.index');
