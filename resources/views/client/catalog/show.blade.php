@extends('layouts.app', ['page_title' => $product->translate('title')])


@section('content')
    <section class="mb-12">
        <div class="container">
            <h1 class="text-5xl font-thin leading-none text-center">{{ $product->translate('title') }}</h1>
            <div class="flex flex-wrap sm:-mx-8 mt-12 justify-content-center">
                <div class="lg:w-1/2 order-2 md:order-1">
                    <a href="{{ $product->getBanner('uploads') }}">
                        <img data-src="{{ $product->getBanner('uploads') }}" class="lozad mb-4"
                             alt="{{ $product->translate('title') }}" data-fancybox="gallery"
                             data-background-image="{{ $product->getBanner() }}">
                    </a>
                    @if($product->hasMedia('uploads'))
                        <h6 class="mb-4">@lang('pages.product.all_photos')</h6>
                        <div class="flex flex-wrap">
                            @foreach($product->getMedia('uploads')->slice(1) as $photo)
                                <div class="w-1/2 lg:w-1/3 px-1 mb-1">
                                    <a href="{{ $photo->getUrl('banner') }}">
                                        <img data-fancybox="gallery" data-src="{{ $photo->getFullUrl() }}"
                                             class="lozad">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="lg:w-1/2 order-1 md:order-2">
                    <div class="flex align-items-center align-items-lg-end mb-4 ml-4">
                        <div class="lg:w-5/6">
                            <h4 class="price text-2xl">
                                <small class="text-muted">@lang('pages.product.shop'):</small>
                                <a href="{{route('client.shops.show', $product->shop) }}">{{$product->shop->title}}</a>
                            </h4>
                            @if($product->publish_price && $product->in_stock == 'stock')
                                <h4 class="price text-2xl">
                                    <small class="text-muted">@lang('pages.product.price'):</small>
                                    {{ number_format($product->price, 0, ',', ' ') }}
                                    @lang('common.currency')
                                </h4>
                            @endif
                            <p class="lead mb-2">{{ $product->description }}</p>
                            {!! $product->body !!}
                        </div>
                        <div class="hidden lg:flex lg:w-1/6">
                            <div class="text-right">
                                @if ($product->in_stock == 'sold')
                                    <p class="text-success">@lang('pages.product.sold')</p>
                                @elseif($product->in_stock == 'reserved')
                                    <p class="text-danger">@lang('pages.product.reserved')</p>
                                @endif
                                @if(!$product->publish_price)
                                    <div class="ml-auto mt-4">
                                        <button class="button button--primary modal-btn-3"
                                                data-open-price="askPrice">
                                            @lang('pages.product.ask_price')
                                        </button>
                                    </div>
                                @else
                                    <div class="ml-auto mt-4">
                                        <button class="button button--primary modal-btn"
                                                data-modal-open="buyModal">
                                            @lang('pages.product.buy')
                                        </button>
                                    </div>
                                @endif
                                @if($product->bargain)
                                    <div class="ml-auto mt-4">
                                        <button class="button button--primary modal-btn-4"
                                                data-open-barg="bargain">
                                            @lang('pages.product.bargain')
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>


                    </div>

                    <div class="ml-4">
                        <div class="flex lg:hidden">
                            <div class="text-right">
                                @if ($product->in_stock == 'sold')
                                    <p class="text-success">@lang('pages.product.sold')</p>
                                @elseif($product->in_stock == 'reserved')
                                    <p class="text-danger">@lang('pages.product.reserved')</p>
                                @endif
                                @if(!$product->publish_price)
                                    <div class="ml-auto mt-4">
                                        <button class="button button--primary modal-btn-3"
                                                data-open-price="askPrice">
                                            @lang('pages.product.ask_price')
                                        </button>
                                    </div>
                                @else
                                    <div class="ml-auto mt-4">
                                        <button class="button button--primary modal-btn"
                                                data-modal-open="buyModal">
                                            @lang('pages.product.buy')
                                        </button>
                                    </div>
                                @endif
                                @if($product->bargain)
                                    <div class="ml-auto mt-4">
                                        <button class="button button--primary modal-btn-4"
                                                data-open-barg="bargain">
                                            @lang('pages.product.bargain')
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 mb-4">
                            <button class="button button--primary modal-button"
                                    data-modal-opened="question">
                                @lang('pages.product.question')
                            </button>
                        </div>
                        @if(Auth::user() && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('admin') && Auth::user()->shop->id == $product->shop->id)))
                            <a href="{{route('client.catalog.pdf', $product)}}"
                               class=" button button--primary-outline xl:mt-4 mb-4">
                                @lang('pages.product.pdf')
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($popular->count())
            <div class="hidden xl:flex"></div>
            <div class="container mt-10">
                <div class="flex flex-wrap justify-center mt-6">
                    @foreach($popular as $item)
                        @include('partials.client.catalog.prev', ['product' => $item])
                    @endforeach
                </div>
            </div>
            </div>
        @endif
    </section>


    @include('client.catalog.order-modal')
    @include('client.catalog.question-modal')
    @include('client.catalog.ask-price-modal')
    @include('client.catalog.bargain-modal')

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endpush

@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $product->meta()->first()])
    <meta property="og:type" content="product.item">
    <meta property="og:image"
          content="{{ $product->hasMedia('uploads') ? $product->getFirstMedia('uploads')->getFullUrl() : '' }}">
    <meta property="product:condition" content="new">
    <meta property="product:availability" content="{{$product->in_stock}}">
    <meta property="product:price:amount" content="{{ $product->price }}">
    <meta property="product:price:currency" content="грн">
@endsection

