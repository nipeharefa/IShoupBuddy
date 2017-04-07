@extends('layouts.app')

@section('css')
    
    <link rel="stylesheet" href="{{ mix('css/guest/register.css') }}">

@endsection

@section('content')
    
    <div id="app"></div>

@endsection

@section('js')
    
    <script src="{{ mix('js/guest/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/guest/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/guest/register.js') }}" type="text/javascript"></script>

@endsection