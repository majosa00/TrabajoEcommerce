<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders ()
    {
        $orders = Order::all();
        return view('/orderadmin')->with('orders', $orders);
    }

    public function ordersByID ()
    {

        //Obtener el usuario autenticado actualmente
        $userId = Auth::id();
        //Solo los pedidos del usuario autenticado
        $ordersByID = Order::where('user_id', $userId)->get();

        if (!$ordersByID) { //Si no lo encuentra, vuelve a la página anterior con un mensaje de error
            return back()->with('error', 'Order not found.');
        }

        return view('order')->with('ordersByID', $ordersByID);
    }
}
