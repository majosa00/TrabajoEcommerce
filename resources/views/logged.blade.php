@extends('layouts.app')

@section('content')
<div id="main-container">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Sección de Productos Más Vendidos -->
        <div class="row">
            <section class="section-products">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h1 class="mb-3">{{ __('messages.products_best') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($topSellingProducts as $product)
                        @php
                            $hasDiscount = false;
                            $discountValue = 0;
                            $discountCode = '';
                            foreach ($discounts as $discount) {
                                if (($discount->type === 'product' && $discount->product_id === $product->id) ||
                                    ($discount->type === 'category' && $discount->brand_id === $product->brand_id)) {
                                    $hasDiscount = true;
                                    $discountValue = $discount->value; 
                                    $discountCode = $discount->code; 
                                    break;
                                }
                            }
                            $finalPrice = $hasDiscount ? $product->price * (1 - $discountValue / 100) : $product->price;
                        @endphp
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <a href="{{ route('products.show', $product->id) }}" class="no-underline">
                                <div class="single-product bg-negro text-white p-4"
                                    style="background-image: url('{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}');">
                                    <div class="part-1">
                                        @if ($hasDiscount && !empty($discountCode))
                                            <span class="discount">{{ $discountCode }}</span>
                                        @endif
                                        <ul>
                                            <li>
                                                <form action="{{ route('cart.addToCart', $product->id) }}" method="POST" class="d-flex justify-content-start">
                                                    @csrf
                                                    <button class="btn btn-warning" type="submit"><i class="fas fa-shopping-cart"></i></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-flex justify-content-end">
                                                    @csrf
                                                    <button id="wishlistBtn{{ $product->id }}" class="btn btn-warning">
                                                        <span id="heartIcon{{ $product->id }}" class="heartIcon {{ $product->wishlist->isEmpty() ? 'far' : 'fas' }} fa-heart"></span>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="part-2">
                                        <h3 class="product-title">{{ $product->name }}</h3>
                                        @if ($hasDiscount)
                                            <h4 class="product-price">
                                                <s style="color: red;">${{ number_format($product->price, 2) }}</s>
                                                <span style="color: white; font-size: 1.25em;">${{ number_format($finalPrice, 2) }}</span>
                                            </h4>
                                        @else
                                            <h4 class="product-price">${{ number_format($product->price, 2) }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </a>
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
                    @foreach ($products as $product)
                        @php
                            $hasDiscount = false;
                            $discountValue = 0;
                            $discountCode = '';
                            foreach ($discounts as $discount) {
                                if (($discount->type === 'product' && $discount->product_id === $product->id) ||
                                    ($discount->type === 'category' && $discount->brand_id === $product->brand_id)) {
                                    $hasDiscount = true;
                                    $discountValue = $discount->value;
                                    $discountCode = $discount->code; 
                                    break;
                                }
                            }
                            $finalPrice = $hasDiscount ? $product->price * (1 - $discountValue / 100) : $product->price;
                        @endphp
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <a href="{{ route('products.show', $product->id) }}" class="no-underline">
                                <div class="single-product bg-negro text-white p-4"
                                    style="background-image: url('{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}');">
                                    <div class="part-1">
                                        @if ($hasDiscount && !empty($discountCode))
                                            <span class="discount">{{ $discountCode }}</span>
                                        @endif
                                        <ul>
                                            <li>
                                                <form action="{{ route('cart.addToCart', $product->id) }}" method="POST" class="d-flex justify-content-start">
                                                    @csrf
                                                    <button class="btn btn-warning" type="submit"><i class="fas fa-shopping-cart"></i></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-flex justify-content-end">
                                                    @csrf
                                                    <button id="wishlistBtn{{ $product->id }}" class="btn btn-warning">
                                                        <span id="heartIcon{{ $product->id }}" class="heartIcon {{ $product->wishlist->isEmpty() ? 'far' : 'fas' }} fa-heart"></span>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="part-2">
                                        <h3 class="product-title">{{ $product->name }}</h3>
                                        @if ($hasDiscount)
                                            <h4 class="product-price">
                                                <s style="color: red;">${{ number_format($product->price, 2) }}</s>
                                                <span style="color: white; font-size: 1.25em;">${{ number_format($finalPrice, 2) }}</span>
                                            </h4>
                                        @else
                                            <h4 class="product-price">${{ number_format($product->price, 2) }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
