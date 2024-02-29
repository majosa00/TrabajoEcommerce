@extends('layouts.app2')

@section('title', 'Gestionar Cupones')

@section('content')
<div class="container p-5">
    <h1 class="mb-4">Manage Coupons</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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

    <div class="accordion" id="couponAccordion">
        {{-- Cupones descuento simples --}}
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed text-black" type="button"
                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        Create Simple Discount Coupon
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#couponAccordion">
                <div class="card-body">
                    <form id="simpleCouponForm" action="{{ route('admin.store_simple') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="value">Discount Value (%)</label>
                            <input type="number" class="form-control" id="value" name="value" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="max_users">Maximum Number of Users</label>
                            <input type="number" class="form-control" id="max_users" name="max_users" required>
                        </div>
                        <button type="submit" class="btn btn-warning mt-3">Create Simple Coupon</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Cupones descuento por categoría --}}
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed text-black" type="button"
                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        Create Discount Coupon by Category
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#couponAccordion">
                <div class="card-body">
                    <form id="categoryCouponForm" action="{{ route('admin.store_category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_code">Coupon Code</label>
                            <input type="text" class="form-control" id="category_code" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="brand_id" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_value">Discount Value (%)</label>
                            <input type="number" class="form-control" id="category_value" name="value" required>
                        </div>
                        <div class="form-group">
                            <label for="category_start_date">Start Date</label>
                            <input type="date" class="form-control" id="category_start_date" name="start_date"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="category_end_date">End Date</label>
                            <input type="date" class="form-control" id="category_end_date" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="category_max_users">Maximum Number of Users</label>
                            <input type="number" class="form-control" id="category_max_users" name="max_users"
                                required>
                        </div>
                        <button type="submit" class="btn btn-warning mt-3">Create Coupon by Category</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Cupones descuento para productos específicos (ofertas) --}}
        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed text-black" type="button"
                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                        Create Offer for Product
                    </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#couponAccordion">
                <div class="card-body">
                    <form id="productCouponForm" action="{{ route('admin.store_product') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="product_code">Coupon Code</label>
                            <input type="text" class="form-control" id="product_code" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control" id="product" name="product_id" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_value">Discount Value (%)</label>
                            <input type="number" class="form-control" id="product_value" name="value" required>
                        </div>
                        <div class="form-group">
                            <label for="product_start_date">Start Date</label>
                            <input type="date" class="form-control" id="product_start_date" name="start_date"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="product_end_date">End Date</label>
                            <input type="date" class="form-control" id="product_end_date" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="product_max_users">Maximum Number of Users</label>
                            <input type="number" class="form-control" id="product_max_users" name="max_users"
                                required>
                        </div>
                        <button type="submit" class="btn btn-warning mt-3">Create Offer for Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container p-5">
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Coupon Code</th>
                <th>Type</th>
                <th>Value</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Max Users</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
            <tr>
                <td>{{ $discount->id }}</td>
                <td>{{ $discount->code }}</td>
                <td>{{ $discount->type }}</td>
                <td>{{ $discount->value }}%</td>
                <td>{{ $discount->start_date }}</td>
                <td>{{ $discount->end_date }}</td>
                <td>{{ $discount->max_users }}</td>
                <td>
                    <!-- Botón para abrir el modal de editar -->
                    <button type="button" class="btn btn-secondary btn-sm edit-button" data-toggle="modal" data-target="#editDiscountModal" data-id="{{ $discount->id }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    
                    <!-- Botón para abrir el modal de borrar -->
                    <button type="button" class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-target="#deleteDiscountModal" data-id="{{ $discount->id }}">
    <i class="fas fa-trash-alt"></i>
</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editDiscountModal" tabindex="-1" role="dialog" aria-labelledby="editDiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="editDiscountForm" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <input type="hidden" name="id" id="edit_id">
        <div class="form-group">
            <label for="edit_code">Coupon Code</label>
            <input type="text" class="form-control" id="edit_code" name="code" required>
        </div>
        <div class="form-group">
            <label for="edit_value">Discount Value (%)</label>
            <input type="number" class="form-control" id="edit_value" name="value" required>
        </div>
        <!-- Añade aquí más campos según sea necesario -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
        </div>
    </div>
</div>

<!-- Modal para Confirmar Borrado -->
<div class="modal fade" id="deleteDiscountModal" tabindex="-1" role="dialog" aria-labelledby="deleteDiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="deleteDiscountForm" method="POST">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <div class="modal-body">
        Are you sure you want to delete this discount?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>
        </div>
    </div>
</div>
</div>

<script>
    // Validación del lado del cliente
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('simpleCouponForm').addEventListener('submit', function (event) {
            var form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });

        document.getElementById('categoryCouponForm').addEventListener('submit', function (event) {
            var form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });

        document.getElementById('productCouponForm').addEventListener('submit', function (event) {
            var form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
</script>
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Incluye Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <!-- Incluye Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div id="main-container"></div>
@endsection
