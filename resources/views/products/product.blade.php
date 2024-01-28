<!DOCTYPE html>
<html>

<head>
    @vite(['resources/js/app.js', 'resources/css/app.scss']) 
</head>


<body>
    <h1>PRODUCTOS</h1>
    <a href="{{ route('products.new') }}" class="btn btn-primary">Añadir Nuevo Producto</a>

    <table border='1' class="table table-responsive">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                
                <th>Detalles</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td><a href="products/{{ $product->id }}">Ver detalles</a></td>
                <td><a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm"> Editar </a>
                </td>
                <td>
                    <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>