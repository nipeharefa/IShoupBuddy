@extends('layouts.app')

@section('content')
    <div id="app"></div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin/transactions/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.1.1/css/iziToast.min.css">
@stop

@section('js')

    <script type="text/javascript">

        window._sharedData = {
            user: {!! $user !!},
            categories: {!! $categories ?? "{}" !!}
        }
    </script>
    <script src="{{ mix('js/manifest.js') }}" type="text/javascript"></script>

    <script src="{{ mix('js/vendor.js') }}" type="text/javascript"></script>

    <script src="{{ mix('/js/polifyls07.js') }}"></script>

    <script src="{{ mix('js/a-transactions-index.js') }}"></script>

@stop
