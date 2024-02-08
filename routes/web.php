<?php



use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('products', [UserController::class, 'products']);
Route::get('orders', [OrderController::class, 'showOrder']);
Route::get('new_order', [OrderController::class, 'createOrder']);
Route::get('productsbrands', [UserController::class, 'brands']);
//Editar perfil
Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::put('profile/changepassword', [UserController::class, 'changePassword'])->name('profile.changepassword');
Route::put('profile/update', [UserController::class, 'update'])->name('user.update');
//Direcciones de envío
Route::post('profile/addresses', [UserController::class, 'addresses'])->name('profile.addresses');
Route::get('profile/new-address', [UserController::class, 'newadress'])->name('profile.newadress');
Route::get('profile/update-address', [UserController::class, 'updateAddress'])->name('profile.updateaddress');
Route::get('profile/save-address', [UserController::class, 'saveAddress'])->name('profile.saveaddress');
Route::get('profile/delete-address', [UserController::class, 'deleteAddress'])->name('profile.deleteaddress');


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
})->middleware(['auth', 'verified']);

//Ruta carrito
Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
//Añadir al carrito con formulario
Route::post('cart/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('cart.addToCart');
//Pagar
Route::post('cart/pay', [CartController::class, 'pay'])->name('cart.pay');
//Shipping
Route::post('cart/view-shipping', [CartController::class, 'viewShipping'])->name('cart.viewShipping');
Route::post('/cart/increase/{product}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])->name('cart.decrease');
//Eliminar producto del carrito
Route::delete('cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
//Actualizar cantidades en el carrito
Route::put('cart/updateAmount/{productId}', [CartController::class, 'updateAmount'])->name('cart.updateAmount');

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


//Faltan:
// Route::get('/wishlist', [UserController::class, 'products']);

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