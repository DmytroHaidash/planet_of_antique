@extends('layouts.board', ['page_title' => 'Accounting department'])

@section('content')
    <section id="content">
        <div class="d-flex align-items-center">
            <h1 class="h3 mb-0">Accounting department</h1>
        </div>
        @if(request()->route()->getName() == 'board.accounting.index')
            @if(request('status') || request('supplier') || request('q'))
                <a href="{{ route('board.accounting.index') }}"
                   class="btn mt-2 btn-outline-primary mb-2">
                    Clear filters
                </a>
            @endif

            <div class="mb-2">
                <p class="mb-0">Filtering by status:</p>
                <a href="?status=reserved"
                   class="btn mr-2  mt-2 btn-{{ request('status') == 'reserved' ? 'primary' : 'outline-primary' }}">
                    Reserved
                </a>
                <a href="?status=stock"
                   class="btn mr-2  mt-2 btn-{{ request('status') == 'stock' ? 'primary' : 'outline-primary' }}">
                    Stock
                </a>
                <a href="?status=sold"
                   class="btn mr-2  mt-2 btn-{{ request('status') == 'sold' ? 'primary' : 'outline-primary' }}">
                    Sold
                </a>

            </div>
            @if($suppliers->count())
                <div class="mb-2">
                    <p class="mb-0">Filtering by supplier:</p>
                    @foreach($suppliers as $supplier)
                        <a href="?supplier={{ $supplier->id }}"
                           class="btn mr-2 mt-2 btn-{{ request('supplier') == $supplier->id ? 'primary' : 'outline-primary' }}">
                            {{$supplier->title}}
                        </a>
                    @endforeach
                </div>
            @endif
        @endif
        <form action="{{route('board.accounting.filter')}}" class="my-4" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-4 form-group">
                    <label for="year">Filter by year:</label>
                    <input type="number" min="2019" max="{{ date('Y') }}" step="1"
                           name="year" id="year" class="form-control"
                           @if(request()->route()->getName() == 'board.accounting.filter')
                           value="{{$request['year']}}"
                           @endif
                           required/>

                </div>
                <div class="col-sm-4 form-group">
                    <label for="month">Filter by month (1-12):</label>
                    <input type="number" min="1" max="12" step="1" name="month" id="month" class="form-control"
                           @if(request()->route()->getName() == 'board.accounting.filter')
                           @if($request['month'])
                           value="{{$request['month']}}"
                            @endif
                            @endif
                    />
                </div>
                <div class="col-auto mt-4">
                    <button class="btn btn-primary">Filter</button>
                    @if(request()->route()->getName() == 'board.accounting.filter')
                        <a href="{{ route('board.accounting.index') }}"
                           class="btn btn-outline-primary ml-3">
                            Reset filter
                        </a>
                    @endif
                </div>

            </div>
        </form>
        <form class="my-4 d-flex">
            <div class="mr-2 flex-grow-1">
                <input type="text" name="q" value="{{ request()->get('q', null) }}" class="form-control"
                       placeholder="Search by products">
            </div>
            <button class="btn btn-primary">
                <i class="i-search"></i>
                Search
            </button>
        </form>
        @if(request()->route()->getName() == 'board.accounting.filter')
            <p>Total costs for the selected period: {{$amountAcc}}</p>
            <p>During the selected period, goods were sold for the amount of: {{$amountSell}}</p>
            <p>Total profit for the selected period: {{$amountSell - $amountAcc}}</p>
        @else
            <p>Total value of goods: {{$amountProduct}}</p>
            <p>The total cost of goods for which accounting is kept: {{$amountAcc}}</p>
            <p>Total cost of published products: {{$amountPublishedProduct}}</p>
            <p>The total cost of published goods for which accounting is kept: {{$amountPublishedAcc}}</p>
        @endif

        <table class="table table-striped">
            <thead>
            <tr class="small">
                <th class="text-center">Title</th>
                <th class="text-center">Status</th>
                <th class="text-center">Supplier</th>
                <th class="text-center">Whom</th>
                <th class="text-center">Buyer</th>
                <th class="text-center">{{request()->route()->getName() == 'board.accounting.filter' ? 'Profit' : 'Cost price'}}</th>
                <th></th>
            </tr>
            </thead>
            @forelse($accountings as $accounting)
                <tr>
                    <td width="200" class="text-center">
                        <a href="{{ route('board.products.edit', $accounting->product) }}" class="underline">
                            {{ $accounting->product->title }}
                        </a>
                    </td>
                    <td class="text-center">
                        {{ $accounting->product->in_stock }}
                    </td>
                    <td class="text-center">{{ $accounting->supplier->title ?? '' }}</td>
                    <td class="text-center">{{ $accounting->whom }}</td>
                    <td class="text-center">{{ $accounting->buyer ?? '' }}</td>
                    <td width="100" class="small text-center">
                        @if(request()->route()->getName() == 'board.accounting.filter')
                            {{$accounting->sell_price - $accounting->amount}}
                        @else
                            {{$accounting->amount}}
                        @endif
                    </td>
                    <td width="100" class="text-right">
                        <a href="{{ route('board.products.edit', $accounting->product) }}"
                           class="btn btn-warning btn-squire">
                            <i class="i-pencil"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        @if(request()->filled('status'))
                            There are no records with this status.
                        @elseif(request()->filled('supplier'))
                            There are no records with this supplier.
                        @else
                            Bookkeeping is not conducted yet
                        @endif
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $accountings->appends(request()->except('page'))->links() }}
    </section>

@endsection
