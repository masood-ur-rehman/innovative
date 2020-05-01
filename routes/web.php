<?php

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

/* FILMS & COMMENTS */
Route::get('/', function () {
    return redirect('films');
});
Auth::routes();
Route::resource('films', 'WEB\FilmsController');


Route::middleware(['auth'])->group(function () {
    Route::get('/film/{film}/comment/create', 'WEB\CommentsController@create')->name('comments.create');
    Route::post('/comment/store', 'WEB\CommentsController@store')->name('comments.store');
});
