<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
     
    <!-- Esta mal el style aqui pero no me cogia el stylo de invoice.css -->
    <style> 
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            background-color: #fff;
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .logo {
            width: 200px;
            display: block;
            margin: 0 auto 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details,
        .invoice-total {
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            text-align: center;
            color: #6c757d;
            margin-top: 20px;
        }
        /* New styles for a more modern look */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
        }
        .invoice-title {
            font-size: 28px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .company-details,
        .client-details {
            font-size: 16px;
            line-height: 1.6;
        }
        .company-details p,
        .client-details p {
            margin: 0;
        }
        .total-section {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
        }
        .info-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .info-section div {
            width: 48%;
        }
        .info-section .text-right {
            text-align: right;
        }
        .info-section .text-strong {
            font-weight: bold;
        }
        /* New styles for aligning date and invoice number */
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* Style for spacing */
        .address-spacing {
            margin-bottom: 20px;
        }
        /* Signature styles */
        .signature-column {
            width: 48%;
            padding-top: 50px; /* Adjust as needed */
        }
        .signature-column img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .signature-title {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        @php
        $logoPath = public_path('images/logoticket.png');
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
        } else {
            $logoData = ''; // Provide a default base64 image string or handle this case.
        }
        @endphp

        @if (!empty($logoData))
            <div class="text-center">
                <img src="data:image/png;base64,{{ $logoData }}" alt="Logo" class="logo">
            </div>
        @endif

        <div class="header-section">
    
            <div class="company-details text-center">
                <p>Innovation Avenue, Building 2</p>
                <p>Seville 41020</p>
                <p>info@energeticwave.com</p>
            </div>
        </div>


        <p class="text-left address-spacing">
            <h1 class="text-left mb-4">Invoice #{{ $order->id }}</h1>
            <strong>Date:</strong> {{ $order->orderDate }}<br>
            <strong>To:</strong> {{ $order->user_id ? \DB::table('users')->where('id', $order->user_id)->value('name') : 'Nombre de cliente no disponible' }}<br>
            <strong>Address:</strong> {{ $order->address }}
        </p>

        <div class="table-responsive mb-4">
            <table class="table table-bordered invoice-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @forelse ($order->products as $product)
                        @php
                            $productTotal = $product->pivot->amount * $product->price;
                            $subtotal += $productTotal;
                        @endphp
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->amount }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>${{ number_format($productTotal, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No products in this order.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right text-strong">Subtotal:</td>
                        <td>${{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right text-strong">VAT (21%):</td>
                        <td>${{ number_format($subtotal * 0.21, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right text-strong"><strong>TOTAL:</strong></td>
                        <td><strong>${{ $order->totalPrice }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <div class="col">
                <div class="signature-column">
                    <hr>
                    <p class="signature-title">Signature</p>
                </div>
            </div>
        </div>

        <p class="text-center footer">Thank you for your business!</p>
        <p class="text-center order-state">State: {{ $order->state }}</p>
    </div>
</body>
</html>
