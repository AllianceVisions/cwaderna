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

Route::group(['prefix' => 'events-organizer', 'as' => 'events-organizer.', 'namespace' => 'EventsOrganizer', 'middleware' => ['auth','events_organizer']], function () {

    Route::get('/', 'HomeController@index')->name('home'); 

    Route::post('user-alerts/read', 'UserAlertsController@read')->name('alert.read');
    
    // Events 
    Route::post('events/partials/attendance_cader', 'EventsController@partials_attendance_cader')->name('events.partials.attendance_cader');
    Route::get('events/change_status/{id}/{status}', 'EventsController@change_status')->name('events.change_status');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');
    
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () { 
        Route::get('/', 'ProfileController@edit')->name('edit');
        Route::post('/', 'ProfileController@updateProfile')->name('update');
        Route::post('password', 'ProfileController@updatePassword')->name('password.update');
        Route::post('media', 'ProfileController@storeMedia')->name('storeMedia');
        Route::post('ckmedia', 'ProfileController@storeCKEditorImages')->name('storeCKEditorImages');
    });

});
