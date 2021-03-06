<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\AskProductPrice;
use App\Mail\AskProductQuestion;
use App\Mail\BargainProductPrice;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request):View
    {
        $products = $this->handleSearch($request);
        $products = $this->handleFilters($request, $products);

        return \view('client.catalog.index', [
            'search' => $request->input('search'),
            'search_category' => $request->input('category'),
            'category' => Category::where('slug', $request->input('category'))->first(),
            'categories' => Category::whereHas('products')->get(),
            'products' => $products->paginate(20),
            'page' => Page::where('slug', 'new-items')->first(),
        ]);
    }

    public function new(Request $request):View
    {
        $products = $this->handleSearch($request);
        $products = $this->handleFilters($request, $products);

        return \view('client.catalog.index', [
            'search' => $request->input('search'),
            'search_category' => $request->input('category'),
            'category' => Category::where('slug', $request->input('category'))->first(),
            'categories' => Category::whereHas('products')->get(),
            'products' => $products->latest()->paginate(20),
            'page' => Page::where('slug', 'new-items')->first(),
        ]);
    }

    public function recommended(Request $request):View
    {
        $products = $this->handleSearch($request);
        $products = $this->handleFilters($request, $products);

        return \view('client.catalog.index', [
            'search' => $request->input('search'),
            'search_category' => $request->input('category'),
            'category' => Category::where('slug', $request->input('category'))->first(),
            'categories' => Category::whereHas('products')->get(),
            'products' => $products->where('recommended', 1)->latest()->paginate(20),
            'page' => Page::where('slug', 'recommended')->first()
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function all(Request $request): View
    {
        $products = $this->handleSearch($request);
        $products = $this->handleFilters($request, $products);

        return \view('client.catalog.all', [
            'search' => $request->input('search'),
            'search_category' => $request->input('category'),
            'categories' => Category::whereHas('products')->get(),
            'products' => $products->get(),
            'page' => Page::where('slug', 'new-items')->first(),
        ]);
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        $product->handleViewed();

        return \view('client.catalog.show', [
            'product' => $product,
            'popular' => Product::orderByDesc('views_count')->take(3)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function question(Request $request, Product $product): RedirectResponse
    {

        $data = [
            'user' => (object)[
                'name' => Auth::user() ? Auth::user()->name : $request->input('name'),
                'phone' =>Auth::user() ? '' :  $request->input('phone'),
                'email' => Auth::user() ? Auth::user()->email : $request->input('email'),
            ],
            'message' => $request->input('message'),
        ];
        Mail::send(new AskProductQuestion($data, $product));

        return redirect()->back();
    }

    public function bargain(Request $request, Product $product): RedirectResponse
    {
        $data = [
            'user' => (object)[
                'name' => Auth::user() ? Auth::user()->name : $request->input('name'),
                'phone' =>Auth::user() ? '' :  $request->input('phone'),
                'email' => Auth::user() ? Auth::user()->email : $request->input('email'),
            ],
            'message' => $request->input('message'),
        ];
        Mail::send(new BargainProductPrice($data, $product));

        return redirect()->back();
    }

    public function price(Request $request, Product $product):RedirectResponse
    {

        Mail::send(new AskProductPrice($request->input('email'), $product));

        return redirect()->back();
    }

    private function handleSearch(Request $request)
    {
        $search = null;
        $products = Product::query()->latest()->where('is_published', 1);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $products = $products->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }
        return $products;
    }

    /**
     * @param Request $request
     * @param $products
     * @return mixed
     */
    private function handleFilters(Request $request, $products)
    {
        if ($request->filled('category')) {
            $ids = Category::whereIn('slug', explode(',', $request->input('category')))
                ->pluck('id');

            $products = $products->whereHas('categories', function (Builder $builder) use ($ids) {
                $builder->whereIn('id', $ids);
            });
        }

        if ($request->filled('order')) {
            switch ($request->get('order')) {
                case 'cheap':
                    $products = $products->orderBy('price');
                    break;
                case 'expensive':
                    $products = $products->orderByDesc('price');
                    break;
                case 'most_viewed':
                    $products = $products->orderByDesc('views_count');
                    break;
            }
        }
        return $products;
    }

    public function pdf(Product $product)
    {
        $images = $product->getMedia('uploads');
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.pdf', compact('product', 'images'));
        return $pdf->download($product->title .'.pdf');

    }

}
