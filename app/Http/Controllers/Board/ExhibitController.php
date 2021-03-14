<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExhibitSavingRequest;
use App\Models\Category;
use App\Models\Exhibit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExhibitController extends Controller
{
    public function index(Request $request):View
    {
        $exhibits = Auth::user()->museum->exhibits();
        if($request->filled('q')){
            $exhibits = $exhibits->where('title', 'like', "%{$request->input('q')}%");
        }
        $exhibits = $exhibits->paginate(20);
        return view('board.exhibits.index', compact('exhibits'));
    }

    public function create():View
    {
        $categories = Category::all();
        return view('board.exhibits.create', compact('categories'));
    }
    public function store(ExhibitSavingRequest $request):RedirectResponse
    {
        $exhibit = Exhibit::create([
            'museum_id' => Auth::user()->museum->id,
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published' => $request->has('published'),
            'date' => $request->input('date'),
            'source' => $request->input('source'),
            'price' => $request->input('price'),
            'comment' => $request->input('comment')
        ]);
        $exhibit->categories()->attach($request->input('categories', []));
        $this->handleMedia($request, $exhibit);
        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $exhibit->meta()->updateOrCreate([
                    'metable_id' => $exhibit->id
                ], [
                    $key => $meta
                ]);
            }
        }
        return redirect()->route('board.exhibits.index')->with('success', 'Exhibit successfully created');
    }
    public function edit(Exhibit $exhibit):View
    {
        $categories = Category::all();
        return view('board.exhibits.edit', compact('categories', 'exhibit'));
    }

    public function update(ExhibitSavingRequest $request, Exhibit $exhibit):RedirectResponse
    {
        $exhibit->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published' => $request->has('published'),
            'date' => $request->input('date'),
            'source' => $request->input('source'),
            'price' => $request->input('price'),
            'comment' => $request->input('comment')
        ]);
        $exhibit->categories()->sync($request->input('categories'));
        $this->handleMedia($request, $exhibit);
        if ($request->has('meta')) {
            foreach ($request->get('meta') as $key => $meta) {
                $exhibit->meta()->updateOrCreate([
                    'metable_id' => $exhibit->id
                ], [
                    $key => $meta
                ]);
            }
        }
        return redirect()->route('board.exhibits.index')->with('success', 'Exhibit successfully updated');
    }

    public function destroy(Exhibit $exhibit):RedirectResponse
    {
        $exhibit->delete();
        return redirect()->route('board.exhibits.index')->with('success', 'Exhibit successfully deleted');
    }

    /**
     * @param  Request $request
     * @param  Exhibit $exhibit
     */
    private function handleMedia(Request $request, Exhibit $exhibit): void
    {
        if ($request->filled('uploads')) {
            foreach ($request->input('uploads') as $media) {
                Media::find($media)->update([
                    'model_type' => Exhibit::class,
                    'model_id' => $exhibit->id
                ]);
            }

            Media::setNewOrder($request->input('uploads'));
        }
        if ($request->has('accounting')) {
            foreach ($request->accounting as $media) {
                Media::find($media)->update([
                    'model_type' => Exhibit::class,
                    'model_id' => $exhibit->id,
                    'collection_name' => 'accounting',
                ]);
            }
            Media::setNewOrder($request->input('accounting'));
        }

        if ($request->filled('deletion')) {
            Media::whereIn('id', $request->input('deletion'))->delete();
        }
    }
}
