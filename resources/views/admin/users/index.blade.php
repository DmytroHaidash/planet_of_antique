@extends('layouts.admin', ['page_title' => 'Users'])

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Users</h1>
        </div>
        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th class="text-center">Role</th>
                <th></th>
            </tr>
            </thead>

            @forelse($users as $user)
                <tr>
                    <td width="20">{{ $user->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.users.edit', $user) }}" class="underline">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{$user->email}}</td>
                    <td class="text-center small">{{ $user->role }}</td>
                    <td width="100">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('admin.users.destroy', $user) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Users not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $users->appends(request()->except('page'))->links() }}
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
