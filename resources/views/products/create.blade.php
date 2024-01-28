<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Producto</title>
</head>
<body>
    <h1>Añadir Nuevo Producto</h1>
    <form action="{{ route('products.add') }}" method="post">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" required>
        <label for="description">Descripción:</label>
        <textarea name="description" required></textarea>
        <button type="submit">Agregar Producto</button>
    </form>
    
</body>
</html>
