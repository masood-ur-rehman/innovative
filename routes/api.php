<?php

use Illuminate\Http\Request;

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
Route::post('login', 'API\UserController@authenticate');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::resource('films', 'API\FilmsController');
});
/*Route::group(['middleware' => 'auth.jwt'], function(){
    Route::post('details', 'API\UserController@details');
//    Route::resource('films', 'API\FilmsController');
});*/

//Route::post('login', 'APIController@login');
//Route::post('login', 'API\UserController@authenticate');
//Route::get('getAuthenticatedUser', 'API\UserController@getAuthenticatedUser');
//Route::post('register', 'APIController@register');

//Route::group(['middleware' => 'auth.jwt'], function () {
//    Route::get('logout', 'APIController@logout');
//});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

