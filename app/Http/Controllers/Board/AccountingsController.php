<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountingsController extends Controller
{
    public function index(Request $request):View
    {
        $accountings = Accounting::query()->whereHas('product', function ($product){
            $product->where('shop_id', Auth::user()->shop->id);
        });
        if ($request->filled('status')) {
            $query = \request()->input('status');
            $accountings = $accountings->whereHas('product', function ($product) use ($query) {
                $product->where('in_stock', $query);
            });
        }
        if ($request->filled('supplier')) {
            $accountings = $accountings->where('supplier_id', \request('supplier'));
        }
        if (\request()->filled('q')) {
            $query = \request()->input('q');
            $accountings = $accountings->whereHas('product', function ($product) use ($query) {
                $product->whereHas('translates', function (Builder $builder) use ($query) {
                    $builder->where('title', 'like', "%{$query}%");
                });
            });
        }
        $amountPublishedAcc = array_sum($accountings->whereHas('product', function (Builder $builder) {
            $builder->where('is_published', 1);
        })->pluck('amount')->toArray());
        return \view('board.accountings.index', [
            'accountings' => $accountings->paginate(10),
            'suppliers' => Auth::user()->suppliers,
            'amountAcc' => array_sum($accountings->pluck('amount')->toArray()),
            'amountProduct' =>  array_sum(Auth::user()->shop->products()->pluck('price')->toArray()),
            'amountPublishedProduct' => array_sum(Auth::user()->shop->products()->where('is_published', 1)->pluck('price')->toArray()),
            'amountPublishedAcc' => $amountPublishedAcc,
        ]);
    }

    public function filter(Request $request)
    {
        $accountings = Accounting::query()->whereHas('product', function ($product){
            $product->where('shop_id', Auth::user()->shop->id);
        });
        $accountings = $accountings->whereYear('sell_date', '=', $request->input('year'));
        $request['year'] = intval($request->input('year'));
        if($request->has('month'))
        {
            $request['month'] = intval($request->input('month'));
            $accountings = $accountings->whereMonth('sell_date', '=', $request->input('month'));
        }


        return \view('board.accountings.index', [
            'accountings' => $accountings->paginate(10),
            'suppliers' => Auth::user()->suppliers,
            'amountAcc' => array_sum($accountings->pluck('amount')->toArray()),
            'amountSell' => array_sum($accountings->pluck('sell_price')->toArray()),
            'request' => $request,
        ]);
    }
}
