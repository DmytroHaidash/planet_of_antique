<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\AskExhibitQuestion;
use App\Models\Category;
use App\Models\Exhibit;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ExhibitController extends Controller
{
    public function index(Request $request): View
    {
        $exhibits = $this->handleSearch($request);
        $exhibits = $this->handleFilters($request, $exhibits);

        return \view('client.exhibits.index', [
            'search' => $request->input('search'),
            'search_category' => $request->input('category'),
            'category' => Category::where('slug', $request->input('category'))->first(),
            'categories' => Category::whereHas('exhibits')->get(),
            'exhibits' => $exhibits->paginate(20),
            'page' => Page::where('slug', 'museum-items')->first(),
        ]);
    }

    public function show(Exhibit $exhibit): View
    {
        return \view('client.exhibits.show', [
            'exhibit' => $exhibit
        ]);
    }

    /**
     * @param Request $request
     * @param Exhibit $exhibit
     * @return RedirectResponse
     */
    public function question(Request $request, Exhibit $exhibit): RedirectResponse
    {
        $data = [
            'user' => (object)[
                'name' => Auth::user() ? Auth::user()->name : $request->input('name'),
                'phone' => Auth::user() ? '' : $request->input('phone'),
                'email' => Auth::user() ? Auth::user()->email : $request->input('email'),
            ],
            'message' => $request->input('message'),
        ];
        Mail::send(new AskExhibitQuestion($data, $exhibit));

        return redirect()->back();
    }

    private function handleSearch(Request $request)
    {
        $search = null;
        $exhibits = Exhibit::query()->latest()->where('published', 1);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $exhibits = $exhibits->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }
        return $exhibits;
    }

    /**
     * @param Request $request
     * @param $exhibits
     * @return mixed
     */
    private function handleFilters(Request $request, $exhibits)
    {
        if ($request->filled('category')) {
            $ids = Category::whereIn('slug', explode(',', $request->input('category')))
                ->pluck('id');

            $exhibits = $exhibits->whereHas('categories', function (Builder $builder) use ($ids) {
                $builder->whereIn('id', $ids);
            });
        }
        return $exhibits;
    }
}
