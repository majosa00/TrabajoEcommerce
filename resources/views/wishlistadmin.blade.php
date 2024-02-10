@extends('layouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">Top 5 Favorited Products</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($topProducts as $product)
                <div class="col">
                    <div class="card h-100 text-white bg-dark">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->udpack }} uds. | ${{ $product->price }}</p>
                            <!-- Detalles adicionales como acciones administrativas podrían agregarse aquí -->
                        </div>
                    </div>
                </div>
            @empty
                <p>No products have been favorited yet.</p>
            @endforelse
        </div>
    </div>
@endsection
