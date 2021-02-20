@extends('layouts.admin', ['page_title' => $museum->title])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush


@section('content')

    <section>
        <form action="{{ route('admin.museums.update', $museum) }}" method="post" enctype="multipart/form-data">
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
                                           value="{{ old('title.'. $lang) ?? $museum->translate('title', $lang)}}">
                                    @if($errors->has('title'))
                                        <div class="mt-1 text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea
                                            id="about"
                                            name="body[{{$lang}}]"
                                            rows="4"
                                            class="editor"
                                    >{{ old('body.'.$lang) ?? $museum->translate('body', $lang) }}</textarea>
                                </div>
                            </fieldset>
                        @endforeach
                    </block-editor>
                    @includeIf('partials.admin.meta', ['meta' => $museum->meta()->first()])
                    <div class="flex">
                        <div class="px-6 pt-3">
                            <div class="form-checkbox">
                                <input type="checkbox" name="published"
                                       id="published" {{ $museum->published ? 'checked' : '' }}>
                                <label for="published">Published</label>
                            </div>
                            <div class="form-checkbox">
                                <input type="checkbox" name="recommended"
                                       id="recommended" {{ $museum->recommended ? 'checked' : '' }}>
                                <label for="recommended">Recommended</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-2">
                        <P>Logo</P>
                        <single-uploader name="logo"
                                         src="{{ optional($shop->getFirstMedia('logo'))->getFullUrl() }}"></single-uploader>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection