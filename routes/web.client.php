<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'as' => 'client.',
    'namespace' => 'Client'
], function () {
    Route::get('/client', 'HomeController@index')->name('index');
});