@extends('layouts.main', ['page_title' => 'Home'])

@section('content')
    @includeWhen($banners->count(), 'client.home.partials.slideshow')
    @includeWhen($new->count(), 'client.home.partials.new')
    @includeWhen($recommended->count(), 'client.home.partials.recommended')
    @includeWhen($sellers->count(), 'client.home.partials.sellers')
    @includeWhen($exhibits->count(), 'client.home.partials.exhibits')
    @includeWhen($museums->count(), 'client.home.partials.museums')
    @include('client.home.partials.information')
    @includeWhen($popular->count(), 'client.home.partials.popular')
    @includeWhen($benefits->count(), 'client.home.partials.benefits')
    @includeWhen($articles->count(), 'client.home.partials.articles')
    @include('client.home.partials.help')
    @include('client.home.message')
@endsection

@section('meta')
    {{--@includeIf('partials.client.layout.meta', ['meta' => $banner->meta()->first()])--}}

@endsection