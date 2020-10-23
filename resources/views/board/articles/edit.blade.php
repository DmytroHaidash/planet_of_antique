@extends('layouts.board', ['page_title' => $article->title])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush

@section('content')

    <section>
        <form action="{{ route('board.articles.update', $article) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')


            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') ?? $article->title }}" required>
                        @if($errors->has('title'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input id="description" type="text" name="description"
                               class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                               value="{{ old('description') ?? $article->description}}">
                        @if($errors->has('description'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea
                                id="body"
                                name="body"
                                rows="4"
                                class="editor"
                        >{{ old('body') ?? $article->body }}</textarea>
                    </div>
                </div>

                <div class="col-lg-4">
                    <single-uploader name="article"
                                     src="{{ optional($article->getFirstMedia('article'))->getFullUrl() }}"></single-uploader>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection