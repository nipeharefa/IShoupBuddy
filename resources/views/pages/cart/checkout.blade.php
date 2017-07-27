@extends('layouts.app')

@section('content')
    <div id="app"></div>
    <meta name="_dota2" content="Rubick">
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

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}"
    async defer></script>

    <script type="text/javascript">

        window._sharedData = {
            user: {!! $user ?? "null" !!},
            cartData: {!! $cart_data ?? null !!},
            categories: {!! $categories ?? "{}" !!}
        }
    </script>

    <script src="{{ mix('js/manifest.js') }}"></script>

    @if (env('APP_ENV') == "production")

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script> --}}
    @else
        {{-- <script src="{{ asset('local/swiper/swiper.min.js') }}"></script> --}}
    @endif

    <script src="{{ mix('js/vendor.js') }}"></script>

    @if (isset($js))
        <script src="{{ $js }}" type="text/javascript" async></script>
    @endif


@stop
