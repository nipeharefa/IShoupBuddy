@extends('layouts.app')

@section('css')
	
	<link rel="stylesheet" href="{{ mix('css/guest/login.css') }}">

@endsection

@section('content')
   
   <div id="app"></div> 

    
@endsection


@section('js')
	
	<script src="{{ mix('manifest.js') }}"></script>
	<script src="{{ mix('js/guest/vendor.js') }}"></script>
	<script src="{{ mix('js/guest/login.js') }}" type="text/javascript"></script>

@endsection