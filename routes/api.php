<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication
Route::post('login', 'Mobile\AuthController@login');
Route::post('register', 'Mobile\AuthController@register');

// Categories & News
Route::get('/categories', 'Mobile\AppController@categories');
Route::get('/news', 'Mobile\AppController@allNews');

// Category News
Route::get('/category-news/{slug}', 'Mobile\AppController@categoryNews');
Route::get('/category-four-news/{slug}', 'Mobile\AppController@categoryFourNews');
Route::get('/category-single-news/{slug}', 'Mobile\AppController@categorySingleNews');

// Latest, Featured & Breaking News
Route::get('/latest-news', 'Mobile\AppController@latestNews');
Route::get('/featured-news', 'Mobile\AppController@featuredNews');
Route::get('/breaking-news', 'Mobile\AppController@breakingNews');

// News
Route::get('/news/{slug}', 'Mobile\AppController@news');
