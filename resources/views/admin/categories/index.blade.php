@extends('layouts.admin', ['page_title' => 'Categories'])

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Categories</h1>
            <div class="ml-4">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    Create category
                </a>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th class="text-center">Products qty</th>
                <th class="text-center">Sort order</th>
                <th></th>
            </tr>
            </thead>

            @forelse($categories as $category)
                <tr>
                    <td width="20">{{ $category->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="underline">
                            {{ $category->title }}
                        </a>
                    </td>
                    <td class="text-center small">{{ $category->products()->count() }}</td>
                    <td width="150" class="small">
                        <div class="d-flex text-center mb-2">
                            <form action="{{ route('admin.sort.categories.up', $category) }}"
                                  method="post" class="col-6 px-0">
                                @csrf

                                <button class="btn btn-sm p-0">&uparrow;</button>
                            </form>

                            <form action="{{ route('admin.sort.categories.down', $category) }}"
                                  method="post" class="col-6 px-0">
                                @csrf

                                <button class="btn btn-sm p-0">&downarrow;</button>
                            </form>
                        </div>
                    </td>
                    <td width="100">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('admin.categories.destroy', $category) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Categories not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $categories->appends(request()->except('page'))->links() }}
    </section>

@endsection

@push('scripts')
    <form method="post" id="delete" style="display: none">
        @csrf
        @method('delete')
    </form>

    <script>
      function deleteItem(route) {
        const form = document.getElementById('delete');
        const conf = confirm('Sure?');

        if (conf) {
          form.action = route;
          form.submit();
        }
      }
    </script>
@endpush
