{{-- resources/views/coupon.blade.php --}}
@extends('layouts.app2')

@section('content')
    <div id="main-container">
        <div class="container p-5">
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

            <section id="discounts">
                <h1 class="mb-3">COUPONS</h1>
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
                                <th>Edit</th>
                                <th>Delete</th>
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
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editDiscountModal{{ $discount->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Botón para abrir el modal de confirmación de eliminación -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteDiscountModal{{ $discount->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal para Editar -->
                @foreach ($discounts as $discount)
                    <div class="modal fade" id="editDiscountModal{{ $discount->id }}" tabindex="-1"
                        aria-labelledby="editDiscountModalLabel{{ $discount->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Edit Discount: {{ $discount->code }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data"
                                        action="{{ route('discounts.update', $discount->id) }}">
                                        @method('PUT')
                                        @csrf

                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="edit_id">
                                            <div class="form-group">
                                                <label for="edit_code">Coupon Code</label>
                                                <input type="text" value="{{ $discount->code }}" class="form-control"
                                                    id="edit_code" name="code" required>
                                                <div class="invalid-feedback">
                                                    Please enter the coupon code.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_value">Discount Value (%)</label>
                                                <input type="number" value="{{ $discount->value }}" class="form-control"
                                                    id="edit_value" name="value" required>
                                                <div class="invalid-feedback">
                                                    Please enter a discount value.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_type">Type</label>
                                                <select class="form-control" id="edit_type" name="type" required>
                                                    <option value="simple"
                                                        {{ $discount->type === 'simple' ? 'selected' : '' }}>Simple
                                                    </option>
                                                    <option value="category"
                                                        {{ $discount->type === 'category' ? 'selected' : '' }}>Category
                                                    </option>
                                                    <option value="product"
                                                        {{ $discount->type === 'product' ? 'selected' : '' }}>Product
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a type.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_user_id">User ID</label>
                                                <input type="number" value="{{ $discount->user_id }}" class="form-control"
                                                    id="edit_user_id" name="user_id">
                                                <div class="invalid-feedback">
                                                    Please enter the User ID.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_start_date">Start Date</label>
                                                <input type="datetime-local"
                                                    value="{{ \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d\TH:i') }}"
                                                    class="form-control" id="edit_start_date" name="start_date" required>
                                                <div class="invalid-feedback">
                                                    Please enter the start date.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_end_date">End Date</label>
                                                <input type="datetime-local"
                                                    value="{{ \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d\TH:i') }}"
                                                    class="form-control" id="edit_end_date" name="end_date" required>
                                                <div class="invalid-feedback">
                                                    Please enter the end date.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_max_users">Max Users</label>
                                                <input type="number" value="{{ $discount->max_users }}"
                                                    class="form-control" id="edit_max_users" name="max_users">
                                                <div class="invalid-feedback">
                                                    Please enter the max users.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_brand_id">Brand ID</label>
                                                <input type="number" value="{{ $discount->brand_id }}"
                                                    class="form-control" id="edit_brand_id" name="brand_id">
                                                <div class="invalid-feedback">
                                                    Please enter the brand ID.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_product_id">Product ID</label>
                                                <input type="number" value="{{ $discount->product_id }}"
                                                    class="form-control" id="edit_product_id" name="product_id">
                                                <div class="invalid-feedback">
                                                    Please enter the product ID.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_max_products">Max Products</label>
                                                <input type="number" value="{{ $discount->max_products }}"
                                                    class="form-control" id="edit_max_products" name="max_products">
                                                <div class="invalid-feedback">
                                                    Please enter the max products.
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-warning mt-4">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal para Confirmar Borrado -->
                @foreach ($discounts as $discount)
                    <div class="modal fade" id="deleteDiscountModal{{ $discount->id }}" tabindex="-1"
                        aria-labelledby="deleteDiscountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteDiscountModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this brand: "{{ $discount->code }}"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('discounts.delete', $discount->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </section>
        </div>
    </div>
@endsection
