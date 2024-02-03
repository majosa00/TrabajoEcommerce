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

    public function createOrder($cartId, $productId, $totalprice)
    {

    }

    public function showOrder()
    {
        //Obtener el usuario autenticado actualmente
        $userId = Auth::id();

        //Solo los pedidos del usuario autenticado
        $ordersByID = Order::where('user_id', $userId)->get();

        //Obtener el carrito del usuario
        $cart = Cart::where('user_id', $userId)->first();

        //Obtener los IDs de productos en el carrito
        $productIds = $cart->products()->pluck('product_id')->toArray();

        return view('order', ['orders' => $ordersByID, 'productIds' => $productIds]);
    }
}
