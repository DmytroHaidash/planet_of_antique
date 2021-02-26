@extends('layouts.board', ['page_title' => 'New museum'])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush


@section('content')

    <section>
        <form action="{{ route('board.museums.store') }}" method="post" enctype="multipart/form-data">
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
                                           value="{{ old('title.'. $lang)}}">
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
                                    >{{ old('body.'.$lang) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="contacts">Contacts</label>
                                    <textarea
                                            id="contacts"
                                            name="contacts[{{$lang}}]"
                                            rows="4"
                                            id="contacts"
                                            class="editor"
                                    >{{ old('contacts.'.$lang) }}</textarea>
                                </div>
                            </fieldset>
                        @endforeach
                    </block-editor>
                    @includeIf('partials.admin.meta', ['meta' => null])
                    <div class="flex">
                        <div class="px-6 pt-3">
                            <div class="form-checkbox">
                                <input type="checkbox" name="published"
                                       id="published" checked>
                                <label for="published">Published</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-2">
                        <P>Logo</P>
                        <single-uploader name="logo"></single-uploader>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection