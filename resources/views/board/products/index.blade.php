@extends('layouts.board', ['page_title' => 'Products'])

@section('content')
    <section id="content">
        <div class="d-flex align-items-center mb-5">
            <h1 class="h3 mb-0">Products</h1>
            @if(Auth::user()->shop->products->count() < app('settings')->ads_per_user ||
            (Auth::user()->premium && Auth::user()->premium > Carbon\Carbon::now()->toDate())
            )
                <div class="ml-4">
                    <a href="{{ route('board.products.create') }}" class="btn btn-primary">
                        Create new product
                    </a>
                </div>
            @endif
        </div>

        <form class="my-4 d-flex">
            <div class="mr-2 flex-grow-1">
                <input type="text" name="q" value="{{ request()->get('q', null) }}" class="form-control"
                       placeholder="Search">
            </div>
            <button class="btn btn-primary">
                <i class="i-search"></i>
                Найти
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

            @forelse($products as $product)
                <tr>
                    <td width="20">{{ $product->id }}</td>
                    <td width="280">
                        <a href="{{ route('board.products.edit', $product) }}" class="underline">
                            {{ $product->title }}
                        </a>
                    </td>
                    <td>
                        @forelse($product->categories as $category)
                            {{ $category->title }}
                        @empty
                            ---
                        @endforelse
                    </td>
                    <td width="100">
                        <a href="{{ route('board.products.edit', $product) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                        <button class="btn btn-danger btn-squire"
                                onclick="deleteItem('{{ route('board.products.destroy', $product) }}')">
                            <i class="i-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Товары пока не добавлены
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $products->appends(request()->except('page'))->links() }}
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
        const conf = confirm('Уверены?');

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
