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
                <th>Price</th>
            </tr>
        </thead>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->pivot->amount }}</td>
                <td>{{ $product->price }} €</td>
            </tr>
        @endforeach
    </table>

    <h3>Total Price: {{ $products->sum('price') }} € </h3>
    <form action="{{ route('cart.pay') }}" method="POST">
        @csrf
        <button class="btn btn-danger btn-sm" type="submit">Payment</button>
    </form>
</body>

</html>
