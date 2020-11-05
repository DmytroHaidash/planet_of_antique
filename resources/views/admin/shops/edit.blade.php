@extends('layouts.admin', ['page_title' => $shop->title])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush


@section('content')

    <section>
        <form action="{{ route('admin.shops.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') ?? $shop->title}}" required>
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
                                name="description"
                                rows="4"
                                class="editor"
                        >{{ old('description') ?? $shop->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="delivery">Delivery</label>
                        <textarea
                                id="delivery"
                                name="delivery"
                                rows="4"
                                id="delivery"
                                class="editor"
                        >{{ old('delivery') ?? $shop->delivery }}</textarea>
                    </div>
                    @includeIf('partials.admin.meta', ['meta' => $shop->meta()->first()])
                    <div class="flex">
                        <div class="px-6 pt-3">
                            <div class="form-checkbox">
                                <input type="checkbox" name="published" id="published" {{ $shop->published ? 'checked' : '' }}>
                                <label for="published">Published</label>
                            </div>
                            <div class="form-checkbox">
                                <input type="checkbox" name="partner" id="partner" {{ $shop->partner ? 'checked' : '' }}>
                                <label for="partner">Partner</label>
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
                    <div class="mb-2">
                        <P>Banner</P>
                        <single-uploader name="banner"
                                         src="{{ optional($shop->getFirstMedia('banner'))->getFullUrl() }}"></single-uploader>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection