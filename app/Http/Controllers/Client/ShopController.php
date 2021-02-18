<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;
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

    public function show(Request $request, Shop $shop):View
    {
        $categories = [];
        $products = $shop->products();
        foreach($shop->products as $product){
            foreach ($product->categories as $category)
            {

                if(!in_array_field($category->id, 'id',  $categories)){
                    $categories[] = $category;
                }
            }
        }

        if ($request->filled('category')) {
            $ids = Category::whereIn('slug', explode(',', $request->input('category')))
                ->pluck('id');

            $products = $products->whereHas('categories', function (Builder $builder) use ($ids) {
                $builder->whereIn('id', $ids);
            });
        }
        return view('client.shops.show', [
            'shop' => $shop,
            'products' => $products->paginate(20),
            'categories' => $categories,
            'category' => $request->input('category'),
        ]);
    }
}
