@extends('layaouts.app')

@section('content')
    <div class="container">
        <h2>Editando el producto {{ $product->id }}</h2>
        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
            @csrf
            {{-- Cláusula para obtener un token de formulario al enviarlo --}}

            {{-- Validación errores --}}
            @error('name')
                <div class="alert alert-danger"> El nombre es obligatorio </div>
            @enderror
            @error('description')
                <div class="alert alert-danger"> La descripción es obligatoria </div>
            @enderror
            @error('flavor')
                <div class="alert alert-danger"> El sabor es obligatorio </div>
            @enderror
            @error('brand')
                <div class="alert alert-danger"> La marca es obligatoria </div>
            @enderror
            @error('price')
                <div class="alert alert-danger"> El precio es obligatorio y debe ser numérico </div>
            @enderror
            @error('dimension')
                <div class="alert alert-danger"> La dimensión es obligatoria y debe ser numérica </div>
            @enderror
            @error('udpack')
                <div class="alert alert-danger"> El udpack es obligatorio y debe ser un número entero </div>
            @enderror
            @error('weight')
                <div class="alert alert-danger"> El peso es obligatorio y debe ser numérico </div>
            @enderror
            @error('stock')
                <div class="alert alert-danger"> El stock es obligatorio y debe ser un número entero </div>
            @enderror
            @error('iva')
                <div class="alert alert-danger"> El IVA es obligatorio y debe ser numérico </div>
            @enderror

            {{-- Formulario --}}
            <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
                placeholder="Nombre del producto" autofocus>
            <input type="text" name="description" placeholder="Descripción del producto" class="form-control mb-2"
                value="{{ $product->description }}">
            <input type="text" name="flavor" placeholder="Sabor del producto" class="form-control mb-2"
                value="{{ $product->flavor }}">
            <input type="text" name="brand" placeholder="Marca del producto" class="form-control mb-2"
                value="{{ $product->brand }}">
            <input type="text" name="price" placeholder="Precio del producto" class="form-control mb-2"
                value="{{ $product->price }}">
            <input type="text" name="dimension" placeholder="Dimensión del producto" class="form-control mb-2"
                value="{{ $product->dimension }}">
            <input type="text" name="udpack" placeholder="UDPack del producto" class="form-control mb-2"
                value="{{ $product->udpack }}">
            <input type="text" name="weight" placeholder="Peso del producto" class="form-control mb-2"
                value="{{ $product->weight }}">
            <input type="text" name="stock" placeholder="Stock del producto" class="form-control mb-2"
                value="{{ $product->stock }}">
            <input type="text" name="iva" placeholder="IVA del producto" class="form-control mb-2"
                value="{{ $product->iva }}">

            <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
        </form>
    </div>
    </div>
@endsection
