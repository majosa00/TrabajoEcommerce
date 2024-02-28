@extends('layouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">PRODUCTS</h1>

        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="#" class="btn btn-warning mb-4" data-bs-toggle="modal" data-bs-target="#newProductModal">
            <i class="fas fa-plus"></i> New Product
        </a>

        <!-- Modal nuevo producto -->
        <div class="modal fade" id="newProductModal" tabindex="-1" aria-labelledby="newProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add New Product</h3>
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
                                <label for="ingredient">Ingredient:</label>
                                <textarea class="form-control" name="ingredient" id="ingredient" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter a product ingredient.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="flavor">Flavor:</label>
                                    <input type="text" class="form-control" name="flavor" id="flavor" required>
                                    <div class="invalid-feedback">
                                        Please enter the product flavor.
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="brand_id">Brand:</label>
                                        <select class="form-control" name="brand_id" id="brand_id" required>
                                            <!-- Opción vacía añadida al principio -->
                                            <option value="">Seleccione una marca</option>

                                            @foreach (App\Models\Brand::all() as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a brand.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="number" class="form-control" step="0.01" name="price"
                                            id="price" required>
                                        <div class="invalid-feedback">
                                            Please enter the product price.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="dimension">Dimensions:</label>
                                        <input type="number" class="form-control" step="0.01" name="dimension"
                                            id="dimension" required>
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
                                        <input type="number" class="form-control" step="0.01" name="weight"
                                            id="weight" required>
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
                                        <input type="number" class="form-control" name="stock" id="stock"
                                            required>
                                        <div class="invalid-feedback">
                                            Please enter the product stock.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="iva">IVA:</label>
                                        <input type="number" class="form-control" step="0.01" name="iva"
                                            id="iva" required>
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
                    <th></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Ingredients</th>
                    <th>Brand</th> <!-- Cambiado de 'Brand ID' a 'Brand' -->
                    <th>Price</th>
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}"
                                class="w-100" alt="{{ $product->name }}"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->ingredient }}</td>
                        <td>{{ $product->brand->name ?? 'Brand not assigned' }}</td>
                        <!-- Aquí se muestra el nombre de la marca -->
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#detailProductModal{{ $product->id }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#updateProductModal{{ $product->id }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            @if (!$product->is_hidden)
                                <form action="{{ route('products.hide', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">Hide</button>
                                </form>
                            @else
                                <form action="{{ route('products.show', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Show</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}

        <!-- Modal editar producto -->
        @foreach ($products as $product)
            <div class="modal fade" id="updateProductModal{{ $product->id }}" tabindex="-1"
                aria-labelledby="updateProductModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Edit Product: {{ $product->name }}</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data"
                                action="{{ route('products.update', $product->id) }}">
                                @method('PUT')
                                @csrf

                                <div class="d-flex justify-content-center">
                                    <img src="{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}"
                                        class="w-50 " alt="{{ $product->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" value="{{ $product->name }}"
                                        name="name" id="name" required>
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
                                    <label for="ingredient">Ingredient:</label>
                                    <textarea class="form-control" name="ingredient" id="ingredient" rows="3" required></textarea>
                                    <div class="invalid-feedback">
                                        Please enter a product ingredient.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="flavor">Flavor:</label>
                                        <input type="text" class="form-control" name="flavor"
                                            value="{{ $product->flavor }}" id="flavor" required>
                                        <div class="invalid-feedback">
                                            Please enter the product flavor.
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="brand_id">Brand:</label>
                                            <select class="form-control" name="brand_id" id="brand_id" required>
                                                @foreach (App\Models\Brand::all() as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a brand.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="price">Price:</label>
                                            <input type="number" class="form-control" value="{{ $product->price }}"
                                                step="0.01" name="price" id="price" required>
                                            <div class="invalid-feedback">
                                                Please enter the product price.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dimension">Dimensions:</label>
                                            <input type="number" class="form-control" value="{{ $product->dimension }}"
                                                step="0.01" name="dimension" id="dimension" required>
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
                                            <input type="number" class="form-control" name="udpack"
                                                value="{{ $product->udpack }}" id="udpack" required>
                                            <div class="invalid-feedback">
                                                Please enter the units per package.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="weight">Weight:</label>
                                            <input type="number" class="form-control" value="{{ $product->weight }}"
                                                step="0.01" name="weight" id="weight" required>
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
                                            <input type="number" class="form-control" value="{{ $product->stock }}"
                                                name="stock" id="stock" required>
                                            <div class="invalid-feedback">
                                                Please enter the product stock.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="iva">IVA:</label>
                                            <input type="number" class="form-control" value="{{ $product->iva }}"
                                                step="0.01" name="iva" id="iva" required>
                                            <div class="invalid-feedback">
                                                Please enter the applicable IVA.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="file" name="image_1">

                                <button type="submit" class="btn btn-warning mt-4">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal detalles producto -->
        @foreach ($products as $product)
            <div class="modal fade" id="detailProductModal{{ $product->id }}" tabindex="-1"
                aria-labelledby="detailProductModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">{{ $product->name }}</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-responsive-sm table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" colspan="2">Product Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ optional($product->images)->imagen_1 ? asset('storage/' . $product->images->imagen_1) : '' }}"
                                                class="w-50 " alt="{{ $product->name }}">
                                        </div>
                                    </tr>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Description</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Ingredient</th>
                                        <td>{{ $product->ingredient }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Flavor</th>
                                        <td>{{ $product->flavor }}</td>
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
                                        <th scope="row">Brand ID</th>
                                        <td>{{ $product->brand_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">IVA</th>
                                        <td>{{ $product->iva }}</td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div id="main-container"></div>
@endsection
