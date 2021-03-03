@extends('layouts.admin', ['page_title' => 'Suppliers'] )

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Suppliers</h1>
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

            @forelse($suppliers as $supplier)
                <tr>
                    <td width="20">{{ $supplier->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="underline">
                            {{ $supplier->title }}
                        </a>
                    </td>
                    <td width="280">
                        <a href="{{ route('admin.users.edit', $supplier->user) }}" class="underline">
                            {{ $supplier->user->name }}
                        </a>
                    </td>
                    <td width="100">
                        <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('admin.suppliers.destroy', $supplier) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Suppliers not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $suppliers->appends(request()->except('page'))->links() }}
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