@extends('layouts.app')

@section('content')
    <div id="app"></div>
@endsection

@section('title')
    {{ $category->name }} - {{ env('APP_NAME')}}
@endsection


@section('css')

    @if (isset($css))
        <link rel="stylesheet" href="{{ $css }}" data-s="blade">
    @endif


@endsection


@section('js')

    <script type="text/javascript">

        window._sharedData = {
            user: {!! $user ?? "null" !!},
            category: {!! $category ?? "{}" !!},
            products: {!! json_encode($products) !!},
            categories: {!! json_encode($categories) !!}
        }

    </script>

    <script src="{{ mix('js/manifest.js') }}"></script>

    <script src="{{ mix('js/vendor.js') }}"></script>

    <script src="{{ $js }}" type="text/javascript" async></script>

@endsection
