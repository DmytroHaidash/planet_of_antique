<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'board.',
    'prefix' => 'board',
    'namespace' => 'Board',
    'middleware' => ['auth', 'role:admin|seller']
], function () {
    Route::resource('shops', 'ShopsController')->only('index', 'update');
    Route::resource('articles', 'ArticlesController')->except('show');
    Route::resource('products', 'ProductsController')->except('show');

});