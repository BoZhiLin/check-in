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
    /** 打卡紀錄 */
    Route::group(['prefix' => 'check', 'as' => 'check.'], function () {
        /** 簽到 */
        Route::post('/in', 'CheckController@checkIn')->name('in');
        /** 簽退 */
        Route::post('/out', 'CheckController@checkOut')->name('out');
    });

    /** 請假 */
    Route::group(['prefix' => 'leave', 'as' => 'leave.'], function () {
        /** 申請 */
        Route::post('/apply', 'LeaveController@apply')->name('apply');
    });

    /** User */
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        /** 取得資訊 */
        Route::get('/info', 'UserController@getInfo')->name('info');
        /** 取得打卡紀錄 */
        Route::get('/checks', 'UserController@getCheckRecords')->name('checks');
        /** 取得請假紀錄 */
        Route::get('/leaves', 'UserController@getLeaveRecords')->name('leaves');
    });
});
