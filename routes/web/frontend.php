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
Route::get('caders/register', 'Frontend\CadersController@cader_register')->name('caders.register');
Route::post('caders/register_submit', 'Frontend\CadersController@register_submit')->name('caders.register_submit');

Route::get('services/register', 'Frontend\ServicesController@service_register')->name('services.register');
Route::post('services/register_submit', 'Frontend\ServicesController@register_submit')->name('services.register_submit');

Route::get('organizers/register', 'Frontend\EventsOrganizersController@organizers_register')->name('organizers.register');
Route::post('organizers/media', 'Frontend\EventsOrganizersController@storeMedia')->name('organizers.storeMedia');
Route::post('organizers/ckmedia', 'Frontend\EventsOrganizersController@storeCKEditorImages')->name('organizers.storeCKEditorImages');
Route::post('organizers/register_submit', 'Frontend\EventsOrganizersController@register_submit')->name('organizers.register_submit');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    // User Alerts 
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);
    Route::get('user-alerts/read', 'UserAlertsController@read');
});


Route::group([ 'as' => 'frontend.' , 'namespace' => 'Frontend'],function () { 
    Route::get('/','FrontendController@home')->name('home');
    Route::get('about-us','FrontendController@aboutus')->name('aboutus');
    Route::get('contact', 'FrontendController@contact')->name('contact');

    //caders
    Route::get('cader/register', 'CadersController@cader_register')->name('cader.register');
    Route::get('cader/{id}', 'CadersController@cader_single')->name('cader.single');
    Route::get('cwaders', 'CadersController@cwaders')->name('cwaders');
    Route::post('add_cader_to_event', 'CadersController@add_cader_to_event')->name('add_cader_to_event');

    //services 
    Route::get('services', 'ServicesController@services')->name('services');
    Route::get('services/request', 'ServicesController@services_request')->name('services.request');
    Route::get('tickets', 'ServicesController@tickets')->name('tickets');
    Route::get('all_services','ServicesController@all_services')->name('all_services');
    Route::post('add_service_to_event', 'ServicesController@add_service_to_event')->name('add_service_to_event');

    //events
    Route::get('my_list','EventsController@my_list')->name('my_list');
    Route::get('events/request/{id}','EventsController@event_request')->name('events.request');
    Route::post('events/cader/destroy','EventsController@cader_destroy')->name('events.cader.destroy');
    Route::post('events/service/destroy','EventsController@service_destroy')->name('events.service.destroy');

    //events organizers
    Route::get('organizers', 'EventsOrganizersController@organizers')->name('organizers');
});
