<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') . (isset($page_title) ? ' | ' . $page_title : '') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
</head>
<body>
<header class="header">
    <div class="content-wrapper">
        <nav class="main-nav">
            <div class="main-nav__menu-wrapper">
                <a href="/" class="logo-link">{{config('app.name')}}</a>
            </div>
        </nav>
    </div>
</header>
<section id='app' class="min-h-screen flex flex-column justify-center items-center py-10">
    @yield('content')
</section>

<script src="{{ asset('js/client.js') }}" defer></script>
@stack('scripts')
</body>
</html>
