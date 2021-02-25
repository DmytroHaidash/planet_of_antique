<?php

use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

/* Media */
Route::group([
    'as' => 'media.',
    'prefix' => 'media',
    'middleware' => 'auth'
], function () {
    Route::any('all', 'MediaController@all')->name('all');
    Route::post('upload', 'MediaController@upload')->name('upload');
    Route::post('delete', 'MediaController@destroy')->name('destroy');
    Route::delete('{media}', 'MediaController@regularDestroy');
});

require_once __DIR__ . '/web.admin.php';
require_once __DIR__ . '/web.board.php';
require_once __DIR__ . '/web.client.php';
