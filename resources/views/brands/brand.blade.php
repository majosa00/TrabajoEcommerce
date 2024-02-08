@extends('layaouts.app2')

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
        <div class="modal fade" id="newBrandModal" tabindex="-1" aria-labelledby="newBrandModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title">Add New Brand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('brands.createBrand') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                <div class="invalid-feedback">
                                    Please enter the brand name.
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
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteBrandModal{{ $brand->id }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
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
                                    <form action="{{ route('brands.updateBrand', $brand->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf

                                        {{-- Validación errores --}}
                                        @error('name')
                                            <div class="alert alert-danger">The name is required</div>
                                        @enderror

                                        {{-- Formulario --}}
                                        <input type="text" name="name" class="form-control mb-2"
                                            value="{{ $brand->name }}" placeholder="Brand Name" autofocus>

                                        <button class="btn btn-warning btn-block mt-2" type="submit">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>




@endsection
