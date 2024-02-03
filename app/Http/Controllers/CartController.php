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
        //Obtener el usuario autenticado actualmente
        $user = Auth::user();
        //Busca en la base de datos el ID del producto
        $product = Product::find($productId);

        if (!$product) { //Si no lo encuentra, vuelve a la página anterior con un mensaje de error
            return back()->with('error', 'Product not found.');
        }

        //Busca el carrito asociado al usuario, si no existe lo crea
        $cart = $user->cart ?? new Cart(['user_id' => $user->id]);
        $cart->save();

        //Asocia el corrito al producto del usuario. Si ya está el producto en el carrito, aumenta la cantidad en 1, sino lo añade con 1
        $cart->products()->attach($productId, ['amount' => 1]);

        //Si funciona, redirige a la página anterior con un mensaje de éxito indicando que el producto fue añadido al carrito
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
        $order->totalPrice = $cart->products->sum('price'); // Calcular el precio total desde los productos en el carrito
        $order->save();

        // Enviar correo electrónico
        Mail::to($user->email)->send(new OrderConfirmation($order));

        // Puedes limpiar el carrito después de realizar el pedido si es necesario
        $cart->products()->detach();

        return redirect()->route('cart.view')->with('success', 'Payment successful!');
    }
}
