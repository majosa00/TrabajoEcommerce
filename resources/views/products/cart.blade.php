{{-- resources/views/products/cart.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>Carrito de Compras</title>
</head>

<body>
    <h1>Cart</h1>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Product</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->pivot->amount }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
