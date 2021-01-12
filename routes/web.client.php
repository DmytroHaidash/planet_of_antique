<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'client.',
    'namespace' => 'Client'
], function () {
    Route::get('/', 'HomeController@index')->name('index');

    Route::get('search', 'SearchController@index')->name('search.index');

    Route::group([
        'as' => 'blog.',
        'prefix' => 'blog'
    ], function () {
        Route::get('/', 'BlogController@index')->name('index');
        Route::get('{post}', 'BlogController@show')->name('show');
    });

    Route::get('{page}', 'PagesController@show')
        ->where('page', '(about|sellers|buyers|contacts|faq)');

});