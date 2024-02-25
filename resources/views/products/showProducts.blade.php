@extends('layouts.app')

@section('content')
    <div class="container p-5">

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
        
        <section id="specificproduct" class="product">
            <div class="product__photo">
                <div class="photo-container">
                    <div class="photo-main">
                        <img src="{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}"
                            class="card-img" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
            <div class="product__info">
                <div class="title">
                    <h1 class="text-warning">{{ $product->name }}</h1>
                    <span class="text-white">{{ $product->description }}</span>
                </div>
                <div class="price">
                    @if ($product->brand_id === 'Monster')
                        <del>${{ $product->original_price }}</del> <span class="text-danger">${{ $product->discounted_price }}</span>
                    @else
                        $ <span>{{ $product->price }} </span>
                    @endif
                </div>
                <div class="description">
                    <h3 class="text-warning">DESCRIPTION</h3>
                    <ul class="text-white">
                        <li>Ingredient: {{ $product->ingredient }}</li>
                        <li>Flavor: {{ $product->flavor }}</li>
                        <li>Units per Pack: {{ $product->udpack }} uts.</li>
                        <li>Weight: {{ $product->weight }} g.</li>
                    </ul>
                </div>
                <form action="{{ route('cart.addToCart', $product->id) }}" method="POST"
                    class="d-flex justify-content-start">
                    @csrf
                    <button class="buy--btn btn-warning" type="submit"><i class="fas fa-shopping-cart"></i>
                    </button>
                </form>
            </div>
        </section>


    </div>
    <div id="main-container"></div>
@endsection
