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

Route::post('/token/authenticate', 'TokensController@authenticate');

Route::post('/user', 'UsersController@create');
Route::middleware('auth:api')->get('/user', 'UsersController@get');
