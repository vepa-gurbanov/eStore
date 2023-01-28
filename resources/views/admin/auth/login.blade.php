<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#712cf9">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-auth.css') }}">
    <title>Login</title>
</head>
<body class="text-center">

@include('admin.app.alert')
<main class="form-signin w-100 m-auto">
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        @honeypot
        <div class="form-floating">
            <input type="email" class="form-control" name="email" id="email" placeholder="@lang('global.emailAddress')">
            <label for="email">@lang('global.emailAddress')</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="password" placeholder="@lang('global.password')">
            <label for="password">@lang('global.password')</label>
        </div>
        <div class="text-center">
            or
        </div>
        <button class="w-100 btn btn-lg btn-outline-primary fs-6" id="otp_code" type="submit">@lang('global.loginWithOtp')</button>
        <button class="w-100 btn btn-lg btn-primary signin fs-6" type="submit">@lang('global.submit')</button>
    </form>
</main>

<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
