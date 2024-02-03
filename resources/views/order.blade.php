@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">ORDERS</h1>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Products</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th>State</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        @foreach ($order->productIds as $productId)
                                <li>{{ $productId->name }}</li>
                        @endforeach
                    </td>
                    <td>{{ $order->orderDate }}</td>
                    <td>{{ $order->totalPrice }} $</td>
                    <td>{{ $order->state }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
