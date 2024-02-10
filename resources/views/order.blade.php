@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h1 class="mb-3">ORDERS</h1>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Products</th>
                <th>Amount</th>
                <th>Order Date</th>
                <th>Total Price</th>
                <th>State</th>
            </tr>
        </thead>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>
                <ul class="list-unstyled">
                    @foreach ($order->products as $product)
                    <li>{{ $product->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <ul class="list-unstyled">
                    @foreach ($order->products as $product)
                    <li>{{ $product->pivot->amount }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $order->orderDate }}</td>
            <td>{{ $order->totalPrice }} $</td>
            <td>{{ $order->state }}</td>
        </tr>
        @endforeach
    </table>
</div>
<div id="main-container"></div>
@endsection