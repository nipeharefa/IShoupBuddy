@extends('layouts.app')


@section('content')

	<div id="app"></div>
	
@endsection


@section('css')
	
	<link rel="stylesheet" href="{{ mix('css/guest/product_detail.css') }}">

	@if (env('APP_ENV') == "production")
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
	@else		
		<link rel="stylesheet" href="{{ asset('local/swiper/swiper.min.css') }}">
	@endif	

@endsection


@section('js')

	<script src="{{ mix('js/manifest.js') }}"></script>

	@if (env('APP_ENV') == "production")
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
	@else		
		<script src="{{ asset('local/swiper/swiper.min.js') }}"></script>
	@endif	

	<script src="{{ mix('js/vendor.js') }}" type="text/javascript"></script>	
	
	<script src="{{ mix('js/product_detail.js') }}" type="text/javascript" async></script>

@endsection