@extends('layouts.app', ['page_title' => $shop->title])

@section('content')
    <section class="lozad page-header" data-background-image="{{ $shop->FullBanner }}"></section>

    <section class="-mt-24 mb-12 container">
        <div class="flex flex-wrap sm:-mx-8 mt-12 justify-center">
            <img data-src="{{ $shop->logoThumb }}" class="lozad">

            <h1 class="text-5xl font-thin pt-2">{{ $shop->title }}</h1>
        </div>
        <div class="page-content mt-8">
            <div class="flex items-center mb-8 font-serif italic text-xl">
                <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
            </div>
            <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                @lang('common.about')
            </div>

            {!! $shop->description !!}
        </div>
        <div class="page-content mt-8">
            <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                @lang('common.delivery')
            </div>

            {!! $shop->delivery !!}
        </div>
        <div class="container mx-0">
            <div class="flex flex-wrap justify-center mt-6">
                @each('partials.client.catalog.prev', $products, 'product')
            </div>

            @if ($products->count() > 1)
                <div class="container mt-10">
                    {{ $products->appends(request()->except('page'))->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection

@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $shop->meta()->first()])
@endsection