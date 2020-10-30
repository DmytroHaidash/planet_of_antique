<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagsController extends Controller
{
    public function index(): View
    {
        $tags = Tag::paginate(20);
        return view('admin.tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('admin.tags.create');
    }

    public function store(Request $request):RedirectResponse
    {
        Tag::create($request->only('title'));

        return redirect(route('admin.tags.index'))->with('success', 'Tag successfully created');
    }

    public function edit(Tag $tag):View
    {
        return view('admin.tags.index', compact('tag'));
    }

    public function update(Tag $tag, Request $request):RedirectResponse
    {
        $tag->update($request->only('title'));
        return redirect(route('admin.tags.index'))->with('success', 'Tag successfully updated');
    }

    public function destroy(Tag $tag):RedirectResponse
    {
        $tag->delete();
        return back()->with('success', 'Tag successfully deleted');
    }
}
