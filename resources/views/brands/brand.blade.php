@extends('layouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">BRANDS</h1>
        @if (session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="#" class="btn btn-warning mb-4" data-bs-toggle="modal" data-bs-target="#newBrandModal">
            <i class="fas fa-plus"></i> New Brand
        </a>

        <!-- Modal nueva marca -->
        <div class="modal fade" id="newBrandModal" tabindex="-1" aria-labelledby="newBrandModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title">Add New Brand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('brands.createBrand') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                                        required>
                                    <div class="invalid-feedback">
                                        Please enter the brand name.
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning mt-4">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#updateBrandModal{{ $brand->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                        <td>
                            <!-- Formulario para eliminar marca -->
                            <form action="{{ route('brands.deleteBrand', $brand->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal edición marca -->
                    <div class="modal fade" id="updateBrandModal{{ $brand->id }}" tabindex="-1"
                        aria-labelledby="updateBrandModalLabel{{ $brand->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Edit Brand: {{ $brand->name }}</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate method="POST"
                                        action="{{ route('brands.updateBrand', $brand->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <label for="name" class="form-label">Name:</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="" value="{{ $brand->name }}" required>
                                                <div class="invalid-feedback">
                                                    Please enter the brand name.
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning mt-4">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        {{ $brands->links() }}
    </div>




@endsection
