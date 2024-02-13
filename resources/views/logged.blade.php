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
                        <div class="cardproducts h-100 text-white bg-dark">
                            <img src="{{ asset('images/redbull.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="cardproducts-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="cardproducts-text">{{ $product->description }}</p>
                                <p class="cardproducts-text">{{ $product->udpack }} uds. | {{ $product->price }} $</p>
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
        <div class="row mt-4">
            <section class="section-products">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h2>{{ __('messages.products') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Single Product -->
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3 ">
                            <div id="product-{{ $product->id }}" class="single-product bg-dark text-white p-4"
                                style="background-image: url('{{ asset("images/products/{$product->id}.jpg") }}')">
                                <div class="part-1">
                                    {{-- PARA LOS DESCUENTOS <span class="discount">15% off</span> --}}
                                    <ul>
                                        <li>
                                            <form action="{{ route('cart.addToCart', $product->id) }}" method="POST"
                                                class="d-flex justify-content-start">
                                                @csrf
                                                <button class="btn btn-warning" type="submit"><i
                                                        class="fas fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                                class="d-flex justify-content-end">
                                                @csrf
                                                <button id="wishlistBtn{{ $product->id }}" class="btn btn-warning"
                                                    onclick="toggleWishlist({{ $product->id }})">
                                                    <span id="heartIcon{{ $product->id }}" class="far fa-heart"></span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="part-2">
                                    <h3 class="product-title">{{ $product->name }}</h3>
                                    {{-- PARA LOS DESCUENTOS <h4 class="product-old-price">$79.99</h4> --}}
                                    <h4 class="product-price">{{ $product->price }} $</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
