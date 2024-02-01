@extends('layaouts.app')

@section('content')
    <div class="container">
        <table class="table table-responsive-sm table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="2">Detalles del Producto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Nombre</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Descripción</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Sabor</th>
                    <td>{{ $product->flavor }}</td>
                </tr>
                <tr>
                    <th scope="row">Marca</th>
                    <td>{{ $product->brand }}</td>
                </tr>
                <tr>
                    <th scope="row">Precio</th>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <th scope="row">Dimensión</th>
                    <td>{{ $product->dimension }}</td>
                </tr>
                <tr>
                    <th scope="row">Unidades por Paquete</th>
                    <td>{{ $product->udpack }}</td>
                </tr>
                <tr>
                    <th scope="row">Peso</th>
                    <td>{{ $product->weight }}</td>
                </tr>
                <tr>
                    <th scope="row">Stock</th>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th scope="row">IVA</th>
                    <td>{{ $product->iva }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
