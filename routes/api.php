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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::get('articles', 'ArticleController@index')->middleware('cors');
Route::get('articles/{id}', 'ArticleController@show');
Route::post('articles', 'ArticleController@store');
Route::put('articles/{id}', 'ArticleController@update');
Route::delete('articles/{id}', 'ArticleController@delete');

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login')->middleware('cors');
Route::get('refresh', 'UserController@refresh');
Route::post('update', 'UserController@updateUser');


Route::post('commentArticle', 'ArticleController@commentArticle')->middleware('cors');

Route::get('getAllComment','ArticleController@getAllComment')->middleware('cors');
Route::get('getCommentById','ArticleController@getCommentById')->middleware('cors');
Route::get('deleteComment','ArticleController@deleteComment')->middleware('cors');

Route::post('editComment', 'ArticleController@editComment')->middleware('cors');

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('user-info', 'UserController@getUserInfo');
});

Route::get('plans', 'PlanController@getAll')->middleware('cors');
Route::post('save','PlanController@save')->middleware('cors');
Route::get('checkDuplicatePlan','PlanController@checkDuplicatePlan')->middleware('cors');


Route::get('getNamePlans', 'PlanController@getNamePlans')->middleware('cors');

Route::get('deletePlan', 'PlanController@deletePlan')->middleware('cors');

Route::get('works', 'WorkController@getAllWork')->middleware('cors');


Route::get('workTypes', 'WorkController@getAllWorkType')->middleware('cors');
Route::post('saveWork', 'WorkController@save')->middleware('cors');
Route::get('deleteWork', 'WorkController@deleteWork')->middleware('cors');


Route::get('getWorkById', 'WorkController@getWorkById')->middleware('cors');