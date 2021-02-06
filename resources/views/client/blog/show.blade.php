@extends('layouts.app', ['page_title' => $post->title])

@section('content')

    <section class="lozad page-header" data-background-image="{{ $post->banner }}"></section>

    <section class="-mt-24 mb-12 container">
        <h1 class="text-5xl font-thin leading-none text-center">{{ $post->title }}</h1>
        <div class="page-content mt-8">
            <div class="flex items-center mb-8 font-serif italic text-xl">
                <time datetime="{{ $post->created_at }}">{{ mb_strtolower($post->created_at->formatLocalized('%d %B %Y')) }}</time>
                <hr class="border-b border-green-500 ml-4 my-0 flex-grow opacity-25">
            </div>

            <div class="text-xl border-l border-yellow-500 mb-8 pl-4">
                {{ $post->description }}
            </div>

            {!! $post->body !!}
        </div>
    </section>

@endsection

@section('meta')
    @includeIf('partials.client.layout.meta', ['meta' => $post->meta()->first()])
@endsection