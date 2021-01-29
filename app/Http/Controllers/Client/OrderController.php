<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\OrderCreate;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __invoke(Request $request, Product $product): RedirectResponse
    {
        $order = Order::create([
            'product_id' => $product->id,
            'name' => $request->input('name'),
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'contact' =>json_encode($request->input('contact')),
            'message' => $request->input('message'),
            'price' => $product['price'],
        ]);
        Mail::send(new OrderCreate($order));
        return redirect()->back();
    }
}
