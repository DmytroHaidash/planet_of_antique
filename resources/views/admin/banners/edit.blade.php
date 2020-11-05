@extends('layouts.admin', ['page_title' => $banner->title])

@section('content')

    <section>
        <form action="{{ route('admin.banners.update', $banner) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')


            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') ?? $banner->title }}" required>
                        @if($errors->has('title'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input id="description" type="text" name="description"
                               class="form-control"
                               value="{{ old('description') ?? $banner->description}}">
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input id="url" type="text" name="url"
                               class="form-control"
                               value="{{ old('url') ?? $banner->url}}">
                    </div>
                </div>

                <div class="col-lg-4">
                    <single-uploader name="banner"
                                     src="{{ optional($banner->getFirstMedia('banner'))->getFullUrl() }}"></single-uploader>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection