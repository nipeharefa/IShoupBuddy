@extends('layouts.app')

@section('content')
    <div id="app"></div>
    <meta name="_dota2" content="Dazzle">
@stop

@section('title')
    @if (isset($title))
        {{ $title }}
    @endif
@stop

@section('css')

    @if (isset($css))
        <link rel="stylesheet" href="{{ $css }}" data-s="blade" data-fightme="true">
    @endif

@stop

@section('js')

    <script type="text/javascript">
        window._sharedData = {
            "product_id": {{ $id }},
            "user": {!! $user !!}
        }
    </script>

    <script src="{{ mix('js/manifest.js') }}"></script>

    @if (env('APP_ENV') == "production")

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
    @else
        <script src="{{ asset('local/swiper/swiper.min.js') }}"></script>
    @endif

    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/polifyls07.js') }}"></script>

    @if (isset($js))
        <script src="{{ $js }}" type="text/javascript" async></script>
    @endif


@stop
