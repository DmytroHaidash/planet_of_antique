@extends('layouts.app', ['page_title' => 'Exhibits'])

@section('content')
    <section class="mt-12 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>@lang('nav.exhibits')</span>
        </h1>
        <div class="mt-12 mb-12">
            <div class="container mx-0">
                @include('partials.client.catalog.search')
                @include('partials.client.catalog.filters')
                <div class="flex flex-wrap justify-center mt-6">
                    @each('partials.client.exhibits.prev', $exhibits, 'exhibit', 'partials.client.layout.not-found')
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
    <meta property="og:type" content="product.group">
    @foreach($exhibits as $exhibit)
        @includeIf('partials.client.layout.meta', ['meta' => $exhibit->meta()->first()])
    @endforeach
@endsection
