@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">CART</h1>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Price</th>
                </tr>
            </thead>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->pivot->amount }}</td>
                    <td>{{ $product->price }} $</td>
                </tr>
            @endforeach
        </table>

        <h3>Total Price: {{ $products->sum('price') }} $ </h3>
        <form action="{{ route('cart.pay') }}" method="POST" class="mt-3">
            @csrf
            <button class="btn btn-warning btn-sm" type="submit">Payment</button>
        </form>
    </div>
@endsection
