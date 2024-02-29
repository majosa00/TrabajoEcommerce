@extends('layouts.app')

@section('content')
    <div id="main-container">
        <div class="container mt-4">
            @if (session('mensaje'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('mensaje') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Sección de todas las marcas -->
            <div class="row mt-4">
                <section class="section-products">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="header">
                                <h1 class="mb-3">BRANDS</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Single brand -->
                        @foreach ($brands as $brand)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <a href="{{ route('brand.products', $brand->id) }}" class="text-decoration-none">
                                    <div class="single-product bg-negro text-white p-4"
                                        style="background-image: url('{{ optional($brand->images)->imagen_1 ? asset('storage/' . $brand->images->imagen_1) : '' }}');">
                                        <div class="part-3">
                                        </div>
                                        <div class="part-2">
                                            <h5 class="card-title">{{ $brand->name }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
