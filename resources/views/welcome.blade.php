@extends('layouts.app3')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/bluechamaleon.png') }}" class="d-block w-50 mx-auto img-fluid"
                                alt="Blue Chamaleon">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/redbull.png') }}" class="d-block w-50 mx-auto img-fluid"
                                alt="Red Bull">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/monster.png') }}" class="d-block w-50 mx-auto img-fluid"
                                alt="Monster">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/burnenergydrink.png') }}" class="d-block w-50 mx-auto img-fluid"
                                alt="Burn Energy Drink">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-warning" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-warning" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <section class="section-products2">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header">
                        <h2>{{ __('messages.products') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Single Product -->
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-6 col-xl-3 col-12">
                        <div class="single-product bg-negro text-white p-4"
                            style="background-image: url('{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}');">
                            <div class="part-1">
                                {{-- PARA LOS DESCUENTOS <span class="discount">15% off</span> --}}
                            </div>
                            <div class="part-2">
                                <h3 class="product-title">{{ $product->name }}</h3>
                                {{-- PARA LOS DESCUENTOS <h4 class="product-old-price">$79.99</h4> --}}
                                <h4 class="product-price">{{ $product->price }} $</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-warning">Products</a>
            </div>
        </section>


        <section id="brandslandingpage">
            <!-- Sección de todas las marcas -->
            <div class="row mt-4">
                <section class="section-products">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="header">
                                <h2>BRANDS</h2>
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

            <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-warning">Brands</a>
            </div>
        </section>

    </div>
    <div id="main-container"></div>
@endsection
