<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function index():View
    {
        $pages = Page::paginate(20);
         return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page):View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page):RedirectResponse
    {
        $page->update($request->only('title', 'description'));
        if($request->hasFile('page')){
            $page->clearMediaCollection('page');
            $page->addMediaFromRequest('page')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('page');
        }

        return redirect(route('admin.pages.index'))->with('success', 'Page successfully updated');
    }

}
