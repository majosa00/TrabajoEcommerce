@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h2 class="mb-3">Edit Product: {{ $product->name }}</h2>
        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
            @csrf
            {{-- Cláusula para obtener un token de formulario al enviarlo --}}

            {{-- Validación errores --}}
            @error('name')
                <div class="alert alert-danger"> The name is required </div>
            @enderror
            @error('description')
                <div class="alert alert-danger"> The description is required </div>
            @enderror
            @error('flavor')
                <div class="alert alert-danger"> The flavor is required </div>
            @enderror
            @error('brand')
                <div class="alert alert-danger"> The brand is required </div>
            @enderror
            @error('price')
                <div class="alert alert-danger"> The price is required and must be numeric </div>
            @enderror
            @error('dimension')
                <div class="alert alert-danger"> The dimension is required and must be numeric </div>
            @enderror
            @error('udpack')
                <div class="alert alert-danger"> The udpack is required and must be an integer </div>
            @enderror
            @error('weight')
                <div class="alert alert-danger"> The weight is required and must be numeric </div>
            @enderror
            @error('stock')
                <div class="alert alert-danger"> The stock is required and must be an integer </div>
            @enderror
            @error('iva')
                <div class="alert alert-danger"> The VAT is required and must be numeric </div>
            @enderror

            {{-- Formulario --}}
            <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
                placeholder="Product Name" autofocus>
            <input type="text" name="description" placeholder="Product Description" class="form-control mb-2"
                value="{{ $product->description }}">
            <input type="text" name="flavor" placeholder="Product Flavor" class="form-control mb-2"
                value="{{ $product->flavor }}">
            <input type="text" name="brand" placeholder="Product Brand" class="form-control mb-2"
                value="{{ $product->brand }}">
            <input type="text" name="price" placeholder="Product Price" class="form-control mb-2"
                value="{{ $product->price }}">
            <input type="text" name="dimension" placeholder="Product Dimension" class="form-control mb-2"
                value="{{ $product->dimension }}">
            <input type="text" name="udpack" placeholder="Product UDPack" class="form-control mb-2"
                value="{{ $product->udpack }}">
            <input type="text" name="weight" placeholder="Product Weight" class="form-control mb-2"
                value="{{ $product->weight }}">
            <input type="text" name="stock" placeholder="Product Stock" class="form-control mb-2"
                value="{{ $product->stock }}">
            <input type="text" name="iva" placeholder="Product VAT" class="form-control mb-2"
                value="{{ $product->iva }}">

            <button class="btn btn-warning btn-block mt-2" type="submit">Save Changes</button>
    </div>
    </div>
@endsection

