@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <table class="table table-responsive-sm table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="2">Product Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Flavor</th>
                    <td>{{ $product->flavor }}</td>
                </tr>
                <tr>
                    <th scope="row">Brand</th>
                    <td>{{ $product->brand }}</td>
                </tr>
                <tr>
                    <th scope="row">Price</th>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <th scope="row">Dimension</th>
                    <td>{{ $product->dimension }}</td>
                </tr>
                <tr>
                    <th scope="row">Units per package</th>
                    <td>{{ $product->udpack }}</td>
                </tr>
                <tr>
                    <th scope="row">Weight</th>
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
