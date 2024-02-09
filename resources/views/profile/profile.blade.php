@extends('layaouts.app')

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
                    <input type="text" id="name" name="name" class="form-control mb-2" value="{{ Auth::user()->name }}"
                        placeholder="Enter your name" autofocus>
                </div>
                <button class="btn btn-warning btn-block mt-2" type="submit">Save</button>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-control mb-2"
                        value="{{ Auth::user()->email }}" placeholder="Enter your email">
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
    <ul>
        @foreach ($addresses as $address)
        <li>
            <strong>Address:</strong> {{ $address->address }}<br>
            <strong>Country:</strong> {{ $address->country }}<br>
            <strong>City:</strong> {{ $address->city }}<br>
            <strong>ZIP Code:</strong> {{ $address->zipCode }}

            <!-- Botones de Editar y Eliminar -->
            <button type="button" data-toggle="modal" data-target="#editModal{{ $address->id }}">
                Editar
            </button>

            <form action="{{ route('profile.updateAddress', $address->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>

        <!-- Modal de Edición -->
        <div class="modal fade" id="editModal{{ $address->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí debes agregar un formulario con los campos que desees editar -->
                        <!-- Puedes prellenar los campos con los valores actuales de la dirección -->
                        <form action="{{ route('profile.updateAddress', $address->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('PUT')
                            <!-- Campos del formulario -->
                            <label for="editAddress">Dirección:</label>
                            <input type="text" id="editAddress" name="address" value="{{ $address->address }}" required>

                            <label for="editCountry">País:</label>
                            <input type="text" id="editCountry" name="country" value="{{ $address->country }}" required>

                            <label for="editCity">Ciudad:</label>
                            <input type="text" id="editCity" name="city" value="{{ $address->city }}" required>

                            <label for="editZipCode">Código Postal:</label>
                            <input type="text" id="editZipCode" name="zipCode" value="{{ $address->zipCode }}" required>

                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br>
        @endforeach
    </ul>
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
    @endsection

    {{-- <!-- Cambiar idioma -->
    <div class="col-md-6">
        <label for="language" class="form-label">Language:</label>
        <select class="form-select form-control" id="language" name="select">
            <option value="English">English</option>
            <option value="Español">Español</option>
        </select>
    </div> --}}