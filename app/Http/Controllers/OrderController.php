<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::all();
        return view('/orderadmin')->with('orders', $orders);
    }

    public function showOrder()
    {
        $userId = Auth::id();

        // Obtener el carrito del usuario
        $cart = Cart::where('user_id', $userId)->first();

        // Verificar si el usuario tiene un carrito
        if (!$cart) {
            // Manejar el caso en que el usuario no tiene carrito
            return view('order', ['orders' => []]);
        }

        // Obtener los pedidos del usuario con productos asociados
        $orders = Order::where('user_id', $userId)->with('products')->get();

        return view('order', ['orders' => $orders]);
    }

}
