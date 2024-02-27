<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::all();
        return view('/orderadmin')->with('orders', $orders);
    }

    public function showOrders()
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

        return view('order', ['cart' => $cart, 'orders' => $orders]);
    }

    public function showticket(Order $order)
    {
        return view('products.ticket', compact('order'));
    }
    public function generateInvoice($id)
    {
        $order = Order::with(['products', 'user'])->findOrFail($id);
        $pdf = PDF::loadView('invoices.invoice', compact('order'));
        return $pdf->download("invoice-{$order->id}.pdf");
    }


}