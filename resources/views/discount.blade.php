{{-- resources/views/coupon.blade.php --}}
@extends('layouts.app2')

@section('title', 'Gestionar Cupones')

@section('content')
    <div class="container p-5">
        <h1 class="mb-4">Gestionar Cupones</h1>

        {{-- Cupones descuento simples --}}
        <div class="card mb-4">
            <div class="card-header">Crear Cupón de Descuento Simple</div>
            <div class="card-body">
                <form id="simpleCouponForm" action="{{ route('admin.store_simple') }}" method="POST">

                    @csrf
                    <div class="form-group">
                        <label for="code">Código del Cupón</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="value">Valor del Descuento (%)</label>
                        <input type="number" class="form-control" id="value" name="value" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Fecha de Fin</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="max_users">Número Máximo de Usuarios</label>
                        <input type="number" class="form-control" id="max_users" name="max_users" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Cupón Simple</button>
                </form>
            </div>
        </div>


        {{-- Cupones descuento por categoría --}}
        <div class="card mb-4">
            <div class="card-header">Crear Cupón de Descuento por Categoría</div>
            <div class="card-body">
                <form id="categoryCouponForm" action="{{ route('admin.store_category') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category_code">Código del Cupón</label>
                        <input type="text" class="form-control" id="category_code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Categoría</label>
                        <select class="form-control" id="category" name="brand_id" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_value">Valor del Descuento (%)</label>
                        <input type="number" class="form-control" id="category_value" name="value" required>
                    </div>
                    <div class="form-group">
                        <label for="category_start_date">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="category_start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="category_end_date">Fecha de Fin</label>
                        <input type="date" class="form-control" id="category_end_date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="category_max_users">Número Máximo de Usuarios</label>
                        <input type="number" class="form-control" id="category_max_users" name="max_users" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Cupón por Categoría</button>
                </form>
            </div>
        </div>

        {{-- Cupones descuento para productos específicos (ofertas) --}}
        <div class="card">
            <div class="card-header">Crear Oferta para Producto</div>
            <div class="card-body">
                <form id="productCouponForm" action="{{ route('admin.store_product') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_code">Código del Cupón</label>
                        <input type="text" class="form-control" id="product_code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="product">Producto</label>
                        <select class="form-control" id="product" name="product_id" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_value">Valor del Descuento (%)</label>
                        <input type="number" class="form-control" id="product_value" name="value" required>
                    </div>
                    <div class="form-group">
                        <label for="product_start_date">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="product_start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="product_end_date">Fecha de Fin</label>
                        <input type="date" class="form-control" id="product_end_date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="product_max_users">Número Máximo de Usuarios</label>
                        <input type="number" class="form-control" id="product_max_users" name="max_users" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Oferta para Producto</button>
                </form>
            </div>
        </div>



    @endsection
