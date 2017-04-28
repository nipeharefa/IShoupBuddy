@extends('layouts.app')

@section('title')

@stop

@section('content')
    <div id="app"></div>
@stop

@section('css')

    @if (env('APP_ENV') == "production")
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css">
    @else
        <link rel="stylesheet" href="{{ asset('local/bulma/bulma.min.css') }}">
    @endif

    <link rel="stylesheet" href="{{ mix('css/vendor/product/index.css') }}">
@stop

@section('js')

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/vendor_product_index.js') }}" async></script>
@stop


