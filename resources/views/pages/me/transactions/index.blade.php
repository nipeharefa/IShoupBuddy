@extends('layouts.app')

@section('title')
    Transactions
@endsection

@section('content')
    <div id="app"></div>
@endsection


@section('css')

    <link rel="stylesheet" href="{{ asset('local/bulma/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/member/transactions.css') }}">

@endsection

@section('js')

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/member_transactions.js') }}"></script>
@endsection
