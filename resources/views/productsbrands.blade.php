@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="mb-3">BRANDS</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($brands as $brand)
                <div class="col">
                    <a href="{{ route('brand.products', $brand->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 text-white bg-dark">
                            <div class="card-body">
                                <h5 class="card-title">{{ $brand->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
    <div id="main-container"></div>
@endsection
