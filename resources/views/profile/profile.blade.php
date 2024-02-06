@extends('layaouts.app')

@section('content')
    <div class="container p-5">
        <h1 class="mb-3">Hello {{ Auth::user()->name }}</h1>

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
