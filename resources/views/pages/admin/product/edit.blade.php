@extends('layouts.app')

@section('content')
    <div id="app"></div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin/product/edit.css') }}">
@stop

@section('js')

    <script type="text/javascript">
        window.__sharedData = {
            "product_id": {{ $id }}
        }
    </script>

    <script src="{{ mix('js/manifest.js') }}" type="text/javascript"></script>

    <script src="{{ mix('js/vendor.js') }}" type="text/javascript"></script>


    <script src="{{ mix('js/a-edit-product.js') }}"></script>


@stop
