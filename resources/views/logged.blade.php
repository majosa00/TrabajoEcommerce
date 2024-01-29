<!DOCTYPE html>
<html>

<head>
    @vite(['resources/js/app.js', 'resources/css/app.scss']) 
</head>


<body>
    <h1>PRODUCTOS</h1>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" type="submit">Comprar</button>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>