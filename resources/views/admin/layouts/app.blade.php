<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title')●@lang('global.app-name')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</head>
<body>
@include('admin.app.header')
<div class="container-fluid">
    <div class="row">
        @include('admin.app.sidebar')
        @yield('content')
    </div>
</div>
<script type="application/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
</body>
</html>

