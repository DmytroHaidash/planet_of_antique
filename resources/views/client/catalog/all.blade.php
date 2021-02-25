@extends('layouts.app', ['page_title' => 'Catalog'])

@section('content')
    <section class="mb-12 container">
        <div class="container mx-0">
            @include('partials.client.catalog.search')
            @include('partials.client.catalog.filters')
            <div class="flex flex-wrap justify-center mt-6">
                @each('partials.client.catalog.prev', $products, 'product', 'partials.client.layout.not-found')
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