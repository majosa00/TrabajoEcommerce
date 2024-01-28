<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware('auth');
    
//Pedir que el correo sea verificado
Route::get('/home', function() {
    return view('auth.dashboard');
})->middleware(['auth','verified']);

Route::get('products', [ ProductController::class, 'products' ]);
Route::get('products/{id}', [ ProductController::class, 'detail' ]);
Route::get('new_product', [ ProductController::class, 'newProduct' ]);
Route::post('products', [ ProductController::class, 'create' ]) -> name('products.create');
Route::get('edit_product/{id}', [ ProductController::class, 'edit' ]) -> name('products.edit'); 
Route::put('edit_product/{id}', [ ProductController::class, 'update' ]) -> name('products.update'); 
Route::delete('delete_product/{id}', [ ProductController::class, 'delete' ]) -> name('products.delete');
Route::get('new_product', [ProductController::class, 'newProduct'])->name('products.new');
Route::get('/products', [ProductController::class, 'products'])->name('products.index');
Route::post('add_product', [ProductController::class, 'create'])->name('products.add');