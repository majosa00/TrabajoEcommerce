@extends('layaouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">BRANDS</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($brands as $brand)
                <div class="col">
                    <a href="" class="text-decoration-none text-dark">
                        <div class="card h-100 text-white bg-dark">
                            <img src="" class="card-img-top" alt="{{ $brand->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $brand->name }}</h5>
                                <!-- Mientras, pongo esa ruta para que no me de fallo -->
                                {{-- <form action="{{ route('cart.addToCart', $product->id) }}" method="POST"
                                    class="d-flex justify-content-end">
                                    @csrf
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-heart"></i></button>
                                </form> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
