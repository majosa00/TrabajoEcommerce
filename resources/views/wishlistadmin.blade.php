@extends('layouts.app2')
@section('content')
    <div class="container p-5">
        <h1 class="mb-3">Top 5 Wishlist Products</h1>

        @if ($topProducts->isEmpty())
            <div class="alert alert-warning" role="alert">
                No products in wishlist yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover stylish-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Wishlist Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topProducts as $product)
                            @if ($product->wishlists_count > 0)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }} $</td>
                                    <td>{{ $product->wishlists_count }}</td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
