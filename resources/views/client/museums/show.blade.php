@extends('layouts.app', ['page_title' => $museum->title])

@section('content')

    <section class="mb-12 container">
        <h1 class="text-5xl font-thin text-center hidden lg:flex justify-center items-center">{{ $museum->title }}</h1>
        <div class="flex flex-wrap sm:-mx-8 justify-center mb-2">
            <div class="lg:w-1/2">
                <img data-src="{{ $museum->logo  }}" class="lozad justify-content-end">
            </div>

            <div class="lg:w-1/2">
                <h1 class="text-5xl font-thin text-center lg:hidden">{{ $museum->title }}</h1>
                <div class="page-content">
                    <div class="flex items-center mb-8 font-serif italic text-xl">
                        <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
                    </div>
                    <div class="pl-4">
                        <div class="text-xl border-l border-yellow-500 mb-8">
                            @lang('common.about')
                        </div>

                        {!! $museum->body !!}
                    </div>
                </div>
            </div>
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
                <div class="exhibits grid">
                    @each('partials.client.exhibits.teaser', $exhibits, 'exhibit')
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