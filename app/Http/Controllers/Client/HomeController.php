<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\SupportLetter;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Benefit;
use App\Models\Category;
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
        $new = Product::latest()->take(5)->get();
        $recommended = Product::where('recommended', 1)->get();
        $sellers = Shop::where('partner', 1)->get();
        $popular = Category::inRandomOrder()->take(9)->get();
        $benefits = Benefit::all();
        $articles = Article::inRandomOrder()->take(4)->get();

        return view('client.home.index', compact('banners', 'new', 'recommended', 'sellers', 'popular', 'benefits', 'articles'));
    }

    public function message(Request $request):RedirectResponse
    {
        $data = [
            'user' => (object)[
                'name' => Auth::user() ? Auth::user()->name : $request->input('name'),
                'phone' =>Auth::user() ? '' :  $request->input('phone'),
                'email' => Auth::user() ? Auth::user()->email : $request->input('email'),
            ],
            'message' => $request->input('message'),
        ];

        Mail::send(new SupportLetter($data));
        return redirect()->back();
    }
}
