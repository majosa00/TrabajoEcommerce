@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Sección de Productos Más Vendidos -->
        <div class="mt-5">
            <h1 class="mb-3">{{ __('messages.products_best') }}</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($topSellingProducts as $product)
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
                                        <button class="btn btn-warning" type="submit"><i class="fas fa-shopping-cart"></i>
                                            {{ __('messages.add_to_cart') }}</button>
                                    </form>
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                        class="d-flex justify-content-end">
                                        @csrf
                                        <button id="wishlistBtn{{ $product->id }}" class="wishlistBtn"
                                            onclick="toggleWishlist({{ $product->id }})">
                                            <span id="heartIcon{{ $product->id }}" class="heartIcon far fa-heart"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección de Todos los Productos -->
        <div class="mt-5">
            <h1 class="mb-3">{{ __('messages.products') }}</h1>
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
                                        <button class="btn btn-warning" type="submit"><i class="fas fa-shopping-cart"></i>
                                            {{ __('messages.add_to_cart') }}</button>
                                    </form>
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                        class="d-flex justify-content-end">
                                        @csrf
                                        <button id="wishlistBtn{{ $product->id }}" class="wishlistBtn"
                                            onclick="toggleWishlist({{ $product->id }})">
                                            <span id="heartIcon{{ $product->id }}" class="heartIcon far fa-heart"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
