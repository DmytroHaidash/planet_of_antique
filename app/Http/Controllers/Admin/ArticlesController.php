<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticlesController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        $articles = Article::latest()->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * @return View
     */
    public function create():View
    {
        $tags = Tag::all();
        return view('admin.articles.create', compact('tags'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request):RedirectResponse
    {
        $article = Auth::user()->article()->create($request->only('title', 'description', 'body'));
        $article->tags()->attach($request->input('tags'));
        if($request->hasFile('article')) {
            $article->addMediaFromRequest('article')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('article');
        }

        return redirect(route('admin.articles.index'))->with('success', 'Post successfully created');
    }

    /**
     * @param Article $article
     * @return View
     */
    public function edit(Article $article):View
    {
        $tags = Tag::all();
        return view('admin.articles.edit', compact('article', 'tags'));
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(Request $request, Article $article):RedirectResponse
    {
        $article->update($request->only('title', 'description', 'body'));
        $article->tags()->sync($request->input('tags'));
        if($request->hasFile('article')) {
            $article->clearMediaCollection('article');
            $article->addMediaFromRequest('article')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('article');
        }

        return redirect(route('admin.articles.index'))->with('success', 'Article successfully updated');
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article):RedirectResponse
    {
        $article->delete();
        return redirect(route('admin.articles.index'))->with('success', 'Article successfully deleted');
    }
}
