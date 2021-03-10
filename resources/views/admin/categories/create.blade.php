@extends('layouts.admin', ['page_title' => 'New category'])

@section('content')

    <section>
        <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
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
                                           value="{{ old('title.'. $lang) }}">
                                    @if($errors->has('title'))
                                        <div class="mt-1 text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </fieldset>
                        @endforeach
                    </block-editor>
                    @includeIf('partials.admin.meta', ['meta' => null])
                </div>

                <div class="col-lg-4">
                    <single-uploader name="category"></single-uploader>
                </div>
            </div>

            <div class="mt-4">
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary">Save</button>
                    <div class="custom-control custom-checkbox ml-3">
                        <input type="checkbox" class="custom-control-input"
                               id="recommended" name="recommended">
                        <label class="custom-control-label" for="recommended">Recommended</label>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection