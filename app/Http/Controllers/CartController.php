<?php

// App\Http\Controllers\CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation; // Asegúrate de haber creado esta Mailable

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        // Obtener el usuario autenticado actualmente
        $user = Auth::user();
        // Buscar en la base de datos el ID del producto
        $product = Product::find($productId);

        if (!$product) { // Si no lo encuentra, vuelve a la página anterior con un mensaje de error
            return back()->with('error', 'Product not found.');
        }

        // Busca el carrito asociado al usuario, si no existe lo crea
        $cart = $user->cart ?? new Cart(['user_id' => $user->id]);
        $cart->save();

        // Verificar si el producto ya está en el carrito
        if ($cart->products()->where('product_id', $productId)->exists()) {
            // Obtener el registro pivot para ese producto
            $pivot = $cart->products()->where('product_id', $productId)->first()->pivot;
            // Incrementar la cantidad en 1
            $pivot->amount += 1;
            $pivot->save();
        } else {
            // Asocia el carrito al producto del usuario con una cantidad de 1 si el producto no está en el carrito
            $cart->products()->attach($productId, ['amount' => 1]);
        }

        // Si funciona, redirige a la página anterior con un mensaje de éxito indicando que el producto fue añadido al carrito
        return redirect()->route('cart.view')->with('success', 'Product added to the cart.');
    }

    public function viewCart()
    {
        //Obtener el usuario autenticado actualmente
        $user = Auth::user();

        //Obtener carrito del usuario
        $cart = $user->cart;

        //Obtener productos del carrito y la cantidad
        if ($cart) {
            $products = $cart->products()->withPivot('amount')->get();
        } else {
            $products = collect();
        }


        return view('products.cart', compact('products'));
    }

    public function pay(Request $request)
    {
        //Obtener el usuario autenticado actualmente
        $user = Auth::user();

        //Obtener carrito del usuario
        $cart = $user->cart;

        //Crear nuevo pedido
        $order = new Order();
        $order->user_id = $user->id;

        //Completar campos del pedido
        $order->state = 'Pending'; //Los pedidos estarán en pendiente de inicio
        $order->orderDate = now();
        $totalPrice = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->amount;
        });
        $order->totalPrice = $totalPrice;
        $order->save();

        //Enviar correo electrónico (comentado mientras practicamos para no tener 21701293 correos)
        //Mail::to($user->email)->send(new OrderConfirmation($order));

        //Puedes limpiar el carrito después de realizar el pedido si es necesario
        $cart->products()->detach();

        return redirect()->route('cart.view')->with('success', 'Payment successful!');
    }

    public function remove($productId)
    {
        $user = Auth::user(); //obtencion del usuario
        $cart = $user->cart; //

        if ($cart) {
            $cart->products()->detach($productId);
            return back()->with('success', 'Producto eliminado .');
        }

        return back()->with('error', 'No hay carro.');
    }
}
