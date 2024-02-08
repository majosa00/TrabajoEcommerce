@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">PRODUCTS</h1>

        @if(session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


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
                            <!-- Formulario de nuevo producto -->
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
                                        <input type="number" class="form-control" name="stock" id="stock" required>
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
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#detailProductModal{{ $product->id }}">
                                <i class="fas fa-eye"></i> Details
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#updateProductModal{{ $product->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteProductModal{{ $product->id }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                @push('scripts')
        <script src="{{ asset('js/validacion.js') }}"></script>
    @endpush
            </tbody>
        </table>



        <!-- Modal editar producto -->
        @foreach ($products as $product)
            <div class="modal fade" id="updateProductModal{{ $product->id }}" tabindex="-1"
                aria-labelledby="updateProductModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Edit Product: {{ $product->name }}</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('products.update', $product->id) }}" method="POST">
                                @method('PUT')
                                @csrf

                                {{-- Validación errores --}}
                                @error('name')
                                    <div class="alert alert-danger"> The name is required </div>
                                @enderror
                                @error('description')
                                    <div class="alert alert-danger"> The description is required </div>
                                @enderror
                                @error('flavor')
                                    <div class="alert alert-danger"> The flavor is required </div>
                                @enderror
                                @error('brand')
                                    <div class="alert alert-danger"> The brand is required </div>
                                @enderror
                                @error('price')
                                    <div class="alert alert-danger"> The price is required and must be numeric </div>
                                @enderror
                                @error('dimension')
                                    <div class="alert alert-danger"> The dimension is required and must be numeric </div>
                                @enderror
                                @error('udpack')
                                    <div class="alert alert-danger"> The udpack is required and must be an integer </div>
                                @enderror
                                @error('weight')
                                    <div class="alert alert-danger"> The weight is required and must be numeric </div>
                                @enderror
                                @error('stock')
                                    <div class="alert alert-danger"> The stock is required and must be an integer </div>
                                @enderror
                                @error('iva')
                                    <div class="alert alert-danger"> The VAT is required and must be numeric </div>
                                @enderror

                                {{-- Formulario --}}
                                <div class="modal-body">
                                    <input type="text" name="name" class="form-control mb-2"
                                        value="{{ $product->name }}" placeholder="Product Name" autofocus>
                                    <input type="text" name="description" placeholder="Product Description"
                                        class="form-control mb-2" value="{{ $product->description }}">
                                    <input type="text" name="flavor" placeholder="Product Flavor"
                                        class="form-control mb-2" value="{{ $product->flavor }}">
                                    <input type="text" name="brand" placeholder="Product Brand"
                                        class="form-control mb-2" value="{{ $product->brand }}">
                                    <input type="text" name="price" placeholder="Product Price"
                                        class="form-control mb-2" value="{{ $product->price }}">
                                    <input type="text" name="dimension" placeholder="Product Dimension"
                                        class="form-control mb-2" value="{{ $product->dimension }}">
                                    <input type="text" name="udpack" placeholder="Product UDPack"
                                        class="form-control mb-2" value="{{ $product->udpack }}">
                                    <input type="text" name="weight" placeholder="Product Weight"
                                        class="form-control mb-2" value="{{ $product->weight }}">
                                    <input type="text" name="stock" placeholder="Product Stock"
                                        class="form-control mb-2" value="{{ $product->stock }}">
                                    <input type="text" name="iva" placeholder="Product VAT"
                                        class="form-control mb-2" value="{{ $product->iva }}">
                                </div>

                                <button class="btn btn-warning btn-block mt-2" type="submit">Save Changes</button>
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
                            <h2 class="modal-title">{{ $product->name }}</h2>
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
                    </div>
                </div>
        @endforeach

    </div>
@endsection
