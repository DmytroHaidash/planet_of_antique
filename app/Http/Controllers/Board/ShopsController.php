<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
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

    public function update(Request $request, Shop $shop): RedirectResponse
    {
        $shop->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'delivery' => $request->input('delivery'),
            'published' => $request->has('published'),
        ]);
        if ($request->hasFile('logo')) {
            $shop->clearMediaCollection('logo');
            $shop->addMediaFromRequest('logo')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('logo');
        }
        if ($request->hasFile('banner')) {
            $shop->clearMediaCollection('banner');
            $shop->addMediaFromRequest('banner')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('banner');
        }
    }
}
