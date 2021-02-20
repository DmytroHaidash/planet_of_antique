<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuseumSavingRequest;
use App\Models\Museum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MuseumController extends Controller
{
    public function create(): View
    {
        return view('board.museums.create');
    }

    public function store(MuseumSavingRequest $request): RedirectResponse
    {
        $museum = Auth::user()->museum()->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published' => $request->has('published'),
        ]);
        if($request->hasFile('logo')){
            $museum->addMediaFromRequest('logo')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('logo');
        }

        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $museum->meta()->updateOrCreate([
                    'metable_id' => $museum->id
                ], [
                    $key => $meta
                ]);
            }
        }

        return redirect()->route('board.museums.edit', $museum)->with('success', 'Museum successfully created');;

    }

    public function edit(Museum $museum): View
    {
        return view('board.museums.edit', compact('museum'));
    }

    public function update(MuseumSavingRequest $request, Museum $museum): RedirectResponse
    {
        $museum->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published' => $request->has('published'),
        ]);
        if($request->hasFile('logo')){
            $museum->clearMediaCollection('logo');
            $museum->addMediaFromRequest('logo')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('logo');
        }

        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $museum->meta()->updateOrCreate([
                    'metable_id' => $museum->id
                ], [
                    $key => $meta
                ]);
            }
        }

        return redirect()->back()->with('success', 'Museum successfully updated');
    }
}
