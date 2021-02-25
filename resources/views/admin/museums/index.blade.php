@extends('layouts.admin', ['page_title' => 'Museums'])

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Museums</h1>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th>User</th>
                <th class="text-center">Exponats qty</th>
                <th></th>
            </tr>
            </thead>

            @forelse($museums as $museum)
                <tr>
                    <td width="20">{{ $museum->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.museums.edit', $museum) }}" class="underline">
                            {{ $museum->title }}
                        </a>
                    </td>
                    <td>{{$museum->user->name}}</td>
                    <td class="text-center small">{{ $museum->exhibits()->count() }}</td>
                    <td width="100">
                        <a href="{{ route('admin.museums.edit', $museum) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Museums not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $museums->appends(request()->except('page'))->links() }}
    </section>

@endsection

