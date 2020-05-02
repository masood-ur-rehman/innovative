<?php
use Illuminate\Support\Facades\Artisan;

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
Route::get('/', 'WEB\FilmsController@index');
Route::resource('films', 'WEB\FilmsController');


Route::middleware(['auth'])->group(function () {
    Route::get('/film/{film}/comment/create', 'WEB\CommentsController@create')->name('comments.create');
    Route::post('/comment/store', 'WEB\CommentsController@store')->name('comments.store');
});
Auth::routes();

/**
 * CLEARED THE CACHE IF YOU GOT AN ERROR
 * cURL error 6: Could not resolve host: films (see https://curl.haxx.se/libcurl/c/libcurl-errors.html)
 */
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});
Route::get('/optimize', function() {
    Artisan::call('optimize');
    return "Optimized";
});
Route::get('/', function () {
    return redirect('films');
});
