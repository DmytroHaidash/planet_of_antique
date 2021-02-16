@extends('layouts.app', ['page_title' => 'Sellers'])

@section('content')
    <section class="mt-32 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>@lang('nav.sellers')</span>
        </h1>
        <div class="mt-12 mb-12">
            <div class="container mx-0">
                <div class="flex flex-wrap justify-center">
                    @if ($search)
                        @foreach($search as $item)
                            <a href="{{'?search='.$item }}"
                               class="mx-px button button--primary{{ $search_letter == $item ? '' : '-outline' }}">
                                {{ $item }}
                            </a>
                        @endforeach
                        @if(request()->filled('search'))
                            <a href="{{ url()->current() }}" class="mx-px button button--primary-outline">
                                @lang('pages.catalog.filter.clear')
                            </a>
                        @endif
                    @endif

                </div>
                <div class="flex flex-wrap justify-center mt-6">
                    @foreach($shops as $shop)
                        @if($loop->first || $loop->iteration == 11 || $loop->iteration == 21 )
                            <div class="w-full sm:w-1/2 lg:w-1/3">
                                @endif
                                <p><a href="{{route('client.shops.show', $shop)}}"> - {{$shop->title}}</a></p>
                                @if($loop->last || $loop->iteration == 10 || $loop->iteration == 20)
                            </div>
                        @endif

                    @endforeach
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