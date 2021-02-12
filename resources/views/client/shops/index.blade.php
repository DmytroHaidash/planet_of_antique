@extends('layouts.client', ['page_title' => 'Sellers'])

@section('content')
    <section class="mt-32 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>@lang('nav.sellers')</span>
        </h1>
        <div class="mt-32 mb-12">
            <div class="container mx-0">
                @include('partials.client.catalog.search')
                <div class="flex flex-wrap justify-center mt-6">
                    @each('partials.client.catalog.preview', $shops, 'product', 'partials.client.layout.not-found')
                </div>
            </div>
        </div>
        @if ($shops->count() > 1)
            <div class="container mt-10">
                {{ $shops->appends(request()->except('page'))->links() }}
            </div>
        @endif
    </section>

@endsection

@section('meta')
    <meta property="og:type" content="shop.group">
    @foreach($shops as $shop)
        @includeIf('partials.client.layout.meta', ['meta' => $shop->meta()->first()])
    @endforeach
@endsection