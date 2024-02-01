@extends('layaouts.app')

@section('content')
    <div class="container">

        <body>
            <h1>PRODUCTOS</h1>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" type="submit">Buy</button>
                        </td>
                    </tr>
                @endforeach
            </table>
    </div>
@endsection
