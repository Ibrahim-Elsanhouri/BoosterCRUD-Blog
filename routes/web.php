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

Route::get('/','FrontController@getIndex');
Route::get('/article/{slug}','FrontController@getArticle');
Route::get('/cat/{id}','FrontController@getByCategories');
Route::get('/latest','FrontController@getLatest');
Route::get('/search', 'FrontController@getSearch');
Route::get('/noft', 'FrontController@notf');