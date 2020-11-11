<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySavingRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        $categories = Category::paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * @param CategorySavingRequest $request
     * @return RedirectResponse
     */
    public function store(CategorySavingRequest $request): RedirectResponse
    {
        $category = Category::create($request->only('title'));

        if ($request->hasFile('category')) {
            $category->addMediaFromRequest('category')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('category');
        }
        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $category->meta()->updateOrCreate([
                    'metable_id' => $category->id
                ], [
                    $key => $meta
                ]);
            }
        }

        return redirect(route('admin.categories.index'))
            ->with('success', 'Category successfully created');
    }

    /**
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * @param CategorySavingRequest $request
     * @param Category $category
     * @return RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(CategorySavingRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->only('title'));

        if ($request->hasFile('category')) {
            $category->clearMediaCollection('category');
            $category->addMediaFromRequest('category')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('category');
        }
        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $category->meta()->updateOrCreate([
                    'metable_id' => $category->id
                ], [
                    $key => $meta
                ]);
            }
        }

        return redirect(route('admin.categories.index'))
            ->with('success', 'Category successfully updated');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return back()->with('success', 'Shop successfully deleted');
    }

}
