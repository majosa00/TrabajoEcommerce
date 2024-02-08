@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ __('Lista de Deseos') }}</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($wishlists as $wishlist)
            <div class="col">
                <div class="card h-100 text-white bg-dark">
                    <!-- Asegúrate de tener una columna o una manera de obtener la imagen del producto -->
                    <img src="{{ asset('storage/'.$wishlist->product->image) }}" class="card-img-top" alt="{{ $wishlist->product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $wishlist->product->name }}</h5>
                        <p class="card-text">{{ $wishlist->product->description }}</p>
                        <p class="card-text">{{ $wishlist->product->udpack }} uds. | {{ $wishlist->product->price }} $</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="{{ route('cart.addToCart', $wishlist->product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-warning" type="submit">
                                    <i class="fas fa-shopping-cart"></i> {{ __('Agregar al Carrito') }}
                                </button>
                            </form>
                            <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST">
                                @csrf
                                @method('DELETE') <!-- Cambiar a POST si tu ruta espera un POST -->
                                <button class="btn btn-danger" type="submit">
                                    <i class="fas fa-times"></i> {{ __('Eliminar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <p>{{ __('Tu lista de deseos está vacía.') }}</p>
            </div>
        @endforelse
    </div>
</div>
@endsection