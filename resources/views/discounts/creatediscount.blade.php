{{-- resources/views/coupon.blade.php --}}
@extends('layouts.app2')

@section('content')
    <div id="main-container">
        <div class="container p-5">
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

            <section id="discounts">
                <h1 class="mb-3">Create Coupons</h1>
                <div class="accordion" id="couponAccordion">
                    {{-- Cupones descuento simples --}}
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-black" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Create Simple Discount Coupon
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#couponAccordion">
                            <div class="card-body">
                                <form id="simpleCouponForm" action="{{ route('admin.store_simple') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="code">Coupon Code</label>
                                        <input type="text" class="form-control" id="code" name="code" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="value">Discount Value (%)</label>
                                        <input type="number" class="form-control" id="value" name="value" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_users">Maximum Number of Users</label>
                                        <input type="number" class="form-control" id="max_users" name="max_users" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-3">Create Simple Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Cupones descuento por categoría --}}
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-black" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Create Discount Coupon by Category
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#couponAccordion">
                            <div class="card-body">
                                <form id="categoryCouponForm" action="{{ route('admin.store_category') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category_code">Coupon Code</label>
                                        <input type="text" class="form-control" id="category_code" name="code"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="brand_id" required>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_value">Discount Value (%)</label>
                                        <input type="number" class="form-control" id="category_value" name="value"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_start_date">Start Date</label>
                                        <input type="date" class="form-control" id="category_start_date"
                                            name="start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_end_date">End Date</label>
                                        <input type="date" class="form-control" id="category_end_date"
                                            name="end_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_max_users">Maximum Number of Users</label>
                                        <input type="number" class="form-control" id="category_max_users"
                                            name="max_users" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-3">Create Coupon by Category</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Cupones descuento para productos específicos (ofertas) --}}
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-black" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Create Offer for Product
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#couponAccordion">
                            <div class="card-body">
                                <form id="productCouponForm" action="{{ route('admin.store_product') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="product_code">Coupon Code</label>
                                        <input type="text" class="form-control" id="product_code" name="code"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product">Product</label>
                                        <select class="form-control" id="product" name="product_id" required>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_value">Discount Value (%)</label>
                                        <input type="number" class="form-control" id="product_value" name="value"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_start_date">Start Date</label>
                                        <input type="date" class="form-control" id="product_start_date"
                                            name="start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_end_date">End Date</label>
                                        <input type="date" class="form-control" id="product_end_date" name="end_date"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_max_users">Maximum Number of Users</label>
                                        <input type="number" class="form-control" id="product_max_users"
                                            name="max_users" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-3">Create Offer for Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
