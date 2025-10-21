<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">

    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS datatables -->
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />

    <!-- CSS Bootstrap datatables -->
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">

</head>
<body>
    <!-- JS Bootstrap -->
    <script src=" {{ asset('assets/bootstrap/bootstrap.bundle.min.js') }} "></script>

    <!-- JS Jquery -->
    <script src="{{ asset('assets/jquery/jquery-3.7.0.min.js') }}" ></script>

    <!-- JS datatables -->
    <script src="{{ asset('assets/datatables/datatables.min.js') }}" ></script>

    <!-- JS Bootstrap datatables -->
    <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}" ></script>

    @include('header')

    @yield('content')
    
    @include('footer')

</body>
</html>