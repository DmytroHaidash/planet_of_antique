@extends('layouts.board', ['page_title' => $exhibit->title])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush

@section('content')

    <section>
        <form action="{{ route('board.exhibits.update', $exhibit) }}" method="post" enctype="multipart/form-data">
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
                                           value="{{ old('title.'.$lang) ?? $exhibit->translate('title', $lang)}}">
                                    @if($errors->has('title'))
                                        <div class="mt-1 text-danger">
                                            {{ $errors->first('title') }}
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
                                    >{{ old('body.'.$lang) ?? $exhibit->translate('body', $lang) }}</textarea>
                                </div>
                            </fieldset>
                        @endforeach
                    </block-editor>
                    @includeIf('partials.admin.meta', ['meta' => $exhibit->meta()->first()])
                    <multi-uploader class="mt-4" url="/board/media/upload"
                                    :src="{{ json_encode(\App\Http\Resources\MediaResource::collection($exhibit->getMedia('uploads'))) }}"></multi-uploader>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="section">Category</label>
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li class="ml-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="category-{{$category->id}}" name="categories[]"
                                               {{ in_array($category->id, $exhibit->categories->pluck('id')->toArray()) ? 'checked' : '' }}
                                               value="{{ $category->id }}">
                                        <label class="custom-control-label" for="category-{{$category->id}}">
                                            {{ $category->title }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-primary">Save</button>

                <div class="custom-control custom-checkbox ml-3">
                    <input type="checkbox" class="custom-control-input"
                           id="published" name="published" {{ $exhibit->published ? 'checked' : '' }}>
                    <label class="custom-control-label" for="published">Published</label>
                </div>
            </div>
            <h2 class="mt-4">Accounting department</h2>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="date">Receipt date</label>
                    <input type="date" id="date" class="form-control" name="date"
                           value="{{$exhibit->date ?? date("Y-m-d")}}">
                </div>
                <div class="form-group col-sm-4">
                    <label for="source">Source of income</label>
                    <input type="text" class="form-control" id="source" name="source" value="{{$exhibit->source}}">
                </div>
                <div class="form-group col-sm-4">
                    <label for="price">Price</label>
                    <input type="number" min="0" step="0.01" id="price" class="form-control" name="price"
                           value="{{$exhibit->price}}">
                </div>
                <div class="form-group col-12">
                    <label for="comment">Comment</label>
                    <textarea name="comment" class="form-control" id="comment">{!! $exhibit->comment !!}</textarea>
                </div>
            </div>
            <multi-uploader name="accounting" class="mt-4"
                            :src="{{ json_encode(\App\Http\Resources\MediaResource::collection($exhibit->getMedia('accounting'))) }}"></multi-uploader>
            <div class="d-flex align-items-center mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection