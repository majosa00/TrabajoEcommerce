<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <p>Nombre: {{$product->name}}</p>
    <p>Descripción: {{$product->description}}</p>
    <p>Sabor: {{$product->flavor}}</p>
    <p>Marca: {{$product->brand}}</p>
    <p>Precio: {{$product->price}}</p>
    <p>Dimensión: {{$product->dimension}}</p>
    <p>Unidades por Paquete: {{$product->udpack}}</p>
    <p>Peso: {{$product->weight}}</p>
    <p>Stock: {{$product->stock}}</p>
    <p>IVA: {{$product->iva}}</p>
</body>

</html>