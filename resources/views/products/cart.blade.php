{{-- resources/views/products/cart.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Tu Carrito</h1>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit">Buy</button>
            </form>
        </td>
    </tr>
@endforeach

</body>
</html>
