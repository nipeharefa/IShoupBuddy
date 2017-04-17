@extends('layouts.app')


@section('content')
	<div id="app"></div>
@endsection


@section('css')

	<link rel="stylesheet" href="{{ mix('css/member/me.css') }}">
@endsection

@section('js')

	<script src="{{ mix('manifest.js') }}"></script>
	<script src="{{ mix('js/member/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ mix('js/member/me.js') }}"></script>
@endsection