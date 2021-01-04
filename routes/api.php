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

/** CheckInRecord */
Route::group(['as' => 'record.'], function () {
    /** 簽到 */
    Route::post('/check_in', 'CheckInRecordController@signIn')->name('check_in');
    /** 簽退 */
    Route::post('/check_out', 'CheckInRecordController@signOut')->name('check_out');
    /** 補簽到 */
    Route::post('/recoup', 'CheckInRecordController@recoup')->name('recoup');
});
