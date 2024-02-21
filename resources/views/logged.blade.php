@extends('layouts.app')

@section('content')
    <div class="container ">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Sección de Productos Más Vendidos -->
        <div class="row ">
            <section class="section-products">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h1 class="mb-3">{{ __('messages.products_best') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <!-- Single Product -->
                    @foreach ($topSellingProducts as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3 ">
                            <div class="single-product bg-dark text-white p-4"
                                style="background-image: url('{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}');">
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
                                                <button id="wishlistBtn{{ $product->id }}" class="btn btn-warning">
                                                    <span id="heartIcon{{ $product->id }}"
                                                        class="heartIcon {{ $product->wishlist->isEmpty() ? 'far' : 'fas' }} fa-heart"></span>
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

        <!-- Sección de Todos los Productos -->
        <div class="row mt-4">
            <section class="section-products">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h1>{{ __('messages.products') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Single Product -->
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3 ">
                            <a href="{{ route('products.show', $product->id) }}">
                                <div class="single-product bg-dark text-white p-4"
                                    style="background-image: url('{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}');">
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
                                                    <button id="wishlistBtn{{ $product->id }}" class="btn btn-warning">
                                                        <span id="heartIcon{{ $product->id }}"
                                                            class="heartIcon {{ $product->wishlist->isEmpty() ? 'far' : 'fas' }} fa-heart"></span>
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
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    <div id="main-container"></div>
@endsection
