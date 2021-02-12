<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request):View
    {
        $shops = Shop::query()->where('published', 1);
        if($request->filled('search_shop')){
            $shops = $shops->where('title', 'like',  $request->input('search_shop') . '%');
        }
        return view('client.shops.index', [
            'shops' => $shops->paginate(30),
        ]);
    }

    public function show(Shop $shop):View
    {
        return view('client.shops.show', [
            'shop' => $shop,
            'products' => $shop->products()->paginate(20),
        ]);
    }
}
