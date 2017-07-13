@extends('layouts.app')

@section('title')
Login
@stop

@section('css')

	<link rel="stylesheet" href="{{ mix('css/guest/login.css') }}">

@endsection

@section('content')

   <div id="app"></div>


@endsection


@section('js')

	<script src="{{ mix('js/manifest.js') }}"></script>
	<script src="{{ mix('js/vendor.js') }}"></script>
	<script src="{{ mix('js/login_default.js') }}" type="text/javascript"></script>

@endsection
