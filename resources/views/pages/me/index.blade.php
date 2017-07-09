@extends('layouts.app')

@section('title')
Dashboard Member
@endsection

@section('content')
	<div id="app"></div>
@endsection


@section('css')

	<link rel="stylesheet" href="{{ mix('css/member/me.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.1.1/css/iziToast.min.css">
@endsection

@section('js')

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}"
    async defer></script>

    <script>
        window._sharedData = {
            user: {!! $user !!}
        }
    </script>

	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('js/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ mix('js/me.js') }}" async></script>
@endsection
