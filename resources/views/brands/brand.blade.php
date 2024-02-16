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

        <!-- Modal para añadir nueva marca -->
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
                            <button class="btn btn-warning mt-4" type="submit">Add Brand</button>
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
                            <!-- Botón para abrir el modal de edición -->
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editBrandModal{{ $brand->id }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <!-- Botón para abrir el modal de confirmación de eliminación -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteBrandModal{{ $brand->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal para editar marca -->
                    <div class="modal fade" id="editBrandModal{{ $brand->id }}" tabindex="-1"
                        aria-labelledby="editBrandModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBrandModalLabel">Edit Brand: {{ $brand->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate method="POST"
                                        action="{{ route('brands.updateBrand', $brand->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $brand->name }}" required>
                                            <div class="invalid-feedback">
                                                Please enter the brand name.
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning mt-4">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de confirmación de eliminación -->
                    <div class="modal fade" id="deleteBrandModal{{ $brand->id }}" tabindex="-1"
                        aria-labelledby="deleteBrandModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteBrandModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this brand: "{{ $brand->name }}"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('brands.deleteBrand', $brand->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
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
    <div id="main-container"></div>
@endsection
