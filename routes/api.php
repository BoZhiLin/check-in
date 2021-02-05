<?php

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

/** 登入認證 */
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    /** 登入 */
    Route::post('/login', 'AuthController@login')->name('login');
    /** 登出 */
    Route::post('/logout', 'AuthController@logout')->name('logout')->middleware('api.auth');
    /** 更換Token */
    Route::post('/refresh', 'AuthController@refresh')->name('refresh')->middleware('api.auth');
});

/** Authenticated Allow */
Route::group(['middleware' => ['api.auth']], function () {
    // TODO
});
