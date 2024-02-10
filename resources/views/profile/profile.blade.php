@extends('layouts.app')

@section('content')
<div class="container p-5">
    <h1 class="mb-3">Hello {{ Auth::user()->name }}</h1>
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

    <!-- Cambiar datos user -->
    <h3>About you</h3>
    @auth
    <form action="{{ route('user.update', Auth::id()) }}" method="POST">
        @method('PUT')
        @csrf
        {{-- Form --}}
        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control mb-2"
                        value="{{ old('name', Auth::user()->name) }}" placeholder="Enter your name" autofocus>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="secondname" class="form-label">Second Name</label>
                    <input type="text" id="secondname" name="secondname" class="form-control mb-2"
                        value="{{ old('secondname', Auth::user()->secondname) }}" placeholder="Enter your second name">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control mb-2"
                        value="{{ old('email', Auth::user()->email) }}" placeholder="Enter your email">
                </div>
                <button class="btn btn-warning btn-block mt-2" type="submit">Save</button>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="birthday" class="form-label">Date of Birth</label>
                    <input type="date" id="birthday" name="birthday" class="form-control mb-2"
                        value="{{ old('birthday', Auth::user()->birthday) }}" placeholder="Enter your date of birth">
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" id="phone" name="phone" class="form-control mb-2"
                        value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter your phone number">
                </div>
            </div>
        </div>
    </form>
    @endauth

    <!-- Direcciones -->
    <h3>Your addresses</h3>
    <div class="col-md-6">
        <a href="#newAddressModal" class="btn btn-warning mb-4" data-bs-toggle="modal"
            data-bs-target="#newAddressModal">
            <i class="fas fa-plus"></i> New Address
        </a>
    </div>

    @if (!empty($addresses))
    @foreach ($addresses as $address)
    <div class="row">
        <div class="col-lg-6">
            <strong>Address:</strong> {{ $address->address }}<br>
            <strong>Country:</strong> {{ $address->country }}<br>
        </div>
        <div class="col-lg-4">
            <strong>City:</strong> {{ $address->city }}<br>
            <strong>ZIP Code:</strong> {{ $address->zipCode }}
        </div>
        <div class="col-lg-2">
            <!-- Botones de Editar y Eliminar -->
            <div class="btn-group">
                <a href="#updateAddressModal" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#updateAddressModal{{ $address->id }}">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <form action="{{ route('profile.deleteAddress', $address->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm ms-2" type="submit"><i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div class="modal fade" id="updateAddressModal{{ $address->id }}" tabindex="-1" role="dialog"
        aria-labelledby="updateAddressModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.updateAddress', $address->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Formulario -->
                        <input type="text" name="address" placeholder="Address" class="form-control mb-2"
                            value="{{ $address->address }}" autofocus>
                        <input type="text" name="country" placeholder="Country" class="form-control mb-2"
                            value="{{ $address->country }}">
                        <input type="text" name="city" placeholder="City" class="form-control mb-2"
                            value="{{ $address->city }}">
                        <input type="text" name="zipCode" placeholder="Zip Code" class="form-control mb-2"
                            value="{{ $address->zipCode }}">

                        <button class="btn btn-warning btn-block mt-2" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @endforeach
    @else
    <p>No addresses found.</p>
    @endif

    <!-- Modal nueva dirección -->
    <div class="modal fade" id="newAddressModal" tabindex="-1" aria-labelledby="newAddressModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">New Address</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.create-new-address') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter address"
                                    autofocus>
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
            </div>
        </div>
    </div>


    <!-- Cambiar contraseña -->
    <div class="row mb-3">
        <h3>Password</h3>
        <div class="col-md-6">
            <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal"
                data-bs-target="#changePasswordModal">
                <i class="fas fa-key"></i> Change Password
            </button>
        </div>
    </div>

    <!-- Modal Cambiar Contraseña -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Change Password</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.changepassword') }}" method="POST" id="changePasswordForm">
                        @csrf
                        @method('PUT')

                        {{-- Campo para la contraseña actual --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Current Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo para la nueva contraseña --}}
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                            @error('new_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo para confirmar la nueva contraseña --}}
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                            @error('new_password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- <!-- Cambiar idioma -->
<div class="col-md-6">
    <label for="language" class="form-label">Language:</label>
    <select class="form-select form-control" id="language" name="select">
        <option value="English">English</option>
        <option value="Español">Español</option>
    </select>
</div> --}}