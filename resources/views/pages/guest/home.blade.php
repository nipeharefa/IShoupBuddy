@extends('layouts.app')


@section('content')
	
	<div id="app"></div>

@endsection

@section('css')
	
	<link rel="stylesheet" href="{{ mix('css/guest/home.css') }}">
	<link rel="stylesheet" href="{{ asset('local/swiper/swiper.min.css') }}">

@endsection

@section('js')
	
	<script src="{{ mix('manifest.js') }}"></script>
	<script src="{{ mix('js/guest/vendor.js') }}"></script>	

	<script src="{{ asset('local/swiper/swiper.min.js') }}"></script>
	<script src="{{ mix('js/guest/home.js') }}" type="text/javascript"></script>	

@endsection