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
                    <block-editor>
                        @foreach(config('app.locales') as $lang)
                            <fieldset slot="{{ $lang }}">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" type="text" name="title[{{$lang}}]"
                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           value="{{ old($lang.'.title') ?? $article->translate('title', $lang) }}">
                                    @if($errors->has('title'))
                                        <div class="mt-1 text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input id="description" type="text" name="description[{{$lang}}]"
                                           class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                           value="{{ old('description') ?? $article->translate('description', $lang)}}">
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
                                            name="body[{{$lang}}]"
                                            rows="4"
                                            class="editor"
                                    >{{ old('body.'.$lang) ?? $article->translate('body', $lang) }}</textarea>
                                </div>
                            </fieldset>
                        @endforeach
                    </block-editor>
                    <div class="form-group">
                        <label for="section">Tags</label>
                        <ul class="list-unstyled">
                            @foreach($tags as $tag)
                                <li class="ml-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="tag-{{$tag->id}}" name="tags[]"
                                               {{ in_array($tag->id, $article->tags->pluck('id')->toArray()) ? 'checked' : '' }}
                                               value="{{ $tag->id }}">
                                        <label class="custom-control-label" for="tag-{{$tag->id}}">
                                            {{ $tag->title }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @includeIf('partials.admin.meta', ['meta' => $article->meta()->first()])
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