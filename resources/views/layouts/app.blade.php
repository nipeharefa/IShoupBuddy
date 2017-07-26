<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Shoubud.xyz:Situs Review Produk Supermarket')</title>
    <link href='/manifest.json' rel='manifest'>
    <meta content='yes' name='mobile-web-app-capable'>
    <meta content='#00d1b2' name='theme-color'>
    <meta content='IShoupBuddy' name='apple-mobile-web-app-title'>
    <meta content='black' name='apple-mobile-web-app-status-bar-style'>
    <meta content='#00d1b2' name='msapplication-navbutton-color'>
    <meta content='notranslate' name='google'>
    <meta name="google-key" id="google-key" content="{{ env('GOOGLE_KEY') }}" />

    <!-- Styles -->

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @if (env('APP_ENV') == "production")

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
