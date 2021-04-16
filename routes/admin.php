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

/** 登入認證 */
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    /** 登入 */
    Route::post('/login', 'AuthController@login')->name('login');
    /** 登出 */
    Route::post('/logout', 'AuthController@logout')->name('logout')->middleware('admin.auth');
    /** 更換Token */
    Route::post('/refresh', 'AuthController@refresh')->name('refresh')->middleware('admin.auth');
});

/** Authenticated Allow */
Route::group(['middleware' => ['admin.auth']], function () {
    /** User */
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        /** 員工列表 */
        Route::get('/', 'UserController@index')->name('index');
        /** 新增員工 */
        Route::post('/', 'UserController@store')->name('store');
        /** 更新員工資料 */
        Route::put('/{user_id}', 'UserController@update')->name('update');
        /** 註記離職 */
        Route::put('/{user_id}/leave', 'UserController@leave')->name('leave');
        /** 註記復職 */
        Route::put('/{user_id}/active', 'UserController@active')->name('active');
        /** 刪除員工 */
        Route::delete('/{user_id}', 'UserController@destroy')->name('destroy');
    });
});