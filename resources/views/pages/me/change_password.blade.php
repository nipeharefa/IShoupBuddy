@extends('layouts.app')


@section('content')
    <div id="app"></div>
@endsection


@section('css')


    <link rel="stylesheet" href="{{ mix('css/member/change_password.css') }}">

@endsection

@section('js')

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/change_password.js') }}"></script>

@endsection
