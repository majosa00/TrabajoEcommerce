@extends('layaouts.app2')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add New Product</h1>
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

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" step="0.01" name="price" id="price" required>
                <div class="invalid-feedback">
                    Please enter the product price.
                </div>
            </div>

            <div class="form-group">
                <label for="dimension">Dimensions:</label>
                <input type="number" class="form-control" step="0.01" name="dimension" id="dimension" required>
                <div class="invalid-feedback">
                    Please enter the product dimensions.
                </div>
            </div>

            <div class="form-group">
                <label for="udpack">Units per package:</label>
                <input type="number" class="form-control" name="udpack" id="udpack" required>
                <div class="invalid-feedback">
                    Please enter the units per package.
                </div>
            </div>

            <div class="form-group">
                <label for="weight">Weight:</label>
                <input type="number" class="form-control" step="0.01" name="weight" id="weight" required>
                <div class="invalid-feedback">
                    Please enter the product weight.
                </div>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" name="stock" id="stock" required>
                <div class="invalid-feedback">
                    Please enter the product stock.
                </div>
            </div>

            <div class="form-group">
                <label for="iva">VAT:</label>
                <input type="number" class="form-control" step="0.01" name="iva" id="iva" required>
                <div class="invalid-feedback">
                    Please enter the applicable VAT.
                </div>
            </div>

            <button type="submit" class="btn btn-warning mt-4">Add Product</button>
        </form>
    </div>
@endsection
