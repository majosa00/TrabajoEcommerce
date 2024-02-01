<!DOCTYPE html>
<html>

<head>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])

</head>

<body>
    <h1>PRODUCTS</h1>
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
    <td>
        <form action="{{ route('cart.addToCart', $product->id) }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm" type="submit">Buy</button>
        </form>
    </td>
</tr>
@endforeach
    
    </table>
</body>

</html>
