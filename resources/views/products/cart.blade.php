@extends('layouts.app')

@section('content')
    <div class="container p-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('mensaje'))
            <div class="alert alert-info">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="row" id="ocultar">
            <div class="col-lg-3 col-md-3 col-sm-2">
                <h4>Cart</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2">
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <h4>Price</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <h4>Amount</h4>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2">
            </div>
        </div>
        <hr>

        @foreach ($products as $product)
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <img src="{{ asset('images/redbull.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-4">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                    <p>{{ $product->price }} $</p>
                </div>
                <div class="col-lg-2 col-md-10 col-sm-10 col-3">
                    <div class="d-flex align-items-center">
                        <form action="{{ route('cart.decrease', $product->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm border border-dark">
                                <i class="fas fa-minus"></i>
                            </button>
                        </form>
                        <span id="amount{{ $product->id }}" class="amount mx-2">{{ $product->pivot->amount }}</span>
                        <form action="{{ route('cart.increase', $product->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm border border-dark">
                                <i class="fas fa-plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-2 col-2">
                    <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning text-decoration-none"><i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <hr>
        @endforeach

        <div class="row">
            <div class="col-lg-3 col-md-3">
                <form action="{{ route('cart.viewShipping') }}" method="POST" class="mt-3">
                    @csrf
                    <button class="btn btn-warning btn-sm" type="submit" {{ $products->isEmpty() ? 'disabled' : '' }}>
                        Payment
                    </button>
                </form>
            </div>
            <div class="col-lg-3 col-md-3">
            </div>
            <div class="col-lg-3 col-md-3">
            </div>
            <div class="col-lg-3 col-md-3">
                <h4>Total Price:
                    {{ $products->sum(function ($product) {
                        return $product->price * $product->pivot->amount;
                    }) }}
                </h4>
            </div>
        </div>
    </div>
    <div id="main-container"></div>
@endsection
