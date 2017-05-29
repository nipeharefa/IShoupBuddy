@extends('layouts.app')

@section('content')
    <div id="app"></div>
@stop

@section('js')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/a-auth-login.js') }}"></script>
@stop


@section('css')
    <link rel="stylesheet" href="{{ mix('css/admin/auth/login.css') }}">
@stop


@section('title')
    Admin Login
@stop
