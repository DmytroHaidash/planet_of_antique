<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function index():View
    {
        return \view('board.orders.index', [
            'orders' => Order::ordered()->whereHas('product', function($product){
                $product->where('shop_id', Auth::user()->shop->id );
            })->paginate(20),
        ]);
    }

    public function edit(Order $order)
    {
        return \view('board.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->only('status', 'message', 'comment'));
        return \back();
    }
}
