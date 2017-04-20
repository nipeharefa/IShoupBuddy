@extends('layouts.app')

@section('title')
    Products Favorite
@endsection

@section('content')
    <div id="app"></div>
@endsection


@section('css')

    @if (env('APP_ENV') == "production")
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css">
    @else
        <link rel="stylesheet" href="{{ asset('local/bulma/bulma.min.css') }}">

    @endif
    <link rel="stylesheet" href="{{ mix('css/member/product_favorite.css') }}">

@endsection

@section('js')

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/product_favorite.js') }}"></script>
@endsection
