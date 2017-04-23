@extends('layouts.app')
@section('title')
Shoupbud
@stop

@section('content')
    <div id="app"></div>
@stop

@section('css')

    <link rel="stylesheet" href="{{ mix('css/member/home.css') }}">

    @if (env('APP_ENV') == "production")

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
    @else
        <link rel="stylesheet" href="{{ asset('local/swiper/swiper.min.css') }}">
    @endif
@stop

@section('js')
    <script type="text/javascript">

        window._sharedData = {
            user: {!! $user !!}
        }
    </script>

    <script src="{{ mix('js/manifest.js') }}"></script>

    @if (env('APP_ENV') == "production")

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>

    @else
        <script src="{{ asset('local/swiper/swiper.min.js') }}"></script>
    @endif

    <script src="{{ mix('js/vendor.js') }}"></script>

    <script src="{{ mix('js/mhome.js') }}" type="text/javascript" async></script>
@stop
