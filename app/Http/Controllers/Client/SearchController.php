<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $products = Product::where('is_published', 1)->whereRaw('LOWER(title) LIKE ?', '%' . mb_strtolower($query) . '%')
            ->orWhereRaw('LOWER(description) LIKE ?', '%' . mb_strtolower($query) . '%')
            ->orWhereRaw('LOWER(body) LIKE ?', '%' . mb_strtolower($query) . '%')
            ->paginate(12);


        return view('client.search.index', [
            'products' => $products,
            'query' => $query
        ]);

    }
}
