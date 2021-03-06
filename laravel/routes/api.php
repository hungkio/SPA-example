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
Route::post('/register', ['as' => 'register', 'uses' => 'ApiUserController@register']);
Route::post('/login', ['as' => 'login', 'uses' => 'ApiUserController@login']);
Route::post('/user', ['as' => 'auth_user', 'uses' => 'ApiUserController@getAuth'])->middleware('auth:api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
