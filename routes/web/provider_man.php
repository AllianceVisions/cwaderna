<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'provider-man', 'as' => 'provider-man.', 'namespace' => 'Providerman', 'middleware' => ['auth','provider_man']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    // Items 
    Route::post('items/media', 'ItemsController@storeMedia')->name('items.storeMedia');
    Route::post('items/ckmedia', 'ItemsController@storeCKEditorImages')->name('items.storeCKEditorImages');
    Route::resource('items', 'ItemsController');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () { 
        Route::get('/', 'ProfileController@edit')->name('edit');
        Route::post('/', 'ProfileController@updateProfile')->name('update');
        Route::post('password', 'ProfileController@updatePassword')->name('password.update');
        Route::post('media', 'ProfileController@storeMedia')->name('storeMedia');
        Route::post('ckmedia', 'ProfileController@storeCKEditorImages')->name('storeCKEditorImages');
    });

});
