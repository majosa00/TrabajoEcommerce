<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            /* Fondo ligeramente gris para destacar la factura */
        }

        .invoice-box {
            background-color: transparent;
            /* Fondo transparente */
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: none;
            /* Eliminar sombra */
        }

        .logo {
            width: 200px;
            /* Ajustar el tamaño del logo */
            display: block;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer {
            text-align: center;
            color: #6c757d;
            margin-top: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .table thead th {
            border-bottom: 2px solid #6c757d;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-rojo {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        @php
            $logoPath = public_path('images/logoticket.png');
            $logoData = base64_encode(file_get_contents($logoPath));
        @endphp
        <img src="data:image/png;base64,{{ $logoData }}" alt="Logo" class="logo">

        <h2 class="text-center mb-4">Invoice #{{ $order->id }}</h2>
        <p class="text-center">
            <strong>Date:</strong> {{ $order->orderDate }}<br>
            <strong>To:</strong> {{ $order->address }}
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach ($order->products as $product)
                    @php
                        $productTotal = $product->pivot->amount * $product->price;
                        $subtotal += $productTotal;
                    @endphp
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td class="text-right">{{ $product->pivot->amount }}</td>
                        <td class="text-right">${{ number_format($product->price, 2) }}</td>
                        <td class="text-right">${{ number_format($productTotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <p><strong>Subtotal:</strong> ${{ number_format($subtotal, 2) }}</p>
            <p class="total-price text-rojo"><strong>Total:</strong> ${{ number_format($subtotal, 2) }}</p>
        </div>

        <p class="text-center order-state">State: {{ $order->state }}</p>
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html>
