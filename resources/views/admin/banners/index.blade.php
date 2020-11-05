@extends('layouts.admin', ['page_title' => 'Banners'] )

@section('content')

    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Banners</h1>
        </div>

        <table class="table">
            <thead>
            <tr class="small">
                <th>#</th>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>

            @forelse($banners as $Banner)
                <tr>
                    <td width="20">{{ $banner->id }}</td>
                    <td width="280">
                        <a href="{{ route('admin.banners.edit', $banner) }}" class="underline">
                            {{ $banner->title }}
                        </a>
                    </td>
                    <td width="100">
                        <a href="{{ route('admin.banners.edit', $banner) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('admin.banners.destroy', $banner) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Banners not added yet
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $banners->appends(request()->except('page'))->links() }}
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
