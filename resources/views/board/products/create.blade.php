@extends('layouts.board', ['page_title' => 'New product'])

@push('scripts')
    <script src="{{ asset('js/editor.js') }}" defer></script>
@endpush

@section('content')

    <section>
        <form action="{{ route('board.products.store') }}" method="post" enctype="multipart/form-data">
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
                                           value="{{ old('title.'.$lang) }}" required>
                                    @if($errors->has('title'))
                                        <div class="mt-1 text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input id="description" type="text" name="description[{{$lang}}]"
                                           class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                           value="{{ old('description.'.$lang) }}">
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
                                            name="body[{{$lang}}]"
                                            rows="4"
                                            class="editor"
                                    >{{ old('body.'.$lang) }}</textarea>
                                </div>
                            </fieldset>
                        @endforeach
                    </block-editor>
                    @includeIf('partials.admin.meta', ['meta' => null])
                    <multi-uploader class="mt-4" url="/board/media/upload"></multi-uploader>
                </div>
                <div class="col-lg-4">
                    <div class="form-group{{ $errors->has('price') ? ' is-invalid' : '' }}">
                        <label for="price">Price</label>
                        <input type="number" min="1" step="1" class="form-control" id="price" name="price"
                               value="{{ old('price') }}" required>
                        @if($errors->has('price'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group my-4">
                        <div class="custom-control custom-checkbox ml-3">
                            <input type="checkbox" class="custom-control-input"
                                   id="publish_price" name="publish_price" checked>
                            <label class="custom-control-label" for="publish_price">Published price</label>
                        </div>
                    </div>

                    <div class="form-group my-4">
                        <div class="custom-control custom-checkbox ml-3">
                            <input type="checkbox" class="custom-control-input"
                                   id="bargain" name="bargain">
                            <label class="custom-control-label" for="bargain">Bargain</label>
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
                           id="stock" name="in_stock" value="stock" checked>
                    <label class="custom-control-label" for="stock">In stock</label>
                </div>
                <div class="custom-control custom-checkbox ml-3">
                    <input type="radio" class="custom-control-input"
                           id="reserved" name="in_stock" value="reserved">
                    <label class="custom-control-label" for="reserved">Reserved</label>
                </div>
                <div class="custom-control custom-checkbox ml-3">
                    <input type="radio" class="custom-control-input"
                           id="sold" name="in_stock" value="sold">
                    <label class="custom-control-label" for="sold">Sold</label>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <button class="btn btn-primary">Save</button>

                <div class="custom-control custom-checkbox ml-3">
                    <input type="checkbox" class="custom-control-input"
                           id="published" name="is_published" checked>
                    <label class="custom-control-label" for="published">Published</label>
                </div>
            </div>
            @if(Auth::user()->role == 'admin' || (Auth::user()->premium && Auth::user()->premium >= now()))
                <h2 class="mt-4">Accounting department</h2>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="date">Date</label>
                        <input type="date" id="date" class="form-control" name="accountings[date]"
                               value="{{date("Y-m-d")}}" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="whom">Whom</label>
                        <input type="text" class="form-control" id="whom" name="accountings[whom]">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="supplier">Supplier</label>
                        <select name="accountings[supplier_id]" id="supplier" class="form-control">
                            <option value="">-------</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="new-supplier">New supplier</label>
                        <input type="text" class="form-control" id="new-supplier" name="new-supplier">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="sell_price">Sell price</label>
                        <input type="number" min="1" step="1" class="form-control" id="sell_price"
                               name="accountings[sell_price]">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="sell_date">Sell date</label>
                        <input type="date" id="sell_date" class="form-control" name="accountings[sell_date]">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="buyer">Buyer</label>
                        <input type="text" class="form-control" id="buyer" name="accountings[buyer]">
                    </div>

                </div>

                <accountings :message="['']" :price="['0']"></accountings>


                <div class="form-group col-12">
                    <label for="comment">Comment</label>
                    <textarea name="accountings[comment]" class="form-control" id="comment"></textarea>
                </div>
                <multi-uploader name="accounting" class="mt-4"></multi-uploader>
                <div class="d-flex align-items-center mt-4">
                    <button class="btn btn-primary">Save</button>
                </div>
            @endif
        </form>
    </section>

@endsection