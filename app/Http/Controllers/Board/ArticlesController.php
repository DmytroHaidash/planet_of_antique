<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleSavingRequest;
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
        $articles = Auth::user()->article()->paginate(20);
        return view('board.articles.index', compact('articles'));
    }

    /**
     * @return View
     */
    public function create():View
    {
        $tags = Tag::all();
        return view('board.articles.create', compact('tags'));
    }

    /**
     * @param ArticleSavingRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleSavingRequest $request):RedirectResponse
    {
        $article = Auth::user()->article()->create($request->only('title', 'description', 'body'));
        $article->tags()->attach($request->input('tags'));
        if($request->hasFile('article')) {
            $article->addMediaFromRequest('article')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('article');
        }

        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $article->meta()->updateOrCreate([
                    'metable_id' => $article->id
                ], [
                    $key => $meta
                ]);
            }
        }

        return redirect(route('board.articles.index'))->with('success', 'Post successfully created');
    }

    /**
     * @param Article $article
     * @return View
     */
    public function edit(Article $article):View
    {
        $tags = Tag::all();
        return view('board.articles.edit', compact('article', 'tags'));
    }

    /**
     * @param ArticleSavingRequest $request
     * @param Article $article
     * @return RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(ArticleSavingRequest $request, Article $article):RedirectResponse
    {
        $article->update($request->only('title', 'description', 'body'));
        $article->tags()->sync($request->input('tags'));
        if($request->hasFile('article')) {
            $article->clearMediaCollection('article');
            $article->addMediaFromRequest('article')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('article');
        }
        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $article->meta()->updateOrCreate([
                    'metable_id' => $article->id
                ], [
                    $key => $meta
                ]);
            }
        }

        return redirect(route('board.articles.index'))->with('success', 'Article successfully updated');
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article):RedirectResponse
    {
        $article->delete();
        return redirect(route('board.articles.index'))->with('success', 'Article successfully deleted');
    }
}
