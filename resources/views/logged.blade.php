@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <body>
            <h1 class="mb-3">PRODUCTS</h1>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <form action="{{ route('cart.addToCart', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-warning btn-sm" type="submit">Buy</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
    </div>
@endsection
