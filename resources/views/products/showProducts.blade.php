@extends('layouts.app2')

@section('content')
    <div class="container p-5">
        <div class="card bg-dark text-white">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}"
                        class="card-img" alt="{{ $product->name }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">{{ $product->name }}</h3>
                        <p class="card-text">Description: {{ $product->description }}</p>
                        <p class="card-text">Flavor: {{ $product->flavor }}</p>
                        <p class="card-text">Dimension: {{ $product->dimension }}</p>
                        <p class="card-text">Units per Pack: {{ $product->udpack }}</p>
                        <p class="card-text">Weight: {{ $product->weight }}</p>
                        <p class="card-text">Stock: {{ $product->stock }}</p>
                        <p class="card-text">IVA: {{ $product->iva }}</p>
                        <h4 class="card-text">Price: {{ $product->price }} $</h4>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <form action="{{ route('cart.addToCart', $product->id) }}" method="POST"
                                    class="d-flex justify-content-start">
                                    @csrf
                                    <button class="btn btn-warning btn-lg" type="submit"><i
                                            class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                    class="d-flex justify-content-end">
                                    @csrf
                                    <button id="wishlistBtn{{ $product->id }}" class="btn btn-warning btn-lg">
                                        <span id="heartIcon{{ $product->id }}"
                                            class="heartIcon {{ $product->wishlist->isEmpty() ? 'far' : 'fas' }} fa-heart"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-container"></div>
@endsection
