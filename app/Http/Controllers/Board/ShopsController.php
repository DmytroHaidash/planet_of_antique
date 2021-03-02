<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopSavingRequest;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShopsController extends Controller
{
    public function index(): View
    {
        $shop = Auth::user()->shop;
        return view('board.shops.index', compact('shop'));
    }

    public function update(ShopSavingRequest $request, Shop $shop): RedirectResponse
    {
        $shop->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'delivery' => $request->input('delivery'),
            'contacts' => $request->input('contacts'),
            'published' => $request->has('published'),
        ]);
        if ($request->hasFile('logo')) {
            $shop->clearMediaCollection('logo');
            $shop->addMediaFromRequest('logo')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('logo');
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
        return redirect(route('board.shops.index'))->with('success', 'Shops successfully updated');
    }
}
