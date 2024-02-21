@extends('layouts.app2')

@section('content')
    <div class="container p-5">
        {{-- <div class="card bg-dark text-white">
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
        </div> --}}

        <section id="specificproduct" class="product">
            <div class="product__photo">
                <div class="photo-container">
                    <div class="photo-main">
                        <div class="controls">
                            <i class="material-icons">share</i>
                            <i class="material-icons">favorite_border</i>
                        </div>
                        <img src="{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}"
                            class="card-img" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
            <div class="product__info">
                <div class="title">
                    <h1>Delicious Apples</h1>
                    <span>COD: 45999</span>
                </div>
                <div class="price">
                    $ <span>{{ $product->price }} </span>
                </div>
                <div class="description">
                    <h3>BENEFITS</h3>
                    <ul>
                        <li>Apples are nutricious</li>
                        <li>Apples may be good for weight loss</li>
                        <li>Apples may be good for bone health</li>
                        <li>They're linked to a lowest risk of diabetes</li>
                    </ul>
                </div>
                <button class="buy--btn">ADD TO CART</button>
            </div>
        </section>


    </div>
    <div id="main-container"></div>
@endsection
