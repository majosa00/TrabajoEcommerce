@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <h4>Cart</h4>
            </div>
            <div class="col-lg-3 col-md-3">
            </div>
            <div class="col-lg-3 col-md-3">
                <h4>Price</h4>
            </div>
            <div class="col-lg-3 col-md-3">
                <h4>Amount</h4>
            </div>
        </div>
        <hr>

        @foreach ($products as $product)
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <img src="{{ asset('images/redbull.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                </div>
                <div class="col-lg-3 col-md-3">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <a href="{{ route('cart.remove', $product->id) }}" class="text-decoration-none">Remove</a>
                </div>
                <div class="col-lg-3 col-md-3">
                    <p>{{ $product->price }} $</p>
                </div>
                <div class="col-lg-3 col-md-3">
                    <button class="btn btn-sm border border-dark" onclick="less({{ $product->id }})">
                        <i class="fas fa-minus"></i>
                    </button>
                    <span id="amount{{ $product->id }}" class="amount">{{ $product->pivot->amount }}</span>
                    <button class="btn btn-sm border border-dark" onclick="more({{ $product->id }})">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <hr>
        @endforeach

        <div class="row">
            <div class="col-lg-3 col-md-3">
                <form action="{{ route('cart.pay') }}" method="POST" class="mt-3">
                    @csrf
                    <button class="btn btn-warning btn-sm" type="submit">Payment</button>
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
                    $
                </h4>
            </div>
        </div>

    </div>
@endsection
