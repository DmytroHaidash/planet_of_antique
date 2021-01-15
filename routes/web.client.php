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

    Route::group([
        'as' => 'catalog.',
    ], function () {
        Route::get('catalog', 'CatalogController@index')->name('index');
        Route::get('catalog/all', 'CatalogController@all')->name('all');
        Route::post('catalog', 'CatalogController@index')->name('search');
        Route::get('lot/{product}', 'CatalogController@show')->name('show');
//        Route::post('lot/{product}', 'OrderController')->name('buy');
        Route::post('lot/{product}/question', 'CatalogController@question')->name('question');
        Route::get('lot/pdf/{product}', 'CatalogController@pdf')->name('pdf');
        Route::post('lot/{product}/price', 'CatalogController@price')->name('price');
    });
});