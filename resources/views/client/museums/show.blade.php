@extends('layouts.app', ['page_title' => $museum->title])

@section('content')

    <section class="mb-12 container">
        <div class="flex flex-wrap sm:-mx-8 h-25 justify-center items-center">
            <img data-src="{{ $museum->logoThumb }}" class="lozad w-1/3">

            <h1 class="text-5xl font-thin w-2/3">{{ $museum->title }}</h1>
        </div>
        <div class="page-content mt-8">
            <div class="flex items-center mb-8 font-serif italic text-xl">
                <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
            </div>
            <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                @lang('common.about')
            </div>

            {!! $museum->body !!}
        </div>
        @if($exhibits)
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
                    @each('partials.client.exhibits.prev', $exhibits, 'exhibit')
                </div>

                @if ( $exhibits->count() > 1)
                    <div class="container mt-10">
                        {{ $exhibits->appends(request()->except('page'))->links() }}
                    </div>
                @endif
            </div>
        @endif
    </section>

@endsection

@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $museum->meta()->first()])
@endsection