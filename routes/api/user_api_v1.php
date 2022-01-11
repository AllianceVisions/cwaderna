<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1/user', 'as' => 'api.', 'namespace' => 'Api\V1\User', 'middleware' => 'changelanguage'], function () {

    Route::post('register','UserAuthApiController@register');
    Route::post('login','UserAuthApiController@login'); 

    // settings
    Route::get('nationality','SettingsApiController@nationality'); 
    Route::get('cities','SettingsApiController@cities'); 
    Route::get('breaks_type','SettingsApiController@breaks_type');
    Route::get('prefix','SpecializationsApiController@index') ;

    //forgetpassword
    Route::post('forgetpassword','ForgetPasswordController@create_token');
    Route::post('forgetpassword/reset','ForgetPasswordController@reset');

    Route::group(['middleware' => ['auth:sanctum']],function () {

        Route::post('fcm-token','UsersApiController@update_fcm_token');

        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile');
            Route::post('update','UsersApiController@update');
            Route::post('update_password','UsersApiController@update_password');
        }); 

        // academic_degree
        Route::group(['prefix' =>'academic_degree'],function(){
            Route::post('add','AcademicDegreeApiController@store') ;
            Route::post('update','AcademicDegreeApiController@update') ;
            Route::get('delete/{academic_degree_id}','AcademicDegreeApiController@delete') ;
        });

        // previous_experience
        Route::group(['prefix' =>'previous_experience'],function(){
            Route::post('add','PreviousExperienceApiController@store') ;
            Route::post('update','PreviousExperienceApiController@update') ;
            Route::get('delete/{previous_experience_id}','PreviousExperienceApiController@delete') ;
        }); 

        // skills
        Route::group(['prefix' =>'skills'],function(){
            Route::get('/','SkillsApiController@index') ;
            Route::post('add','SkillsApiController@store') ;
            Route::get('delete/{skill_id}','SkillsApiController@delete') ;
        }); 

        // specializations
        Route::group(['prefix' =>'specializations'],function(){
            Route::post('add','SpecializationsApiController@store') ;
            Route::get('delete/{specialization_id}','SpecializationsApiController@delete') ;
        }); 

        // events
        Route::group(['prefix' =>'events'],function(){
            Route::get('/','EventsApiController@index') ;
            Route::get('search/{search}','EventsApiController@search') ;
            Route::post('join','EventsApiController@join') ; 
        }); 

        // events
        Route::group(['prefix' =>'cader/events'],function(){
            Route::get('/','CaderEventsApiController@index') ; 
            Route::get('find/{id}','CaderEventsApiController@find') ; 
            Route::post('response','CaderEventsApiController@response') ;  
            Route::get('accepted','CaderEventsApiController@accepted') ; 
            Route::get('refused','CaderEventsApiController@refused') ; 
            Route::get('incoming','CaderEventsApiController@incoming') ; 
            Route::get('canceled','CaderEventsApiController@canceled') ; 
            Route::get('pending','CaderEventsApiController@pending') ; 
            Route::post('attend','CaderEventsApiController@attend') ; 

            //break
            Route::post('break/request','CaderEventsApiController@break_request') ; 
            Route::post('break/cancel','CaderEventsApiController@break_cancel') ;  
        });  

        // notifications
        Route::get('notifications','NotificationsApiController@index');

    });
});



