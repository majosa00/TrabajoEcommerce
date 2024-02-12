@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">Wishlist</h1> <!-- Traducción para "Lista de Deseos" -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($wishlists as $wishlist)
                <div class="col">
                    <div class="card h-100 text-white bg-dark">
                        <img src="{{ asset('path/to/your/image/directory/' . $wishlist->product->image) }}" class="card-img-top"
                            alt="{{ $wishlist->product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $wishlist->product->name }}</h5>
                            <p class="card-text">{{ $wishlist->product->description }}</p>
                            <p class="card-text">{{ $wishlist->product->udpack }} uds. | {{ $wishlist->product->price }} $
                            </p>
                            <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST"
                                class="d-flex justify-content-end">
                                @csrf
                                
                                <!-- Traducción para "Eliminar de la Lista de Deseos" -->
                            </form>
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
