@extends('layaouts.app')

@section('content')
<div class="container p-5">
    <h1 class="mb-3">Hello {{ Auth::user()->name }}</h1>

    <!-- Cambiar datos user -->
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
        <input type="text" name="name" class="form-control mb-2" value="{{ Auth::user()->name }}" placeholder="Name"
            autofocus>
        <input type="text" name="email" placeholder="Email" class="form-control mb-2" value="{{ Auth::user()->email }}">

        <button class="btn btn-warning btn-block mt-2" type="submit">Save Changes</button>
    </form>
    @endauth



    <!-- Cambiar contraseña -->
    <div class="row">
        <!-- Agrega el siguiente bloque para el cambio de contraseña -->
        <div class="col-md-6">
            <form action="{{ route('profile.changepassword') }}" method="GET" class="d-flex">
                @csrf
                <button class="btn btn-warning mb-3" type="submit"><i class="fas fa-key"></i> Change Password</button>
            </form>
        </div>

        <!-- Cambiar direcciones de entrega -->
        <div class="col-md-6">
            <form action="{{ route('profile.changeaddress') }}" method="GET" class="d-flex">
                @csrf
                <button class="btn btn-info mb-3" type="submit"><i class="fas fa-home"></i> Edit Address</button>
            </form>
        </div>

        <!-- Cambiar idioma -->
        <div class="col-md-6">
            <label for="language" class="form-label">Language:</label>
            <select class="form-select form-control" id="language" name="select">
                <option value="English">English</option>
                <option value="Español">Español</option>
            </select>
        </div>
    </div>



</div>
@endsection