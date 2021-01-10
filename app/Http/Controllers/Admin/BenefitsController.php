<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BenefitsController extends Controller
{
    public function index(): View
    {
        $benefits = Benefit::paginate(20);
        return view('admin.benefits.index', compact('benefits'));
    }

    public function create(): View
    {
        return view('admin.benefits.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $benefit = Page::where('slug', 'main')->first()->benefits()->create($request->only('title'));
        if ($request->hasFile('benefit')) {
            $benefit->addMediaFromRequest('benefit')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('benefit');
        }

        return redirect()->route('admin.benefits.index')->with('success', 'Benefit successfully created');
    }

    public function edit(Benefit $benefit): View
    {
        return view('admin.benefits.edit', compact('benefit'));
    }

    public function update(Request $request, Benefit $benefit): RedirectResponse
    {
        $benefit->update($request->only('title'));
        if ($request->hasFile('benefit')) {
            $benefit->clearMediaCollection('benefit');
            $benefit->addMediaFromRequest('benefit')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('benefit');
        }
        return redirect()->route('admin.benefits.index')->with('success', 'Benefit successfully updated');
    }

    public function destroy(Benefit $benefit)
    {
        $benefit->delete();
        return redirect()->route('admin.benefits.index')->with('success', 'Benefit successfully deleted');
    }
}
