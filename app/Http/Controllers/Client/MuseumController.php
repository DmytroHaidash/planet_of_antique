<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Museum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MuseumController extends Controller
{
    public function index(Request $request): View
    {
        $search = [];
        $museums = Museum::where('published', 1);

        foreach ($museums->get() as $shop) {
            $q = mb_substr($shop->title, 0, 1);
            if (!in_array($q, $search)) {
                $search[] = $q;
            }
        }

        if ($request->filled('search')) {
            $museums = $museums->where('title->' . app()->getLocale(), 'like', $request->input('search') . '%');
        }

        return view('client.museums.index',[
            'museums' => $museums->paginate(20),
            'search' => $search,
            'search_letter' => $request->input('search')
        ]);
    }

    public function show(Request $request, Museum $museum): View
    {
        $categories = [];
        $exhibits = $museum->exhibits();
        foreach($museum->exhibits as $exhibit){
            foreach ($exhibit->categories as $category)
            {

                if(!in_array_field($category->id, 'id',  $categories)){
                    $categories[] = $category;
                }
            }
        }

        if ($request->filled('category')) {
            $ids = Category::whereIn('slug', explode(',', $request->input('category')))
                ->pluck('id');

            $exhibits = $exhibits->whereHas('categories', function (Builder $builder) use ($ids) {
                $builder->whereIn('id', $ids);
            });
        }
        return view('client.museums.show', [
            'museum' => $museum,
            'exhibits' => $exhibits->paginate(20),
            'categories' => $categories,
            'category' => $request->input('category'),
        ]);
    }
}
