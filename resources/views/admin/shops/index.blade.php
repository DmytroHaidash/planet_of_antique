@extends('layouts.admin', ['page_title' => 'Shops'])

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Shops</h1>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th>User</th>
                <th class="text-center">Products qty</th>
                <th></th>
            </tr>
            </thead>

            @forelse($shops as $shop)
                <tr>
                    <td width="20">{{ $shop->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.shops.edit', $shop) }}" class="underline">
                            {{ $shop->title }}
                        </a>
                    </td>
                    <td>{{$shop->user->name}}</td>
                    <td class="text-center small">{{ $shop->products()->count() }}</td>
                    <td width="100">
                        <a href="{{ route('admin.shops.edit', $shop) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Shops not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $shops->appends(request()->except('page'))->links() }}
    </section>

@endsection
