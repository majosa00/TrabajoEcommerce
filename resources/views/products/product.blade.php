@extends('layaouts.app')

@section('content')
    <div class="container">
        <h1>PRODUCTOS</h1>
        <a href="{{ url('new_product') }}" class="btn btn-primary">Añadir Nuevo Producto</a>

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
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td><a href="{{ url('products/' . $product->id) }}">Ver detalles</a></td>
                        <td><a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm"> Editar </a></td>
                        <td>
                            <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
