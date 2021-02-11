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
    Route::resource('shops', 'ShopsController')->except('show', 'create', 'store');
    Route::resource('articles', 'ArticlesController')->except('show');
    Route::resource('products', 'ProductsController')->except('show');
    Route::resource('tags', 'TagsController')->except('show');
    Route::resource('pages', 'PagesController')->except('show', 'create', 'store');
    Route::resource('banners', 'BannersController')->except('show');
    Route::resource('users', 'UsersController')->except('show', 'create', 'store');
    Route::resource('benefits', 'BenefitsController')->except('show');
    Route::resource('orders', 'OrderController')->except('show','create', 'destroy');

    Route::get('setting', 'SettingsController@index')->name('settings.index');
    Route::post('setting', 'SettingsController@update')->name('settings.update');

    Route::group([
        'as' => 'media.',
        'prefix' => 'media'
    ], function () {
        Route::post('upload', 'UploadsController@store')->name('store');
        Route::delete('{media}', 'UploadsController@destroy')->name('destroy');
    });
});