<<<<<<< HEAD
<!-- @ extends('auth.template')    Antiguo navbar-->

@extends('layaouts.app')

@section('content')
    <div class="container">
        <h1>PEDIDOS</h1>
=======
@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">ORDERS</h1>
>>>>>>> origin/main
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>ID Order</th>
<<<<<<< HEAD
=======
                    <th>Order Date</th>
                    <th>Total Price</th>
>>>>>>> origin/main
                    <th>State</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
                <tr>
<<<<<<< HEAD
                    <td>{{ $order->id_user }}</td>
                    <td>{{ $order->id }}</td>
=======
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->orderDate }}</td>
                    <td>{{ $order->totalPrice }} $</td>
>>>>>>> origin/main
                    <td>{{ $order->state }}</td>
                </tr>
            @endforeach
        </table>
<<<<<<< HEAD
    @endsection
=======
    </div>
@endsection
>>>>>>> origin/main
