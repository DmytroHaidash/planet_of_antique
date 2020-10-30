<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::resource('categories', 'CategoriesController')->except('show');
    Route::resource('shops', 'ShopsController')->except('show', 'create', 'store');
    Route::resource('articles', 'ArticlesController')->except('show');
    Route::resource('products', 'ProductsController')->except('show');
    Route::resource('tags', 'TagsController')->except('show');

   /* $sortable = [
        'categories' => 'CategoriesController',
    ];

    foreach ($sortable as $name => $controller) {
        Route::group([
            'as' => "sort.{$name}.",
            'prefix' => "sort/{$name}"
        ], function () use ($name, $controller) {
            Route::post('{item}/up', "{$controller}@up")->name('up');
            Route::post('{item}/down', "{$controller}@down")->name('down');
        });
    }*/
});