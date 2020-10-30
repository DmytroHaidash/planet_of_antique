@extends('layouts.admin', ['page_title' => 'Tags'])

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Tags</h1>
            <div class="ml-4">
                <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
                    Create tag
                </a>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th class="text-center">Articles qty</th>
                <th></th>
            </tr>
            </thead>

            @forelse($tags as $tag)
                <tr>
                    <td width="20">{{ $tag->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="underline">
                            {{ $tag->title }}
                        </a>
                    </td>
                    <td class="text-center small">{{ $tag->articles()->count() }}</td>
                    <td width="100">
                        <a href="{{ route('admin.tags.edit', $tag) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('admin.tags.destroy', $tag) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Tags not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $tags->appends(request()->except('page'))->links() }}
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
