@extends('layouts.board', ['page_title' => 'Exhibits'])

@section('content')
    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Exhibits</h1>
                <div class="ml-4">
                    <a href="{{ route('board.exhibits.create') }}" class="btn btn-primary">
                        Create new exhibit
                    </a>
                </div>
        </div>

        <form class="my-4 d-flex">
            <div class="mr-2 flex-grow-1">
                <input type="text" name="q" value="{{ request()->get('q', null) }}" class="form-control"
                       placeholder="Search">
            </div>
            <button class="btn btn-primary">
                <i class="i-search"></i>
                Find
            </button>
        </form>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th></th>
            </tr>
            </thead>

            @forelse($exhibits as $exhibit)
                <tr>
                    <td width="20">{{ $exhibit->id }}</td>
                    <td width="280">
                        <a href="{{ route('board.exhibits.edit', $exhibit) }}" class="underline">
                            {{ $exhibit->title }}
                        </a>
                    </td>
                    <td>
                        @forelse($exhibit->categories as $category)
                            {{ $category->title }}
                        @empty
                            ---
                        @endforelse
                    </td>
                    <td width="100">
                        <a href="{{ route('board.exhibits.edit', $exhibit) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('board.exhibits.destroy', $exhibit) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Exhibits not added
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $exhibits->appends(request()->except('page'))->links() }}
    </section>

@endsection

@push('scripts')
    <form method="post" id="delete" style="display: none">
        @csrf
        @method('delete')
    </form>
    <form method="post" id="publish" style="display: none">
        @csrf
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

      function publishItem(route) {
        const form = document.getElementById('publish');
        form.action = route;
        form.submit();
      }
    </script>
@endpush
