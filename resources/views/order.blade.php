@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">ORDERS</h1>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Products</th>
                    <th>Address</th>
                    <th>Amount</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th>State</th>
                    <th>Ticket</th>
                    <th>Generate Invoice</th>
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
                    <td>{{ $order->address }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach ($order->products as $product)
                                <li>{{ $product->pivot->amount }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->orderDate }}</td>
                    <td class="product-price">
                        ${{ $order->totalPrice }}
                    </td>
                    <td>{{ $order->state }}</td>
                    <td><a href="{{ route('order.showticket', $order->id) }}" class="text-dark">Ticket</a></td>
                    <td>
                        <a href="{{ route('order.generateInvoice', $order->id) }}" class="text-dark">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div id="main-container"></div>
@endsection
