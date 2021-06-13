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

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    // User Alerts 
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);
    Route::get('user-alerts/read', 'UserAlertsController@read');
});


Route::group([ 'as' => 'frontend.' , 'namespace' => 'Frontend'],function () { 
    Route::get('/','FrontendController@home')->name('home');
    Route::get('about-us','FrontendController@aboutus')->name('aboutus');
    Route::get('contact', 'FrontendController@contact')->name('contact');
    Route::get('cader/register', 'FrontendController@cader_register')->name('cader.register');
    Route::get('cader/single', 'FrontendController@cader_single')->name('cader.single');
    Route::get('cwaders', 'FrontendController@cwaders')->name('cwaders');
    Route::get('services', 'FrontendController@services')->name('services');
    Route::get('services/request', 'FrontendController@services_request')->name('services.request');
    Route::get('tickets', 'FrontendController@tickets')->name('tickets');
    Route::get('organizers', 'FrontendController@organizers')->name('organizers');
    Route::get('organizers/register', 'FrontendController@organizers_register')->name('organizers.register');
});
