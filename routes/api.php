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

Route::get('/comments', 'CommentController@index')->name('comment.all');

Route::post('/comments', 'CommentController@store')->name('comment.store');

Route::get('/comments/article/{article}', 'CommentController@show')->name('comment.show');

Route::put('/comments/{comment}', 'CommentController@update')->name('comment.update');

Route::delete('/comments/{comment}', 'CommentController@destory')->name('comment.destroy');
