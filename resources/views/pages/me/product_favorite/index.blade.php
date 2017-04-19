@extends('layouts.app')

@section('title')
    Products Favorite
@endsection

@section('content')
    <div id="app"></div>
@endsection


@section('css')

    {{-- <link rel="stylesheet" href="{{ mix('css/member/me.css') }}"> --}}

@endsection

@section('js')

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ mix('js/me.js') }}"></script> --}}
@endsection
