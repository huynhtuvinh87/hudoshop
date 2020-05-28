<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon" />
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:image" content="@yield('og_image')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image')">
    <meta property="og:description" content="@yield('title')">
    <meta name="format-detection" content="telephone=no">
</head>

<body>
    @yield('content')
</body>

</html>
