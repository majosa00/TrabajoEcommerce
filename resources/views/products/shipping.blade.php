@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <h4 class="mb-3">Billing address</h4>
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
        
        <form class="needs-validation" novalidate method="POST" action="{{ route('cart.viewShipping') }}">
            @csrf
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Please enter your first name.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="firstName" class="form-label">Second Name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Please enter your second name.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="email" class="form-label">Email <span class="text-body-secondary"></span></label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                    <button class="btn btn-warning btn-block mt-2" type="submit">Save</button>
                </div>

                <div class="col-sm-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Phone" value="" required>
                    <div class="invalid-feedback">
                        Please enter your phone number.
                    </div>
                </div>
            </div>
        </form>

        <hr class="my-4">

        <!-- Direcciones -->
        <h3>Choose your address</h3>
        <div class="form-group">
            <label for="address">Select Address:</label>
            <select name="address" id="address" class="form-control">
                @if ($addresses->count() > 0)
                    @foreach ($addresses as $address)
                        <option value="{{ $address->id }}">{{ $address->address }} - {{ $address->city }},
                            {{ $address->country }}</option>
                    @endforeach
                @endif
                <option value="0" data-toggle="#newAddressForm">Create New Address</option>
            </select>
        </div>

        <!-- Formulario para nueva dirección (inicialmente oculto) -->
        <div id="newAddressForm" style="display: none;">
            <form action="{{ route('cart.create-new-address-shipping') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter address" autofocus>
                    </div>
                    <div class="mb-2">
                        <label for="country" class="form-label">Country:</label>
                        <input type="text" name="country" class="form-control" placeholder="Enter country">
                    </div>
                    <div class="mb-2">
                        <label for="city" class="form-label">City:</label>
                        <input type="text" name="city" class="form-control" placeholder="Enter city">
                    </div>
                    <div class="mb-2">
                        <label for="zipcode" class="form-label">ZIP Code:</label>
                        <input type="text" name="zipcode" class="form-control" placeholder="Enter ZIP code">
                    </div>
                    <button type="submit" class="btn btn-warning">Add Address</button>
                </div>
            </form>
        </div>


        <hr>

        {{-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
        </div>

        <hr class="my-4"> --}}

        <h4 class="mb-3">Payment</h4>

        <div class="my-3">
            <div class="form-check">
                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                <label class="form-check-label" for="credit">Credit card</label>
            </div>
            {{-- <div class="form-check">
                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                <label class="form-check-label" for="debit">Debit card</label>
            </div>
            <div class="form-check">
                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                <label class="form-check-label" for="paypal">PayPal</label>
            </div> --}}
        </div>

        <div class="row gy-3">
            <div class="col-md-6">
                <label for="cc-name" class="form-label">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-body-secondary">Full name as displayed on card</small>
                <div class="invalid-feedback">
                    Name on card is required
                </div>
            </div>

            <div class="col-md-6">
                <label for="cc-number" class="form-label">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                    Credit card number is required
                </div>
            </div>

            <div class="col-md-3">
                <label for="cc-expiration" class="form-label">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                    Expiration date required
                </div>
            </div>

            <div class="col-md-3">
                <label for="cc-cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                    Security code required
                </div>
            </div>
        </div>

        <hr class="my-4">


        <form action="{{ route('cart.pay') }}" method="POST" class="mt-3">
            @csrf
            <button class="w-100 btn btn-warning btn-lg" type="submit">Continue to checkout</button>
        </form>
        </form>
    </div>
@endsection
