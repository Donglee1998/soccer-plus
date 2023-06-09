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

Route::group(['namespace' => "Api\V2", 'middleware' => 'auth.api'], function () {
    Route::group(['prefix' => 'test', 'as' => 'test.'], function () {
        Route::get('/', 'TestController@index')->name('index');
    });
});
