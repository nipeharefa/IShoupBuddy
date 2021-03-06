@extends('layouts.app')


@section('content')
    <div id="app"></div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin/vendor/index.css') }}">
@stop

@section('title')
    Vendor List | Admin Dashboard - Shoupbud
@stop

@section('js')
    <script src="{{ mix('js/manifest.js') }}"></script>

    @if (env('APP_ENV') == "production")

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
    @else
        <script src="{{ asset('local/swiper/swiper.min.js') }}"></script>
    @endif

    <script src="{{ mix('js/vendor.js') }}"></script>

    <script src="{{ mix('js/a-vendor-user.js') }}" type="text/javascript" async></script>
@stop
