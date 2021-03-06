<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'client.',
    'namespace' => 'Client'
], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::post('/message', 'HomeController@message')->name('home.message');

    Route::get('search', 'SearchController@index')->name('search.index');

    Route::group([
        'as' => 'blog.',
        'prefix' => 'blog'
    ], function () {
        Route::get('/', 'BlogController@index')->name('index');
        Route::get('{post}', 'BlogController@show')->name('show');
    });

    Route::get('{page}', 'PagesController@show')
        ->where('page', '(about|sellers|buyers|contacts|faq|story|new-museum)');

    Route::group([
        'as' => 'catalog.',
    ], function () {
        Route::get('recommended', 'CatalogController@recommended')->name('recommended');
        Route::get('new', 'CatalogController@new')->name('new');
        Route::get('catalog', 'CatalogController@index')->name('index');
        Route::get('catalog/all', 'CatalogController@all')->name('all');
        Route::post('catalog', 'CatalogController@index')->name('search');
        Route::get('lot/{product}', 'CatalogController@show')->name('show');
        Route::post('lot/{product}', 'OrderController')->name('buy');
        Route::post('lot/{product}/question', 'CatalogController@question')->name('question');
        Route::get('lot/pdf/{product}', 'CatalogController@pdf')->name('pdf');
        Route::post('lot/{product}/price', 'CatalogController@price')->name('price');
        Route::post('lot/{product}/bargain', 'CatalogController@bargain')->name('bargain');
    });

    Route::resource('shops', 'ShopController')->only('index', 'show');
    Route::resource('museums', 'MuseumController')->only('index', 'show');

    Route::group([
        'as' => 'exhibits.',
        'prefix' => 'exhibits'
    ], function () {
        Route::get('/', 'ExhibitController@index')->name('index');
        Route::get('{exhibit}', 'ExhibitController@show')->name('show');
        Route::post('{exhibit}/question', 'ExhibitController@question')->name('question');
    });
});