@extends('layouts.app')

@section('content')
    <div id="app"></div>
@endsection


@section('css')

    <link rel="stylesheet" href="{{ mix('css/vendor/product/create.css') }}">

@stop

@section('js')

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/vendor_product_create.js') }}"></script>
@stop
