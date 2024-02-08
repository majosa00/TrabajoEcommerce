@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">Hello {{ Auth::user()->name }}</h1>

        <!-- Cambiar datos user -->
        <h3>About you</h3>
        @auth
            <form action="{{ route('user.update', Auth::id()) }}" method="POST">
                @method('PUT')
                @csrf

                {{-- Validation errors --}}
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Form --}}
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control mb-2"
                                value="{{ Auth::user()->name }}" placeholder="Enter your name" autofocus>
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
            <a href="#" class="btn btn-warning mb-4" data-bs-toggle="modal" data-bs-target="#newAddressModal">
                <i class="fas fa-plus"></i> New Address
            </a>
        </div>

        @if (isset($addresses) && count($addresses) > 0)
            @foreach ($addresses as $address)
                <p>{{ $address->address }}</p>
                <p>{{ $address->country }}</p>
                <p>{{ $address->city }}</p>
                <p>{{ $address->zipCode }}</p>
            @endforeach
        @else
            <p>No addresses found.</p>
        @endif

        {{-- <!-- Modal nueva dirección -->
        @foreach ($addresses as $address)
            <div class="modal fade" id="newAddressModal{{ $address->id }}" tabindex="-1"
                aria-labelledby="newAddressModalLabel{{ $address->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">New Address</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('profile.newadress', $product->id) }}" method="GET">
                                @method('PUT')
                                @csrf
                                <div class="modal-body">
                                    <input type="text" name="address" class="form-control mb-2"
                                        value="{{ $address->address }}" placeholder="Product Name" autofocus>
                                    <input type="text" name="description" placeholder="Product Description"
                                        class="form-control mb-2" value="{{ $address->country }}">
                                    <input type="text" name="flavor" placeholder="Product Flavor"
                                        class="form-control mb-2" value="{{ $address->city }}">
                                    <input type="text" name="brand" placeholder="Product Brand"
                                        class="form-control mb-2" value="{{ $address->zip }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        @endforeach  --}}

        <!-- Cambiar contraseña -->
        <div class="row mb-3">
            <h3>Password</h3>
            <div class="col-md-6">
                <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#changePasswordModal" data-bs-dismiss="modal">
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
                        <form action="{{ route('profile.changepassword') }}" method="POST">
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
