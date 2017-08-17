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

Route::middleware('auth:web')->get('/user', function (Request $request) {
    return $request->user();
});

/* ratings */
Route::get('/ratings', 'ApiController@ratingsGet')->name('ratings');
Route::post('/ratings', 'ApiController@ratingsPost');

/* images */
Route::get('/images/random', 'ApiController@imagesRandomGet')->name('randomImage');
