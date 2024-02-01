<!DOCTYPE html>
<html>

<head>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    
</head>


<body>
    <h1>PEDIDOS</h1>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>ID User</th>
                <th>ID Order</th>
                <th>State</th>
            </tr>
        </thead>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id_user }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->state }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
