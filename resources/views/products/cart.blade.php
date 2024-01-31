<!DOCTYPE html>
<html>
<head>
    <title>Carrito</title>
</head>
<body>
    <h1>Añadir al carro</h1>
    <form action="{{ route('products.create') }}" method="post">
    
    @csrf
    <label for='name'>Nombre</label>
    <input type=
</form>

</body>
</html>
