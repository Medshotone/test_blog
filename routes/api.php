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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//article comments
Route::get('/comments/article', 'CommentArticleController@index')->name('comment.article.all');
Route::post('/comments/article', 'CommentArticleController@store')->name('comment.article.store');
Route::get('/comments/article/{article}', 'CommentArticleController@show')->name('comment.article.show');

//category comments
Route::get('/comments/category', 'CommentCategoryController@index')->name('comment.category.all');
Route::post('/comments/category', 'CommentCategoryController@store')->name('comment.category.store');
Route::get('/comments/category/{category}', 'CommentCategoryController@show')->name('comment.category.show');
