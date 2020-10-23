@extends('layouts.admin', ['page_title' => 'Articles'])

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Articles</h1>
            <div class="ml-4">
                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                    Create article
                </a>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th>User</th>
                <th></th>
            </tr>
            </thead>

            @forelse($articles as $article)
                <tr>
                    <td width="20">{{ $article->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="underline">
                            {{ $article->title }}
                        </a>
                    </td>
                    <td>{{$article->user->name}}</td>
                    <td width="100">
                        <a href="{{ route('admin.articles.edit', $article) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('admin.articles.destroy', $article) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Articles not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $articles->appends(request()->except('page'))->links() }}
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

