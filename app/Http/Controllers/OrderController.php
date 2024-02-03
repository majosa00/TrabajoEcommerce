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

    public function createOrder ($orderId, $productId, $amount)
    {

        //Obtener el usuario autenticado actualmente
        $user = Auth::user();

        //Verificar si ya existe un registro en order_product para este producto en el pedido actual
        $existingRecord = $user->orders()->find($orderId)->products()->where('product_id', $productId)->first();

        if ($existingRecord) {
            //Si ya existe, actualizar la cantidad
            $existingRecord->pivot->amount += $amount;
            $existingRecord->pivot->save();
        } else {
            //Si no existe, crear un nuevo registro
            $user->orders()->find($orderId)->products()->attach($productId, ['amount' => $amount]);
        }
    }

    public function showOrder ()
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
