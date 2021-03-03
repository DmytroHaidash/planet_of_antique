@extends('layouts.board', ['page_title' => 'Create new supplier'])

@section('content')

    <section id="content">
        <form action="{{ route('board.suppliers.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="{{ old('title') }}" required>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </section>

@endsection
