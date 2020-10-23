<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">


    <title>{!! config('app.name', 'Impression Admin') . (isset($page_title) ? ' | ' . $page_title : '') !!}</title>

    <link rel="stylesheet" href="{{ asset('css/client.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162605115-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-162605115-1');
    </script>
    @yield('meta')
    @stack('styles')
</head>
<body>
{{--@include('partials.client.layout.icons')--}}

<div id="app" class="flex flex-col min-h-screen">
    @includeIf('partials.client.layout.header')
    {{--@includeIf('partials.client.layout.mesengers')--}}
    <main class="flex-1">
        @yield('content')
    </main>
    @includeIf('partials.client.layout.footer')
</div>

<script src="{{ asset('js/client.js') }}"></script>
@stack('scripts')
</body>
</html>
