<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProvisionServer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/admin/ckfinder/connector',  [ProvisionServer::class, 'requestAction'])->name('ckfinder_connector')->middleware('ckeditor.auth');
Route::any('/admin/ckfinder/browser', [ProvisionServer::class, 'browserAction'])->name('ckfinder_browser')->middleware('ckeditor.auth');

Route::group(['namespace' => 'Admin'], function () {

    Route::get('/admin/login', 'AuthController@loginPage')->name('admin.login');
    Route::post('/admin/login', 'AuthController@login');

    Route::group(['middleware' => ['auth.admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/logout', 'AuthController@logout')->name('logout');
        Route::get('/', 'DashboardController@index')->name('dashboard');

        // News Routes
        Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
            Route::post('/preview', 'NewsController@preview')->name('preview');
            Route::post('/edit/save-draft', 'NewsController@saveDraft')->name('saveDraft');
            Route::post('/mass-update-status', 'NewsController@massUpdateStatus')->name('massUpdateStatus');
            Route::post('/mass-trash', 'NewsController@massTrash')->name('massTrash');
            Route::delete('/trash/{id}', 'NewsController@trash')->name('trash');
            Route::post('/sort', 'NewsController@updateSort')->name('sort');

            Route::get('/', 'NewsController@index')->name('index');
            Route::get('/edit/{id?}', 'NewsController@edit')->name('edit');
            Route::post('/edit/confirm/{id?}', 'NewsController@editConfirm')->name('confirm');
            Route::post('/edit/store/{id?}', 'NewsController@editStore')->name('store');
        });

        Route::group(['prefix' => 'manual', 'as' => 'manual.'], function () {
            Route::get('/', 'NewsController@index')->name('index');
            Route::get('/edit/{id?}', 'NewsController@edit')->name('edit');
            Route::post('/edit/confirm/{id?}', 'NewsController@editConfirm')->name('confirm');
            Route::post('/edit/store/{id?}', 'NewsController@editStore')->name('store');
        });

        // Registation Routes
        Route::group(['prefix' => 'registration', 'as' => 'registration.'], function() {
            Route::get('/', 'RegistrationController@index')->name('index');
            Route::get('/edit/{id}', 'RegistrationController@edit')->name('edit');
            Route::post('/edit/confirm/{id}', 'RegistrationController@editConfirm')->name('confirm');
            Route::post('/edit/store/{id}', 'RegistrationController@editStore')->name('store');
            Route::delete('/trash/{id}', 'RegistrationController@trash')->name('trash');
            Route::post('/mass-trash', 'RegistrationController@massTrash')->name('massTrash');
            Route::get('/export-csv', 'RegistrationController@exportCsv')->name('exportCsv');
        });

        // Team Routes
        Route::group(['prefix' => 'team', 'as' => 'team.'], function() {
            Route::get('/edit/{id?}', 'TeamController@edit')->name('edit');
            Route::post('/edit/confirm/{id?}', 'TeamController@editConfirm')->name('confirm');
            Route::post('/edit/store/{id?}', 'TeamController@editStore')->name('store');
            Route::get('/{id?}/member', 'MemberController@index')->name('member');
        });

        // Team Routes
        Route::group(['prefix' => 'member', 'as' => 'member.'], function() {
            Route::get('/edit/{team_id}/{member_id?}', 'MemberController@edit')->name('edit');
            Route::post('/edit/confirm/{team_id}/{member_id?}', 'MemberController@editConfirm')->name('confirm');
            Route::post('/edit/store/{team_id}/{member_id?}', 'MemberController@editStore')->name('store');
            Route::post('/import/{team_id}', 'MemberController@import')->name('import');
            Route::post('/mass-trash', 'MemberController@massTrash')->name('massTrash');
        });

        // Contact Routes
        Route::group(['prefix' => 'inquiry', 'as' => 'contact.'], function () {
            Route::get('/', 'ContactController@index')->name('index');
            Route::get('/edit/{id?}', 'ContactController@edit')->name('edit');
            Route::post('/confirm/{id?}', 'ContactController@update')->name('confirm');
            Route::post('/store/{id?}', 'ContactController@update')->name('store');
            Route::get('/{id}', 'ContactController@show')->name('detail');
        });
    });
});
