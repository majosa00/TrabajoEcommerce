@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">BRANDS</h1>
        <a href="{{ url('admin/new_brand') }}" class="btn btn-warning mb-4">
            <i class="fas fa-plus"></i> New Brand </a>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->name }}</td>
                        <td><a href="{{ url('admin/brands', $brand->id) }}" class="btn btn-primary btn-sm"><i
                                    class="fas fa-eye"></i> Details </a></td>
                        <td><a href="{{ route('brands.editBrand', $brand) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit </a>
                        </td>
                        <td>
                            <form action="{{ route('brands.deleteBrand', $brand->id) }}" method="POST" class="d-inline">
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
