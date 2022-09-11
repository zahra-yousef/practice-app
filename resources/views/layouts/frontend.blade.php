<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
        
    </head>
    <body>
        
        <div>
            @include('layouts.inc.navbar')
            @yield('content')
        </div>

        <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap5.bundle.js') }}"></script>

    </body>
</html>
