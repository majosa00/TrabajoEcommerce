<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders ()
    {
        $orders = Order::all();
        return view('/orderadmin')->with('orders', $orders);
    }
}
