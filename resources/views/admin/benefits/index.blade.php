@extends('layouts.admin', ['page_title' => 'Benefits'] )

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Benefits</h1>
            <div class="ml-4">
                <a href="{{ route('admin.benefits.create') }}" class="btn btn-primary">
                    Create benefit
                </a>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>

            @forelse($benefits as $benefit)
                <tr>
                    <td width="20">{{ $benefit->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.benefits.edit', $benefit) }}" class="underline">
                            {{ $benefit->title }}
                        </a>
                    </td>
                    <td width="100">
                        <a href="{{ route('admin.benefits.edit', $benefit) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('admin.benefits.destroy', $benefit) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Benefits not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $benefits->appends(request()->except('page'))->links() }}
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
