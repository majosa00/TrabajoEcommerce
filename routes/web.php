<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('products', [UserController::class, 'products']);
Route::get('products/show/{id}', [ProductController::class, 'showProduct'])->name('products.showProduct');
Route::get('orders', [OrderController::class, 'showOrders'])->name('orders');
Route::get('orders/{order}', [OrderController::class, 'showTicket'])->name('order.showticket');
Route::get('new_order', [OrderController::class, 'createOrder']);
Route::get('productsbrands', [UserController::class, 'brands']);
//Editar perfil
Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::put('profile/changepassword', [UserController::class, 'changePassword'])->name('profile.changepassword');
Route::put('profile/update', [UserController::class, 'update'])->name('user.update');
//Direcciones de envío
Route::get('profile/address', [UserController::class, 'address'])->name('profile.address');
Route::post('profile/new-address', [UserController::class, 'createNewAddress'])->name('profile.create-new-address');
Route::get('profile/edit-address/{id}', [UserController::class, 'editAddress'])->name('profile.editAddress');
Route::put('profile/update-address/{id}', [UserController::class, 'updateAddress'])->name('profile.updateAddress');
Route::delete('profile/delete-address/{id}', [UserController::class, 'deleteAddress'])->name('profile.deleteAddress');


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
    //Productos
    Route::get('admin/products', [ProductController::class, 'products']);
    Route::get('admin/products/{id}', [ProductController::class, 'detail']);
    Route::get('admin/new_product', [ProductController::class, 'newProduct']);
    Route::post('admin/products', [ProductController::class, 'create'])->name('products.create');
    Route::get('admin/edit_product/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('admin/edit_product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('admin/delete_product/{id}', [ProductController::class, 'delete'])->name('products.delete');
    //Pedidos
    Route::get('admin/orderadmin', [OrderController::class, 'orders']);
    //Marcas
    Route::get('admin/brands', [ProductController::class, 'brands']);
    Route::post('admin/brands', [ProductController::class, 'createBrands'])->name('brands.createBrand');
    Route::get('admin/edit_brand/{id}', [ProductController::class, 'editBrand'])->name('brands.editBrand');
    Route::put('admin/edit_brand/{id}', [ProductController::class, 'updateBrand'])->name('brands.updateBrand');
    Route::delete('admin/delete_brand/{id}', [ProductController::class, 'deleteBrand'])->name('brands.deleteBrand');
    //Wishlist
    Route::get('admin/wishlist', [ProductController::class, 'showTopFavorites'])->name('admin.topFavorites');
    Route::get('admin/wishlist', [WishlistController::class, 'showTopWishlist'])->name('admin.wishlist');

    // Rutas existentes para manejo de cupones
    Route::get('admin/discount', [DiscountController::class, 'index'])->name('admin.discount');
    Route::get('admin/create-discount', [DiscountController::class, 'show'])->name('admin.creatediscount');
    Route::post('admin/discount', [DiscountController::class, 'storeSimple'])->name('admin.store_simple');
    Route::post('admin/discount/store_category', [DiscountController::class, 'storeCategory'])->name('admin.store_category');
    Route::post('admin/discount/store_product', [DiscountController::class, 'storeProduct'])->name('admin.store_product');
    Route::get('/discounts', [DiscountController::class, 'index'])->name('discounts.index');
    Route::get('admin/edit_discount/{id}', [ProductController::class, 'edit'])->name('discounts.edit');
    Route::put('admin/edit_discount/{id}', [DiscountController::class, 'update'])->name('discounts.update');
    Route::delete('admin/delete_discount/{id}', [DiscountController::class, 'delete'])->name('discounts.delete');

    // web.php
})->middleware(['auth', 'verified']);

//Ruta carrito
Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
//Añadir al carrito con formulario
Route::post('cart/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('cart.addToCart');
//Pagar
Route::post('cart/pay', [CartController::class, 'pay'])->name('cart.pay');
//Shipping
Route::match(['get', 'post'], 'cart/view-shipping', [CartController::class, 'viewShipping'])->name('cart.viewShipping');
Route::match(['get', 'post'], 'cart/update-datas', [CartController::class, 'updatedatas'])->name('cart.updatedatas');
Route::post('cart/process-payment', [CartController::class, 'processpayment'])->name('cart.ticket');
Route::post('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease');
//Eliminar producto del carrito
Route::delete('cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
//Actualizar cantidades en el carrito
Route::put('cart/updateAmount/{productId}', [CartController::class, 'updateAmount'])->name('cart.updateAmount');
Route::post('cart/new-address-shipping', [CartController::class, 'createNewAddressShipping'])->name('cart.create-new-address-shipping');

Route::post("discount", [DiscountController::class, "store"])->name("discount.store");
Route::delete("discount", [DiscountController::class, "destroy"])->name("discount.destroy");

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        session()->put('locale', $locale);
    }
    return back();
});

Route::post('wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
// Remover de la Lista de Deseos
Route::delete('wishlist/remove/{wishlistId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
// Mostrar la Lista de Deseos
Route::get('wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');

Route::get('/brands/{brandId}/products', [ProductController::class, 'showProductsByBrand'])->name('brand.products');

// Ruta para ocultar un producto
Route::post('/products/hide/{id}', [ProductController::class, 'hide'])->name('products.hide');
// Ruta para mostrar un producto
Route::post('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products', [ProductController::class, 'index']);
Route::delete('admin/delete_brand/{id}', [ProductController::class, 'deleteBrand'])->name('brands.deleteBrand');

//nombre de la ruta - controller - nombre función dentro del controlador - nombre es para renombrar la ruta porque est´dentro de un formulario y queremos que tenga ese name

Route::get('/products/{id}', 'ProductController@showProductWithBrand')->name('products.showWithBrand');

Route::get('/order/{id}/invoice', [OrderController::class, 'generateInvoice'])->name('order.generateInvoice');

Route::get('/products/new', 'ProductController@showCreateForm')->name('products.new');
