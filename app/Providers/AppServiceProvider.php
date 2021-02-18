<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Services\Navigation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        app()->singleton('nav', function () {
            return new Navigation();
        });

        app()->singleton('categories', function(){
           return Category::all();
        });

        app()->singleton('settings', function () {
            return Setting::first();
        });
    }
}
