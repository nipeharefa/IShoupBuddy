@extends('layouts.app')

@section('css')
    
    <link rel="stylesheet" href="{{ mix('css/guest/register.css') }}">

@endsection

@section('content')
    
    <div id="app"></div>

@endsection

@section('js')
    
    <script src="{{ mix('js/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/register.js') }}" type="text/javascript" async></script>

@endsection