@extends('layouts.admin', ['page_title' => $category->title])

@section('content')

    <section>
        <form action="{{ route('admin.categories.update', $category) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') ?? $category->title}}" required>
                        @if($errors->has('title'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    @if ($categories->count())
                        <div class="form-group">
                            <label for="category">Parent Category</label>
                            <select name="parent_id" id="category" class="form-control">
                                <option value="">-----</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}"
                                            {{ $item->id === (old('parent_id') ?? $category->parent_id) ? 'selected' : '' }}>
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <single-uploader name="category"
                                     src="{{ optional($category->getFirstMedia('category'))->getFullUrl() }}"></single-uploader>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection