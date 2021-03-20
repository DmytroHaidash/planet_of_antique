@extends('layouts.app', ['page_title' => 'Exhibits'])

@section('content')
    <section class="lozad page-header" data-background-image="{{ $page->image }}"></section>

    <section class="-mt-24 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>@lang('nav.exhibits')</span>
        </h1>
        <div class="mt-12 mb-12">
            <div class="container mx-0">
                @include('partials.client.catalog.search')
                <div class="mb-4">
                    @include('partials.client.catalog.filters')
                </div>
                <div class="exhibits {{ $exhibits->count() ? 'grid' : '' }}">
                    @each('partials.client.exhibits.teaser', $exhibits, 'exhibit', 'partials.client.layout.not-found')
                </div>
                @if ($exhibits->count() > 1)
                    <div class="container mt-10">
                        {{ $exhibits->appends(request()->except('page'))->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
@section('meta')
    @foreach($exhibits as $exhibit)
        @includeIf('partials.client.layout.meta', ['meta' => $exhibit->meta()->first()])
    @endforeach
@endsection
