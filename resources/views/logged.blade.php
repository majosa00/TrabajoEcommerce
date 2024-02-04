@extends('layaouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">PRODUCTS</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 text-white bg-dark">
                        <img src="{{ asset('images/redbull.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->udpack }} uds. | {{ $product->price }} $</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{ route('cart.addToCart', $product->id) }}" method="POST"
                                    class="d-flex justify-content-start">
                                    @csrf
                                    <button class="btn btn-warning" type="submit"><i class="fas fa-shopping-cart"></i> Add
                                        to
                                        Cart</button>
                                </form>
                                <!-- Mientras, pongo esa ruta para que no me de fallo -->
                                <form action="{{ route('cart.addToCart', $product->id) }}" method="POST"
                                    class="d-flex justify-content-end">
                                    @csrf
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-heart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
