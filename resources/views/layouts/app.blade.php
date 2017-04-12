<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel')</title>

    <!-- Styles -->

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    
    @if (env('APP_ENV') == "production")

    @else
        <link rel="stylesheet" href="{{ asset('local/fontawesome/css/font-awesome.min.css') }}">
    @endif 
    @yield('css')

</head>
<body>
    
    @yield('content')

    @yield('js')
</body>
</html>
