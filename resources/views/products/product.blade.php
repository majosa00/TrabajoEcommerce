@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">PRODUCTS</h1>
        <a href="#" class="btn btn-warning mb-4" data-bs-toggle="modal" data-bs-target="#newProductModal">
            <i class="fas fa-plus"></i> New Product
        </a>

        <!-- Modal nuevo producto -->
        <div class="modal fade" id="newProductModal" tabindex="-1" aria-labelledby="newProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title">Add New Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.create') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                <div class="invalid-feedback">
                                    Please enter the product name.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter a product description.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="flavor">Flavor:</label>
                                <input type="text" class="form-control" name="flavor" id="flavor" required>
                                <div class="invalid-feedback">
                                    Please enter the product flavor.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="brand">Brand:</label>
                                <input type="text" class="form-control" name="brand" id="brand" required>
                                <div class="invalid-feedback">
                                    Please enter the product brand.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="number" class="form-control" step="0.01" name="price" id="price" required>
                                        <div class="invalid-feedback">
                                            Please enter the product price.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="dimension">Dimensions:</label>
                                        <input type="number" class="form-control" step="0.01" name="dimension" id="dimension" required>
                                        <div class="invalid-feedback">
                                            Please enter the product dimensions.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="udpack">Units per package:</label>
                                        <input type="number" class="form-control" name="udpack" id="udpack" required>
                                        <div class="invalid-feedback">
                                            Please enter the units per package.
                                        </div>
                                    </div>
                            </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="weight">Weight:</label>
                                        <input type="number" class="form-control" step="0.01" name="weight" id="weight" required>
                                        <div class="invalid-feedback">
                                            Please enter the product weight.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="stock">Stock:</label>
                                        <input type="number" class="form-control" name="stock" id="stock" required>
                                        <div class="invalid-feedback">
                                            Please enter the product stock.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="iva">IVA:</label>
                                        <input type="number" class="form-control" step="0.01" name="iva" id="iva" required>
                                        <div class="invalid-feedback">
                                            Please enter the applicable IVA.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning mt-4">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                        <td>
                        <a href="#detailBrandModal{{ $product->id }}" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detailBrandModal{{ $product->id }}">
                            <i class="fas fa-eye"></i> Details
                        </a>
                        <td>
                            <a href="#updateBrandModal{{ $product->id }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateBrandModal{{ $product->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                        <td>
                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBrandModal{{ $product->id }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>

                    <!-- Modal detalles producto -->
                    <div class="modal fade" id="detailBrandModal{{$product->id}}" tabindex="-1" aria-labelledby='detailBrandModal{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">{{ $product->name }}</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                /* TO DO: Marta */
                                    {{-- <table class="table table-responsive-sm table-bordered table-hover">
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
                                </table> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
