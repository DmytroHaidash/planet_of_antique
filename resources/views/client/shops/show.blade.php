@extends('layouts.app', ['page_title' => $shop->title])

@section('content')

    <section class="mb-12 container">
        <h1 class="text-5xl font-thin text-center hidden lg:flex justify-center items-center">{{ $shop->title }}</h1>
        <div class="flex flex-wrap sm:-mx-8 justify-center">
            <div class="lg:w-1/3">
                <img data-src="{{ $shop->logo }}" class="lozad" >
            </div>

            <div class="lg:w-2/3">
                <h1 class="text-5xl font-thin text-center lg:hidden">{{ $shop->title }}</h1>
                <div class="page-content">
                    <div class="flex items-center mb-8 font-serif italic text-xl">
                        <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
                    </div>
                    <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                        @lang('common.about')
                    </div>

                    {!! $shop->description !!}
                </div>
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
        @if($products)
            @if($categories)
                <div class="flex flex-wrap justify-center">
                    @foreach($categories as $item)
                        <a href="{{'?category='.$item->slug }}"
                           class="mx-px button button--primary{{ $category == $item->slug ? '' : '-outline' }}">
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
        @endif
    </section>

@endsection

@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $shop->meta()->first()])
@endsection