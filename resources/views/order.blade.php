@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">ORDERS</h1>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th>State</th>
                </tr>
            </thead>
            @foreach ($ordersByID as $orderByID)
                <tr>
                    <td>{{ $orderByID->id }}</td>
                    <td>{{ $orderByID->orderDate }}</td>
                    <td>{{ $orderByID->totalPrice }} $</td>
                    <td>{{ $orderByID->state }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
