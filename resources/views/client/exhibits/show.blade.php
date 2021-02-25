@extends('layouts.app', ['page_title' => $exhibit->translate('title')])


@section('content')
    <section class="mb-12">
        <div class="container">
            <h1 class="text-5xl font-thin leading-none text-center">{{ $exhibit->translate('title') }}</h1>
            <div class="flex flex-wrap sm:-mx-8 mt-12 justify-content-center">
                <div class="lg:w-1/2 order-2 md:order-1">
                    <a href="{{ $exhibit->getBanner('uploads') }}">
                        <img data-src="{{ $exhibit->getBanner('uploads') }}" class="lozad mb-4"
                             alt="{{ $exhibit->translate('title') }}" data-fancybox="gallery"
                             data-background-image="{{ $exhibit->getBanner() }}">
                    </a>
                    @if($exhibit->hasMedia('uploads'))
                        <h6 class="mb-4">@lang('pages.product.all_photos')</h6>
                        <div class="flex flex-wrap">
                            @foreach($exhibit->getMedia('uploads')->slice(1) as $photo)
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
                    <div class="ml-4">
                        <h4 class="price text-2xl">
                            <small class="text-muted">@lang('pages.exhibit.museum'):</small>
                            <a href="{{route('client.museums.show', $exhibit->museum) }}">{{$exhibit->museum->title}}</a>
                        </h4>
                        <p class="lead mb-2">
                            {!! $exhibit->body !!}
                        </p>
                        <div class="mt-4">
                            <button class="button button--primary modal-button"
                                    data-modal-opened="exhibitsQuestion">
                                @lang('pages.product.question')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('client.exhibits.question-modal')
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endpush

@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $exhibit->meta()->first()])
    <meta property="og:type" content="product.item">
    <meta property="og:image"
          content="{{ $exhibit->hasMedia('uploads') ? $exhibit->getFirstMedia('uploads')->getFullUrl() : '' }}">
@endsection

