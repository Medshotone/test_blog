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
Route::get('/comments/article', 'CommentControllerArticle@index')->name('comment.article.all');
Route::post('/comments/article', 'CommentControllerArticle@store')->name('comment.article.store');
Route::get('/comments/article/{article}', 'CommentControllerArticle@show')->name('comment.article.show');

//category comments
Route::get('/comments/category', 'CommentControllerCategory@index')->name('comment.category.all');
Route::post('/comments/category', 'CommentControllerCategory@store')->name('comment.category.store');
Route::get('/comments/category/{category}', 'CommentControllerCategory@show')->name('comment.category.show');

Route::put('/comments/{comment}', 'CommentController@update')->name('comment.update');

Route::delete('/comments/{comment}', 'CommentController@destory')->name('comment.destroy');
