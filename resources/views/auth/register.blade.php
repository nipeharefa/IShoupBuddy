@extends('layouts.app')

@section('css')

    @if (env('APP_ENV') == "production")
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.0/css/bulma.min.css">
    @else
        <link rel="stylesheet" href="{{ asset('local/bulma/0.5.0/bulma.min.css') }}">
    @endif

    <link rel="stylesheet" href="{{ mix('css/guest/register.css') }}">

@endsection

@section('content')

    <div id="app"></div>

@endsection

@section('js')

    <script type="text/javascript">

        window._sharedData = {
            user: {!! $user ?? "{}" !!},
            categories: {!! $categories ?? "[]" !!}
        }
    </script>

    <script src="{{ mix('js/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/register.js') }}" type="text/javascript" async></script>

@endsection
