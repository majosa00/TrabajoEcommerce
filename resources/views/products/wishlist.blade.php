@extends('layouts.app')

@section('content')
    <div id="main-container">
        <div class="container">
            <section class="section-products">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h1 class="mb-3">WISHLIST</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($wishlists as $wishlist)
                        @foreach ($wishlist->products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <a href="{{ route('products.show', $product->id) }}" class="no-underline">
                                    <div class="single-product bg-negro text-white p-4"
                                        style="background-image: url('{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}');">
                                        <div class="part-1">
                                            <ul>
                                                <li>
                                                    <!-- Formulario para agregar al carrito -->
                                                    <form action="{{ route('cart.addToCart', $product->id) }}"
                                                        method="POST" class="d-flex justify-content-start">
                                                        @csrf
                                                        <button class="btn btn-warning" type="submit"><i
                                                                class="fas fa-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <!-- Formulario para agregar a la lista de deseos -->
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
                                            <h4 class="product-price">${{ $product->price }}</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @empty
                        <div class="col-12">
                            <p>{{ __('No items') }}</p>
                        </div>
                    @endforelse
                </div>
            </section>
            {{ $wishlists->links() }}
        </div>
    </div>
@endsection
