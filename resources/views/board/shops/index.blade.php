@extends('layouts.board', ['page_title' => $shop->title])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush


@section('content')

    <section>
        <form action="{{ route('board.shops.update', $shop) }}" method="post" enctype="multipart/form-data">
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
                                           value="{{ old('title.'. $lang) ?? $shop->translate('title', $lang)}}">
                                    @if($errors->has('title'))
                                        <div class="mt-1 text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea
                                            id="description"
                                            name="description[{{$lang}}]"
                                            rows="4"
                                            class="editor"
                                    >{{ old('description.'. $lang) ?? $shop->translate('description', $lang) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="delivery">Delivery</label>
                                    <textarea
                                            id="delivery"
                                            name="delivery[{{$lang}}]"
                                            rows="4"
                                            id="delivery"
                                            class="editor"
                                    >{{ old('delivery.'.$lang) ?? $shop->translate('delivery', $lang) }}</textarea>
                                </div>

                                @if(Auth::user()->role == 'admin' || (Auth::user()->primium && Auth::user()->premium >= now()))
                                    <div class="form-group">
                                        <label for="contacts">Contacts</label>
                                        <textarea
                                                id="contacts"
                                                name="contacts[{{$lang}}]"
                                                rows="4"
                                                id="contacts"
                                                class="editor"
                                        >{{ old('contacts.'.$lang) ?? $shop->translate('contacts', $lang) }}</textarea>
                                    </div>
                                @endif
                            </fieldset>
                        @endforeach
                    </block-editor>
                    @includeIf('partials.admin.meta', ['meta' => $shop->meta()->first()])
                    <div class="flex">
                        <div class="px-6 pt-3">
                            <div class="form-checkbox">
                                <input type="checkbox" name="published"
                                       id="published" {{ $shop->published ? 'checked' : '' }}>
                                <label for="published">Published</label>
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