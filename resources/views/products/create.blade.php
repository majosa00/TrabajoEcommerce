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

    <label for="flavor">Sabor:</label>
    <input type="text" name="flavor" required>

    <label for="brand">Marca:</label>
    <input type="text" name="brand" required>

    <label for="price">Precio:</label>
    <input type="number" step="0.01" name="price" required>

    <label for="dimension">Dimensión:</label>
    <input type="number" step="0.01" name="dimension" required>

    <label for="udpack">Unidades por Paquete:</label>
    <input type="number" name="udpack" required>

    <label for="weight">Peso:</label>
    <input type="number" step="0.01" name="weight" required>

    <label for="stock">Stock:</label>
    <input type="number" name="stock" required>

    <label for="iva">IVA:</label>
    <input type="number" step="0.01" name="iva" required>

    <button type="submit">Agregar Producto</button>
</form>

</body>
</html>
