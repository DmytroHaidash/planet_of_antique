@extends('layouts.board', ['page_title' => $product->title])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush

@section('content')

    <section>
        <form action="{{ route('board.products.update', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" name="title"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               value="{{ old('title') ?? $product->title}}" required>
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
                               value="{{ old('description') ?? $product->description }}">
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
                        >{{ old('body') ?? $product->body }}</textarea>
                    </div>
                    <multi-uploader class="mt-4"
                                    :src="{{ json_encode(\App\Http\Resources\MediaResource::collection($product->getMedia('uploads'))) }}"></multi-uploader>
                </div>
                <div class="col-lg-4">
                    <div class="form-group{{ $errors->has('price') ? ' is-invalid' : '' }}">
                        <label for="price">Price</label>
                        <input type="number" min="1" step="1" class="form-control" id="price" name="price"
                               value="{{ old('price') ?? $product->price }}" required>
                        @if($errors->has('price'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group my-4">
                        <div class="custom-control custom-checkbox ml-3">
                            <input type="checkbox" class="custom-control-input"
                                   id="publish_price" name="publish_price"
                                    {{ $product->publish_price ? 'checked' : '' }}>
                            <label class="custom-control-label" for="publish_price">Published price</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="section">Category</label>
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li class="ml-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="category-{{$category->id}}" name="categories[]"
                                               {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}
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

            <div class="form-group d-flex my-4">
                <div class="custom-control custom-checkbox ml-3">
                    <input type="radio" class="custom-control-input"
                           id="stock" name="in_stock" value="stock" {{$product->in_stock == 'stock' ? 'checked' : ''}}>
                    <label class="custom-control-label" for="stock">In stock</label>
                </div>
                <div class="custom-control custom-checkbox ml-3">
                    <input type="radio" class="custom-control-input"
                           id="reserved" name="in_stock"
                           value="reserved" {{$product->in_stock == 'reserved' ? 'checked' : ''}}>
                    <label class="custom-control-label" for="reserved">Reserved</label>
                </div>
                <div class="custom-control custom-checkbox ml-3">
                    <input type="radio" class="custom-control-input"
                           id="sold" name="in_stock" value="sold" {{$product->in_stock == 'sold' ? 'checked' : ''}}>
                    <label class="custom-control-label" for="sold">Sold</label>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <button class="btn btn-primary">Save</button>

                <div class="custom-control custom-checkbox ml-3">
                    <input type="checkbox" class="custom-control-input"
                           id="published" name="is_published" {{ $product->is_published ? 'checked' : '' }}>
                    <label class="custom-control-label" for="published">Published</label>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection