<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Public routes
Route::post('/token/authenticate', 'TokensController@authenticate');
Route::post('/user', 'UsersController@create');

//Auth required routes
Route::middleware('auth:api')->group(function() {
    
    Route::get('/user', 'UsersController@get');

    Route::get('/exercises', 'ExercisesController@get');
    Route::post('/exercises', 'ExercisesController@create');
    Route::patch('/exercises/{exerciseId}', 'ExercisesController@update');
    Route::delete('/exercises/{exerciseId}', 'ExercisesController@destroy');

    Route::get('/routines', 'RoutinesController@get');
    Route::post('/routines', 'RoutinesController@create');
    Route::patch('/routines/{routineId}', 'RoutinesController@update');
    Route::delete('/routines/{routineId}', 'RoutinesController@destroy');
});
