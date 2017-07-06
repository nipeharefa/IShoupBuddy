@extends('layouts.app')

@section('content')
    <div id="app"></div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin/transactions/index.css') }}">
@stop

@section('js')

    <script type="text/javascript">

        window._sharedData = {
            user: {!! $user !!}
        }
    </script>
    <script src="{{ mix('js/manifest.js') }}" type="text/javascript"></script>

    <script src="{{ mix('js/vendor.js') }}" type="text/javascript"></script>

    <script src="{{ mix('js/a-transactions-index.js') }}"></script>

@stop
