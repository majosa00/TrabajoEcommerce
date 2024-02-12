@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $brand->name }} Products</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product) 
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $product->image_path ?? 'path/to/default/image' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Price: ${{ $product->price }}</p>
                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }} {
        </div>
    </div>
@endsection
