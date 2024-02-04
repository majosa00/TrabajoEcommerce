@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h2 class="mb-3">Edit Brand: {{ $brand->name }}</h2>
        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        <form action="{{ route('brands.updateBrand', $brand->id) }}" method="POST">
            @method('PUT')
            @csrf

            {{-- Validación errores --}}
            @error('name')
                <div class="alert alert-danger"> The name is required </div>
            @enderror

            {{-- Formulario --}}
            <input type="text" name="name" class="form-control mb-2" value="{{ $brand->name }}"
                placeholder="Brand Name" autofocus>

            <button class="btn btn-warning btn-block mt-2" type="submit">Save Changes</button>
    </div>
    </div>
@endsection

