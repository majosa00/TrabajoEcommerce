@extends('layaouts.app2')

@section('content')
    <div class="container p-5">
        <h1 class="mb-4">Add New Brand</h1>
        <form action="{{ route('brands.createBrand') }}" method="post" class="needs-validation" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
                <div class="invalid-feedback">
                    Please enter the brand name.
                </div>
            </div>

            <button type="submit" class="btn btn-warning mt-4">Add Brand</button>
        </form>
    </div>
@endsection
