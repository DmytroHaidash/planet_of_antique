@extends('layouts.app', ['page_title' => 'Catalog'])

@section('content')
    <section class="lozad page-header" data-background-image="{{ $page->image }}"></section>

    <section class="-mt-24 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>
                @if(\Route::current()->getName() == 'client.catalog.index')
                    @lang('nav.catalog')
                @elseif(\Route::current()->getName() == 'client.catalog.new')
                    @lang('pages.new.title')
                @else
                    @lang('pages.recommended.title')
                @endif
            </span>
        </h1>
        <div class="mt-12 mb-12">
            <div class="container mx-0">
                @include('partials.client.catalog.search')
                @include('partials.client.catalog.filters')
                <div class="flex flex-wrap justify-center mt-6">
                    @each('partials.client.catalog.prev', $products, 'product', 'partials.client.layout.not-found')
                </div>

                @if ($products->count() > 1)
                    <div class="container mt-10">
                        {{ $products->appends(request()->except('page'))->links() }}
                        <div class="ml-auto">
                            <a href="{{ route('client.catalog.all') }}" class="btn btn-primary ml-3">
                                @lang('pages.catalog.all')
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
@section('meta')
    <meta property="og:type" content="product.group">
    @foreach($products as $product)
        @includeIf('partials.client.layout.meta', ['meta' => $product->meta()->first()])
    @endforeach
@endsection
