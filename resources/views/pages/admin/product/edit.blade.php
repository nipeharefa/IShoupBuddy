@extends('layouts.app')

@section('content')
    <div id="app"></div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin/product/edit.css') }}">
@stop

@section('js')
    <script src="{{ mix('js/manifest.js') }}"></script>

    <script src="{{ mix('js/vendor.js') }}"></script>


    <script src="{{ mix('js/a-edit-product.js') }}"></script>


@stop
