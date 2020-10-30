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
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') }}" required>
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
                               value="{{ old('description') }}">
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
                        >{{ old('body') }}</textarea>
                    </div>
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