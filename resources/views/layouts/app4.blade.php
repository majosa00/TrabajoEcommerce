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
</head>

<body>
    @include('partials.navbar3')

    @include('partials.carrousel') 

    @include('partials.productslanding') 

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-5">
                    @include('partials.brandslanding') 
                </div>
                <div class="mb-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer2')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>