@extends('layouts.app', ['page_title' => $shop->title])

@section('content')

    <section class="mb-12 container">
        <h1 class="text-5xl font-thin text-center hidden lg:flex justify-center items-center">{{ $shop->title }}</h1>
        <div class="flex flex-wrap sm:-mx-8 justify-center mb-2">
            <div class="lg:w-1/2">
                <img data-src="{{ $shop->logo }}" class="lozad justify-content-end">
            </div>

            <div class="lg:w-1/2">
                <h1 class="text-5xl font-thin text-center lg:hidden">{{ $shop->title }}</h1>
                <div class="page-content">
                    <div class="flex items-center mb-8 font-serif italic text-xl">
                        <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
                    </div>
                    <div class="pl-4">
                        <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                            @lang('common.about')
                        </div>

                        {!! $shop->description !!}
                    </div>
                </div>
                <div class="page-content mt-4">
                    <div class="flex items-center mb-8 font-serif italic text-xl">
                        <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
                    </div>
                    <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                        @lang('common.delivery')
                    </div>

                    {!! $shop->delivery !!}
                </div>
                @if(($shop->user->role == 'admin' || $shop->user->premium >= now()) && $shop->contacts)
                    <div class="page-content mt-4">
                        <div class="flex items-center mb-8 font-serif italic text-xl">
                            <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
                        </div>
                        <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                            @lang('common.contacts')
                        </div>

                        {!! $shop->contacts !!}
                    </div>
                @endif
            </div>
        </div>

        @if($products)
            @if($categories)
                <div class="flex flex-wrap justify-center">
                    @foreach($categories as $item)
                        <a href="{{'?category='.$item->slug }}"
                           class="mx-px  ml-2 mb-2 button button--primary{{ $category == $item->slug ? '' : '-outline' }}">
                            {{ $item->title }}
                        </a>
                    @endforeach
                    @if(request()->filled('category'))
                        <a href="{{ url()->current() }}" class="mx-px button button--primary-outline">
                            @lang('pages.catalog.filter.clear')
                        </a>
                    @endif
                </div>
            @endif

            <div class="flex flex-wrap justify-center mt-6">
                @each('partials.client.catalog.prev', $products, 'product')
            </div>

            @if ($products->count() > 1)
                <div class="container mt-10">
                    {{ $products->appends(request()->except('page'))->links() }}
                </div>
            @endif
        @endif
        @if($articles)
            <section class="section section-articles">
                <div class="content-wrapper">
                    <div class="section__header slider-header">
                        <h2 class="section__title">
                            @lang('common.articles')
                        </h2>
                        <a class="section__btn link-btn" href="{{route('client.blog.index', ['user_id' => $shop->user->id])}}">@lang('common.view')</a>
                    </div>

                    <div class="section-articles__articles-wrapper">
                        @foreach($articles as $item)
                            <article class="section-articles__article">
                                <a href="{{route('client.blog.show', $item)}}">
                                    <img src="{{$item->image}}" alt="article image" class="article__img">

                                    <h2 class="article__title">
                                        {{$item->title}}
                                    </h2>
                                    @if($item->description)
                                        <p class="article__paragraph">
                                            {{$item->description}}
                                        </p>
                                    @endif
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </section>

@endsection

@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $shop->meta()->first()])
@endsection