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

    Route::get('setting', 'SettingsController@index')->name('settings.index');
    Route::post('setting', 'SettingsController@update')->name('settings.update');
});