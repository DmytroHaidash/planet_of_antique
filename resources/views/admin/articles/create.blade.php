@extends('layouts.admin', ['page_title' => 'New article'])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush

@section('content')

    <section>
        <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-8">
                    <block-editor>
                        @foreach(config('app.locales') as $lang)
                            <fieldset slot="{{ $lang }}">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" type="text" name="title[{{$lang}}]"
                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           value="{{ old('title') }}">
                                    @if($errors->has('title.' .$lang))
                                        <div class="mt-1 text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input id="description" type="text" name="description[{{$lang}}]"
                                           class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                           value="{{ old('description.'.$lang) }}">
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
                                    >{{ old('body.' .$lang) }}</textarea>
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
                                               value="{{ $tag->id }}">
                                        <label class="custom-control-label" for="tag-{{$tag->id}}">
                                            {{ $tag->title }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @includeIf('partials.admin.meta', ['meta' => null])
                </div>

                <div class="col-lg-4">
                    <single-uploader name="article"></single-uploader>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection