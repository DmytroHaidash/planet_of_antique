<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CanCreateProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->shop->products->count() >= app('settings')->ads_per_user &&
            (!Auth::user()->premium || Auth::user()->premium < now())
            )
        {
            return redirect()->route('board.products.index')->with('message', "You can't create product");
        }
        return $next($request);
    }
}
