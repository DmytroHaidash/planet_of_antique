@extends('layouts.admin', ['page_title' => 'Pages'] )

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Pages</h1>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>

            @forelse($pages as $page)
                <tr>
                    <td width="20">{{ $page->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="underline">
                            {{ $page->title }}
                        </a>
                    </td>
                    <td width="100">
                        <a href="{{ route('admin.pages.edit', $page) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Pages not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $pages->appends(request()->except('page'))->links() }}
    </section>



@endsection