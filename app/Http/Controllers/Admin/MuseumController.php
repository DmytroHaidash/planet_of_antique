<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuseumSavingRequest;
use App\Models\Museum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MuseumController extends Controller
{
    public function index():View
    {
        $museums = Museum::paginate(20);
        return view('admin.museums.index', compact('museums'));
    }

    public function edit(Museum $museum):View
    {
        return view('admin.museums.edit', compact('museum'));
    }

    public function update(MuseumSavingRequest $request, Museum $museum):RedirectResponse
    {
        $museum->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'contacts' => $request->input('contacts'),
            'published' => $request->has('published'),
            'recommended' => $request->has('recommended'),
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

        return redirect()->route('admin.museums.index')->with('success', 'Museum successfully updated');
    }

}
