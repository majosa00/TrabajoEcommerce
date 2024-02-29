@extends('layouts.app')

@section('content')
    <div id="main-container">
        <div class="container p-5 ticket">
            <div class="company-info">
                <img src="{{ asset('images/logoticket.png') }}" alt="Logo" class="footer-logo company-logo">
            </div>
            <div class="ticket-details">
                <div class="ticket-header">
                    <p class="order-id">ID Order: {{ $order->id }}</p>
                    <p class="order-date">Order Date: {{ $order->orderDate }}</p>
                </div>
                <ul class="product-list">
                    @foreach ($order->products as $product)
                        <li class="product-item">
                            <span class="product-name">{{ $product->name }}</span>
                            <span class="product-price">{{ $product->price }} $</span>
                            <span class="product-amount">x {{ $product->pivot->amount }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="order-summary">
                    <p class="address">Address: {{ $order->address }}</p>
                    <p>Total Price: ${{ $order->totalPrice }}</p>
                    <p class="order-state">State: {{ $order->state }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
