@extends('layouts.app', ['page_title' => 'Home'])

@section('content')
    @includeWhen($banners->count(), 'client.home.partials.slideshow')
    @include('client.home.partials.new')
    @include('client.home.partials.recommended')
    @include('client.home.partials.sellers')
    @include('client.home.partials.information')
    @include('client.home.partials.popular')
    @include('client.home.partials.benefits')
    @include('client.home.partials.articles')
    @include('client.home.partials.help')

@endsection

@section('meta')
    {{--@includeIf('partials.client.layout.meta', ['meta' => $banner->meta()->first()])--}}

@endsection