@extends('layouts.app', ['page_title' => $page->title])

@section('content')
    @if($page->hasMedia('cover'))
    <section class="lozad page-header" data-background-image="{{ $page->getFirstMediaUrl('cover') }}"></section>
    @endif
    <section class="{{$page->hasMedia('cover')? '-mt-32' : 'mt-32'}} mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>{{ $page->title }}</span>
        </h1>
        <div class="page-content mt-8">
            {!! $page->description !!}
        </div>
    </section>

@endsection
@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $page->meta()->first()])
@endsection