<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1/user', 'as' => 'api.', 'namespace' => 'Api\V1\User', 'middleware' => 'changelanguage'], function () {

    Route::post('register','UserAuthApiController@register');
    Route::post('login','UserAuthApiController@login'); 

    // settings
    Route::get('nationality','SettingsApiController@nationality'); 
    Route::get('cities','SettingsApiController@cities'); 

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
            Route::get('/','SpecializationsApiController@index') ;
            Route::post('add','SpecializationsApiController@store') ;
            Route::get('delete/{specialization_id}','SpecializationsApiController@delete') ;
        }); 

        // events
        Route::group(['prefix' =>'events'],function(){
            Route::get('/','EventsApiController@index') ;
            Route::post('join','EventsApiController@join') ; 
        }); 

    });
});



