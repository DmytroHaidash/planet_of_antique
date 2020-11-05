<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BannersController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        $banners = Banner::latest()->paginate(20);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * @return View
     */
    public function create():View
    {
        return view('admin.banners.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request):RedirectResponse
    {
        $banner = Banner::create($request->only('title', 'description', 'url'));
        if($request->hasFile('banner')){
            $banner->addMediaFromRequest('banner')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('banner');
        }

        return redirect(route('admin.banners.index'))->with('success', 'Banner successfully created');
    }

    /**
     * @param Banner $banner
     * @return View
     */
    public function edit(Banner $banner):View
    {
        return view('admin.banners.edit',compact('banner'));
    }

    /**
     * @param Request $request
     * @param Banner $banner
     * @return RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(Request $request, Banner $banner):RedirectResponse
    {
        $banner->update($request->only('title', 'description', 'url'));
        if($request->hasFile('banner')){
            $banner->clearMediaCollection('banner');
            $banner->addMediaFromRequest('banner')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('banner');
        }

        return redirect(route('admin.banners.index'))->with('success', 'Banner successfully updated');
    }

    /**
     * @param Banner $banner
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Banner $banner):RedirectResponse
    {
        $banner->delete();
        return redirect(route('admin.banners.index'))->with('success', 'Banner successfully deleted');
    }

}
