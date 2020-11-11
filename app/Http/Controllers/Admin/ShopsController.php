<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopSavingRequest;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopsController extends Controller
{
    public function index():View
    {
        $shops = Shop::paginate(20);
        return view('admin.shops.index', compact('shops'));
    }

    public function edit(Shop $shop):View
    {
        return view('admin.shops.edit', compact('shop'));
    }

    public function update(ShopSavingRequest $request, Shop $shop):RedirectResponse
    {
        $shop->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'delivery' => $request->input('delivery'),
            'published' => $request->has('published'),
            'partner' => $request->has('partner')
        ]);
        if($request->hasFile('logo')){
            $shop->clearMediaCollection('logo');
            $shop->addMediaFromRequest('logo')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('logo');
        }
        if($request->hasFile('banner')){
            $shop->clearMediaCollection('banner');
            $shop->addMediaFromRequest('banner')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('banner');
        }

        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $shop->meta()->updateOrCreate([
                    'metable_id' => $shop->id
                ], [
                    $key => $meta
                ]);
            }
        }

        return redirect(route('admin.shops.index'))->with('success',  'Shop successfully updated');
    }
}
