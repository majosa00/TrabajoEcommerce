@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">PRODUCTS</h1>
        <a href="{{ url('admin/new_product') }}" class="btn btn-warning mb-4">
            <i class="fas fa-plus"></i> New Product </a>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td><a href="{{ url('admin/products', $product->id) }}" class="btn btn-primary btn-sm"><i
                                    class="fas fa-eye"></i> Details </a></td>
                        <td><a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit </a>
                        </td>
                        <td>
                            <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-trash-alt"></i> Delete </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
