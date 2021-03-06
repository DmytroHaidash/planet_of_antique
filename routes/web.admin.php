<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('/', function () {
        return redirect()->route('admin.shops.index');
    });

    Route::resource('categories', 'CategoriesController')->except('show');
    Route::resource('shops', 'ShopsController')->except('show', 'create', 'store', 'destroy');
    Route::resource('articles', 'ArticlesController')->except('show');
    Route::resource('products', 'ProductsController')->except('show');
    Route::resource('tags', 'TagsController')->except('show');
    Route::resource('pages', 'PagesController')->except('show', 'create', 'store');
    Route::resource('banners', 'BannersController')->except('show');
    Route::resource('users', 'UsersController')->except('show', 'create', 'store');
    Route::resource('benefits', 'BenefitsController')->except('show');
    Route::resource('orders', 'OrderController')->except('show','create', 'destroy');
    Route::resource('museums', 'MuseumController')->except('show', 'create', 'store', 'destroy');
    Route::resource('exhibits', 'ExhibitController')->except('show', 'create', 'store');
    Route::resource('suppliers', 'SuppliersController')->except('show', 'create', 'store');

    Route::get('setting', 'SettingsController@index')->name('settings.index');
    Route::post('setting', 'SettingsController@update')->name('settings.update');


    Route::get('accounting', 'AccountingsController@index')->name('accounting.index');
    Route::post('accounting/filter', 'AccountingsController@filter')->name('accounting.filter');

    Route::group([
        'as' => 'media.',
        'prefix' => 'media'
    ], function () {
        Route::post('upload', 'UploadsController@store')->name('store');
        Route::delete('{media}', 'UploadsController@destroy')->name('destroy');
    });


    $sortable = [
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
    }
});