@extends('layouts.app', ['page_title' => 'Museums'])

@section('content')
    <section class="mt-32 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center font-heading">
            <span>@lang('nav.museums')</span>
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
                    @each('partials.client.museums.prev', $museums, 'museum', 'partials.client.layout.not-found')
                </div>
                {{--<div class="flex flex-wrap justify-center mt-6">

                    @foreach($museums as $museum)
                        @if($loop->first || $loop->iteration == 11 || $loop->iteration == 21 )
                            <div class="w-full sm:w-1/2 lg:w-1/3">
                                @endif
                                <p><a href="{{route('client.museums.show', $museum)}}"> - {{$museum->title}}</a></p>
                                @if($loop->last || $loop->iteration == 10 || $loop->iteration == 20)
                            </div>
                        @endif

                    @endforeach
                </div>--}}
            </div>
        </div>
        @if ($museums->count() > 1)
            <div class="container mt-10">
                {{ $museums->appends(request()->except('page'))->links() }}
            </div>
        @endif
    </section>

@endsection

@section('meta')
    <meta property="og:type" content="shop.group">
    @foreach($museums as $museum)
        @includeIf('partials.client.layout.meta', ['meta' => $museum->meta()->first()])
    @endforeach
@endsection