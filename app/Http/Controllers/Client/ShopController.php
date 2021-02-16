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
        $search = [];
        $shops = Shop::query()->where('published', 1);

        foreach ($shops->get() as $shop){
            $q = mb_substr($shop->title, 0,1);
            if(!in_array($q, $search)){
                $search[] = $q;
            }
        }

        if($request->filled('search')){
            $shops = $shops->where('title->'. app()->getLocale(), 'like',  $request->input('search') . '%');
        }


        return view('client.shops.index', [
            'shops' => $shops->paginate(30),
            'search' => $search,
            'search_letter' => $request->input('search')
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
