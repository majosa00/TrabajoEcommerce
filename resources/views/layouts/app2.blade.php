<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnergeticWave · @yield('title', 'Home')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/energeticwave-favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- JS -->
    <script src="{{ asset('js/checkout.js') }}" defer></script>
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
    <!-- Incluye Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" defer></script>
    <!-- Incluye Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
</head>

<body>
    @include('partials.navbar2')

    @yield('content')

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
