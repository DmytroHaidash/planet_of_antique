@extends('layouts.admin', ['page_title' => $tag->title])

@section('content')

    <section>
        <form action="{{ route('admin.tags.update', $tag) }}" method="post">
            @csrf
            @method('patch')
            <block-editor>
                @foreach(config('app.locales') as $lang)
                    <fieldset slot="{{ $lang }}">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title[{{$lang}}]"
                                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   value="{{ old('title.'.$lang) ?? $category->translate('title', $lang)}}">
                            @if($errors->has('title'))
                                <div class="mt-1 text-danger">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                    </fieldset>
                @endforeach
            </block-editor>
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection