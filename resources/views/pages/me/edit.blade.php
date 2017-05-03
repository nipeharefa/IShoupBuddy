@extends('layouts.app')


@section('content')
	<div id="app"></div>
@endsection


@section('css')

	<link rel="stylesheet" href="{{ mix('css/member/edit_profile.css') }}">
@endsection

@section('js')

    <script type="text/javascript">
        window._sharedData = {
            user: {!! $user !!}
        }
    </script>
	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('js/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ mix('js/edit_profile.js') }}"></script>

@endsection
