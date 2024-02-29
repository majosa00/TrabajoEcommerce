@extends('layouts.app')

@section('content')
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

        <div class="row g-5 shipping">
            <h4 class="mb-3">Billing address</h4>
            <!-- Carrito resumen -->
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-warning">Your cart</span>
                    <span class="badge bg-warning rounded-pill text-white">
                        {{ $itemCount = $user->cart->products->sum('pivot.amount') }}
                    </span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach ($user->cart->products as $product)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $product->name }}</h6>
                                <small class="text-body-secondary">{{ $product->description }}</small>
                            </div>
                            <span class="text-body-secondary">${{ $product->price }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal (USD)</span>
                        <span>${{ $cart->subtotal() }}</span>
                    </li>
                    @if (session()->has('discount'))
                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">

                            <div class="text-success">
                                <h6 class="my-0">Discount {{ session()->get('discount')['name'] ?? '' }}</h6>
                            </div>
                            <span class="text-success">-${{ session()->get('discount')['discount_value'] ?? 0 }}</span>
                            <form action="{{ route('discount.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </form>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between">
                        <span><strong>Total (USD)</strong></span>
                        @if (session()->has('discount'))
                            <strong>${{ session('totalPrice') }}</strong>
                        @else
                            <span><strong>${{ $cart->subtotal() }}</strong></span>
                        @endif
                    </li>
                </ul>
                @if (!session()->has('discount'))
                    <form class="card p-2" action="{{ route('discount.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="discount_code" id="discount_code"
                                placeholder="Promo code">
                            <button type="submit" class="btn btn-secondary">Apply</button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="col-md-7 col-lg-8">
                <!-- Datos personales -->
                <form class="needs-validation" novalidate method="POST" action="{{ route('cart.updatedatas') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder=""
                                value="{{ old('name', auth()->user()->name) }}" required>
                            <div class="invalid-feedback">
                                Please enter your first name.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="secondname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="secondname" name="secondname" placeholder=""
                                value="{{ old('secondname', auth()->user()->secondname) }}" required>
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email <span class="text-body-secondary"></span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="you@example.com" value="{{ old('email', auth()->user()->email) }}" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                            <button class="btn btn-warning btn-block mt-4" type="submit">Save</button>
                        </div>

                        <div class="col-sm-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone"
                                value="{{ old('phone', auth()->user()->phone) }}" required>
                            <div class="invalid-feedback">
                                Please enter your phone number.
                            </div>
                        </div>
                    </div>
                </form>

                <hr class="my-4">

                <section id="payment">
                    <h4 class="mb-3">Payment</h4>
                    <form action="" method="post" id="payment-form" class="needs-validation" novalidate>
                        @csrf
                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input"
                                    checked required>
                                <label class="form-check-label" for="credit">Credit card</label>
                            </div>
                        </div>

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder=""
                                    required>
                                <small class="text-body-secondary">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" name="cc-number"
                                    placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" name="cc-expiration"
                                    placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder=""
                                    required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning mt-4">Save </button>
                    </form>
                </section>

                <hr class="my-4">

                <!-- Pagar y addresses -->
                <form action="{{ route('cart.pay') }}" method="POST" class="mt-3">
                    @csrf
                    <!-- Direcciones -->
                    <h3 class="p-2">Choose your address</h3>
                    <div class="row justify-content-center align-items-center gap-3">
                        <div class="col-12">
                            <a href="addressModal" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addressModal">
                                <i class="fas fa-plus"></i> New Address
                            </a>
                        </div>
                        @foreach ($addresses as $address)
                            <div class="col-12 border p-3 rounded">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="selected_address"
                                        id="selected_address" value="{{ $address->id }}" />
                                    <label class="form-check-label" for=""> {{ $address->address }} </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="w-100 btn btn-warning btn-lg mt-4" type="submit">Continue to checkout</button>
                </form>
            </div>

            <!-- Modal para nueva dirección -->
            <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newAddressModalLabel">Add New Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('cart.create-new-address-shipping') }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label for="address" class="form-label">New Address:</label>
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Enter new address" autofocus>
                                </div>
                                <div class="mb-2">
                                    <label for="country" class="form-label">Country:</label>
                                    <input type="text" name="country" class="form-control"
                                        placeholder="Enter country">
                                </div>
                                <div class="mb-2">
                                    <label for="city" class="form-label">City:</label>
                                    <input type="text" name="city" class="form-control" placeholder="Enter city">
                                </div>
                                <div class="mb-2">
                                    <label for="zipcode" class="form-label">ZIP Code:</label>
                                    <input type="text" name="zipcode" class="form-control"
                                        placeholder="Enter ZIP code">
                                </div>
                                <button type="submit" class="btn btn-warning">Add Address</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="main-container"></div>
    @endsection
