@extends('layouts.app2')

@section('content')
    <div id="main-container">
        <div class="container p-5">
            <section id="orderadmin">
                <h1 class="mb-3">ORDERS</h1>
                <div class="table-responsive">
                    <table class="table table-hover stylish-table">
                        <thead>
                            <tr>
                                <th>ID User</th>
                                <th>User</th>
                                <th>Address</th>
                                <th>ID Order</th>
                                <th>Order Date</th>
                                <th>Total Price</th>
                                <th>State</th>
                            </tr>
                        </thead>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->user }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->orderDate }}</td>
                                <td>${{ $order->totalPrice }}</td>
                                <td>{{ $order->state }}</td>
                            </tr>
                        @endforeach
                </div>
                </table>
            </section>
        </div>
    </div>
@endsection
