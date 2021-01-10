<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
            href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Open+Sans:wght@400;600;700&display=swap"
            rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">



    <title>{!! config('app.name', 'Laravel') . (isset($page_title) ? ' | ' . $page_title : '') !!}</title>

    <link rel="stylesheet" href="{{ asset('css/client.css') }}">

    @yield('meta')
    @stack('styles')
</head>
<body>
<div id="app">
    @includeIf('partials.client.layout.header')
    @includeIf('partials.client.layout.icons')
    <main class="content">
        @yield('content')
    </main>
    @includeIf('partials.client.layout.footer')
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('js/client.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
@stack('scripts')
</body>
</html>
