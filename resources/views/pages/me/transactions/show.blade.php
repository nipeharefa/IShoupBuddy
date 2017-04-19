@extends('layouts.app')

@section('title')
    Transactions Detail
@endsection

@section('content')
    <div id="app"></div>
@endsection


@section('css')

    <link rel="stylesheet" href="{{ asset('local/bulma/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/member/show_transaction.css') }}">

@endsection

@section('js')

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/member_show_transaction.js') }}"></script>
@endsection
