{{-- resources/views/products/cart.blade.php --}}
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->pivot->amount }}</td>
                        <td>{{ $product->price }} $</td>
                        <td>
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total Price:
            {{ $products->sum(function ($product) {
                return $product->price * $product->pivot->amount;
            }) }} $
        </h3>
        <form action="{{ route('cart.pay') }}" method="POST" class="mt-3">
            @csrf
            <button class="btn btn-warning btn-sm" type="submit">Payment</button>
        </form>
    </div>
@endsection
