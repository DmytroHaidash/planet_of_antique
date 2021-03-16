<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\SupportLetter;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Exhibit;
use App\Models\Museum;
use App\Models\Page;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::all();
        $new = Product::where('new', 1)->latest()->take(20)->get();
        $new_banner = Page::where('slug', 'new-items')->first();
        $recommended = Product::where('recommended', 1)->where('is_published', 1)->take(20)->get();
        $recommended_banner = Page::where('slug', 'recommended')->first();
        $sellers = Shop::where('partner', 1)->where('published', 1)->get();
        $sellers_banner = Page::where('slug', 'sellers')->first();
        $popular = Category::where('recommended', 1)->inRandomOrder()->take(9)->get();
        $benefits = Benefit::all();
        $articles = Article::inRandomOrder()->take(4)->get();
        $museums = Museum::where('published', 1)->where('recommended', 1)->latest()->take(20)->get();
        $museums_banner = Page::where('slug', 'museums')->first();
        $exhibits = Exhibit::where('recommended', 1)->where('published', 1)->inRandomOrder()->take(20)->get();
        $exhibits_banner = Page::where('slug', 'museum-items')->first();

        return view('client.home.index', compact('banners', 'new', 'new_banner', 'recommended', 'recommended_banner',
            'sellers', 'sellers_banner', 'popular', 'benefits', 'articles', 'museums', 'museums_banner', 'exhibits', 'exhibits_banner'));
    }

    public function message(Request $request): RedirectResponse
    {
        $data = [
            'user' => (object)[
                'name' => Auth::user() ? Auth::user()->name : $request->input('name'),
                'phone' => Auth::user() ? '' : $request->input('phone'),
                'email' => Auth::user() ? Auth::user()->email : $request->input('email'),
            ],
            'message' => $request->input('message'),
        ];

        Mail::send(new SupportLetter($data));
        return redirect()->back();
    }
}
