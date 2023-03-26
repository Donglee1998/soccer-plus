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

Route::group(['namespace' => 'Api', 'middleware' => 'auth.api'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
        Route::post('login', 'AuthController@login')->name('login')->withoutMiddleware(['auth.api']);
        Route::get('user', 'AuthController@getUser')->name('index');
        Route::get('logout', 'AuthController@logout')->name('logout');
    });

    Route::group(['prefix' => 'team', 'as' => 'team.'], function () {
        Route::post('sync', 'TeamController@sync')->name('sync');
        Route::get('get_team_is_home', 'TeamController@getTeamIsHome')->name('get_team_is_home');
    });

    Route::group(['prefix' => 'member', 'as' => 'member.'], function () {
        Route::post('sync', 'MemberController@sync')->name('sync');
    });

    Route::group(['prefix' => 'match', 'as' => 'match.'], function () {
        Route::post('sync', 'MatchController@sync')->name('sync');
    });

    Route::group(['prefix' => 'stat', 'as' => 'stat.'], function () {
        Route::post('sync', 'StatController@sync')->name('sync');
    });

    Route::group(['prefix' => 'tactic', 'as' => 'tactic.'], function () {
        Route::post('sync', 'TacticController@sync')->name('sync');
    });

    Route::group(['prefix' => 'backup', 'as' => 'backup.'], function () {
        Route::get('/', 'BackupController@index')->name('index');
        Route::post('create', 'BackupController@store')->name('store');
        Route::post('restore/{id}', 'BackupController@restore')->name('restore');
        Route::delete('delete/{id}', 'BackupController@delete')->name('delete');
        Route::delete('multi_delete', 'BackupController@multiDelete')->name('delete.multi');
    });
});
