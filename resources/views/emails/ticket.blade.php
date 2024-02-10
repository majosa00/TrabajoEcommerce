@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="ticket">
            <div class="ticket-header">
                <h2>Ticket de Compra</h2>
            </div>

            <div class="ticket-details">
                <p><strong>Fecha:</strong> {{ $order->orderDate }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->totalPrice, 2) }}</p>
                <p><strong>Dirección de Envío:</strong> {{ $order->address ?: 'No especificada' }}</p>
            </div>

            <div class="ticket-products">
                <h3>Productos:</h3>
                @foreach ($order->products as $product)
                    <div class="product-item">
                        <p><strong>{{ $product->name }}</strong></p>
                        <p>Cantidad: {{ $product->pivot->amount }}</p>
                        <p>Precio: ${{ number_format($product->price, 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
