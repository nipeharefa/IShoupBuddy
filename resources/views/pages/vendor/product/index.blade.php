@extends('layouts.app')

@section('title')

@stop

@section('content')
    <div id="app"></div>
@stop

@section('css')

    <script type="text/javascript">

        window._sharedData = {
            user: {!! $user ?? "null" !!},
            categories: {!! $categories ?? "{}" !!}
        }
    </script>

    @if (env('APP_ENV') == "production")
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.3/css/bulma.min.css">
    @else
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.3/css/bulma.min.css">
    @endif

    <link rel="stylesheet" href="{{ mix('css/vendor/product/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.1.1/css/iziToast.min.css">
@stop

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}"
    async defer></script>
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/vendor_product_index.js') }}" async></script>
@stop


