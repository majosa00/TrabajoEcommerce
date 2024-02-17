@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">Wishlist</h1> <!-- Traducción para "Lista de Deseos" -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($wishlists as $wishlist)
                <div class="col">
                    <div class="card h-100 text-white bg-dark">
                        <img src="">
                        <div class="card-body">
                            @foreach ($wishlist->products as $product)
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">{{ $product->udpack }} uds. |
                                    {{ $product->price }}
                                    $
                                </p>
                                <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST"
                                    class="d-flex justify-content-end">
                                    @csrf
                                    <!-- Traducción para "Eliminar de la Lista de Deseos" -->
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <p>{{ __('No items') }}</p>
            @endforelse
        </div>
        {{ $wishlists->links() }}
    </div>
    <div id="main-container"></div>
@endsection
