@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Productos de la marca: {{ $brand->name }}</h2>
    @if($brand->products->isEmpty())
        <p>No hay productos disponibles para esta marca.</p>
    @else
        <div class="row">
            @foreach ($brand->products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <!-- Más información del producto -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
