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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth','staff']], function () {

    Route::get('/', 'HomeController@index')->name('home'); 

    // Permissions 
    Route::resource('permissions', 'PermissionsController');

    // Roles 
    Route::resource('roles', 'RolesController');

    // Users
    Route::post('users/update_approved', 'UsersController@update_approved')->name('users.update_approved'); 
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Cities 
    Route::resource('cities', 'CitiesController');

    // Specialization 
    Route::resource('specializations', 'SpecializationController');

    // Skills 
    Route::resource('skills', 'SkillsController');
    
    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Events   
    Route::post('events/partials/add_cader', 'EventsController@partials_add_cader')->name('events.partials.add_cader');
    Route::post('events/partials/edit_cader', 'EventsController@partials_edit_cader')->name('events.partials.edit_cader');
    Route::post('events/partials/attendance_cader', 'EventsController@partials_attendance_cader')->name('events.partials.attendance_cader'); 
    Route::post('events/cader_status', 'EventsController@cader_status')->name('events.cader_status');
    Route::get('events/send_pricing/{id}', 'EventsController@send_pricing')->name('events.send_pricing');
    Route::post('events/delete_cader', 'EventsController@delete_cader')->name('events.delete_cader');
    Route::post('events/update_cader', 'EventsController@update_cader')->name('events.update_cader');
    Route::post('events/add_cader', 'EventsController@add_cader')->name('events.add_cader');
    Route::post('events/add_item', 'EventsController@add_item')->name('events.add_item');
    Route::post('events/update_item', 'EventsController@update_item')->name('events.update_item');
    Route::post('events/refresh_caders_list', 'EventsController@refresh_caders_list')->name('events.refresh_caders_list');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController', ['except' => ['show']]);
    Route::get('events/{event}/{relation_tab?}','EventsController@show')->name('events.show');

    // Event Organizer
    Route::post('event-organizers/update_approved', 'EventOrganizerController@update_approved')->name('event-organizers.update_approved');
    Route::post('event-organizers/media', 'EventOrganizerController@storeMedia')->name('event-organizers.storeMedia');
    Route::post('event-organizers/ckmedia', 'EventOrganizerController@storeCKEditorImages')->name('event-organizers.storeCKEditorImages');
    Route::resource('event-organizers', 'EventOrganizerController');

    // Cader
    Route::post('caders/new_previous_experience', 'CaderController@new_previous_experience')->name('caders.new_previous_experience');
    Route::post('caders/new_acadmeic_degree', 'CaderController@new_acadmeic_degree')->name('caders.new_academic_degree');
    Route::post('caders/partials/previous_experience', 'CaderController@previous_experience')->name('caders.partials.previous_experience');
    Route::post('caders/update_approved', 'CaderController@update_approved')->name('caders.update_approved');
    Route::post('caders/media', 'CaderController@storeMedia')->name('caders.storeMedia');
    Route::post('caders/ckmedia', 'CaderController@storeCKEditorImages')->name('caders.storeCKEditorImages');
    Route::resource('caders', 'CaderController');

    // Categories 
    Route::resource('categories', 'CategoriesController');

    // Provider Man
    Route::post('provider-men/update_approved', 'ProviderManController@update_approved')->name('provider-men.update_approved');
    Route::resource('provider-men', 'ProviderManController');

    // Items 
    Route::post('items/media', 'ItemsController@storeMedia')->name('items.storeMedia');
    Route::post('items/ckmedia', 'ItemsController@storeCKEditorImages')->name('items.storeCKEditorImages');
    Route::resource('items', 'ItemsController');

    
    // General Settings
    Route::post('general-settings/media', 'GeneralSettingsController@storeMedia')->name('general-settings.storeMedia');
    Route::post('general-settings/ckmedia', 'GeneralSettingsController@storeCKEditorImages')->name('general-settings.storeCKEditorImages');
    Route::resource('general-settings', 'GeneralSettingsController', ['except' => ['create', 'store', 'show', 'destroy']]);

    // Sliders 
    Route::post('sliders/media', 'SlidersController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SlidersController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SlidersController');
    
    //Contact Us
    Route::delete('contactus/destroy/{contactus}','ContactUsController@destroy')->name('contactus.destroy');
    Route::get('contactus','ContactUsController@index')->name('contactus.index');

    // User Alerts 
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);
    Route::post('user-alerts/read', 'UserAlertsController@read')->name('alert.read');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar'); 

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () { 
        Route::get('/', 'ProfileController@edit')->name('edit');
        Route::post('/', 'ProfileController@updateProfile')->name('update');
        Route::post('password', 'ProfileController@updatePassword')->name('password.update');
    });

});
