<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h2>Editando la nota {{ $product->id }}</h2>
    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
        @csrf
        {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        @error('title')
            <div class="alert alert-danger"> El nombre es obligatorio </div>
        @enderror
        @error('text')
            <div class="alert alert-danger"> La descripción es obligatoria </div>
        @enderror
        <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
            placeholder="Nombre de la nota" autofocus>
        <input type="text" name="description" placeholder="Descripción de la nota" class="form-control mb-2"
            value="{{ $product->description }}">
        <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
    </form>
</body>

</html>