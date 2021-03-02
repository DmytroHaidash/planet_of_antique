<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request):View
    {
        $tag = null;
        $posts = Article::query();
        if($request->has('user_id')){
            $posts = $posts->where('user_id', $request->input('user_id'));
        }

        if ($request->has('tag')) {
            $tag = Tag::where('slug', $request->input('tag'))->first();
            $posts = $posts->whereHas('tags', function (Builder $builder) use ($tag) {
                $builder->where('id', $tag->id);
            });
        }

        return view('client.blog.index', [
            'posts' => $posts->paginate(12),
            'tags' => Tag::has('articles')->get(),
            'current' => $tag
        ]);
    }

    public function show(Article $post):View
    {
        return view('client.blog.show', compact('post'));
    }
}
