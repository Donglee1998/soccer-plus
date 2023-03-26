<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['as' => 'web.', 'namespace' => 'Web'], function() {
    Route::get('/', 'StaticController@top')->name('top');
    Route::get('/faq', 'StaticController@faq')->name('faq');
    Route::get('/privacy', 'StaticController@privacy')->name('privacy');
    Route::get('/company', 'StaticController@company')->name('company');
    Route::get('/tos', 'StaticController@tos')->name('tos');

    Route::group(['as' => 'auth.'], function() {
        Route::get('/login', 'AuthController@showLoginForm')->name('showForm.login');
        Route::post('/login', 'AuthController@login')->name('submit.login');
        Route::get('/forgot-password', 'AuthController@showForgotPasswordForm')->name('showForm.forgotPassword');
        Route::post('/forgot-password', 'AuthController@forgotPassword')->name('submit.forgotPassword');
        Route::get('/reset-password/{token}', 'AuthController@showFormResetPassword')->name('showForm.resetPassword');
        Route::post('/reset-password', 'AuthController@resetPassword')->name('submit.resetPassword');
        Route::get('/logout', 'AuthController@logout')->name('submit.logout');
        Route::get('/password-reset-successful', 'AuthController@passwordResetSuccessful')->name('resetPassword.success');
    });

    // Article Routes
    Route::group(['prefix' => 'news', 'as' => 'news.'], function() {
        Route::get('/', 'NewsController@listNews')->name('list');
        Route::get('/preview/{url?}', 'NewsController@preview')->name('preview');
        Route::get('/{category}/{id}', 'NewsController@detailNews')->name('detail');
    });
    Route::group(['prefix' => 'manual', 'as' => 'manual.'], function() {
        Route::get('/', 'NewsController@listManual')->name('list');
        Route::get('/{id}', 'NewsController@detailManual')->name('detail');
        Route::get('/preview/{url?}', 'NewsController@preview')->name('preview');
    });

    // Entry Routes
    Route::group(['as' => 'entry.'], function () {
        Route::get('entry', 'EntryController@index')->name('index');
        Route::post('entry', 'EntryController@indexPost')->name('index_post');
        Route::post('entry_confirm', 'EntryController@confirm')->name('confirm');
        Route::post('entry_thanks', 'EntryController@thanks')->name('thanks');
    });

    Route::get('/preview/{file}', 'PreviewController@index');
    Route::get('/preview/{folder}/{file}', 'PreviewController@folder');

    Route::group(['middleware' => 'auth.web'], function () {

        // Team
        Route::get('/team/{id}/member', 'TeamController@memberOfTeam')->name('team.member');
        Route::resource('team', TeamController::class)->parameters(['team' => 'id'])->only(['index', 'show']);

        //Period Aggregation
        Route::group(['prefix' => 'period_aggregation', 'as' => 'period_aggregation.'], function() {
            Route::get('/', 'PeriodAggregationController@index')->name('index');
            Route::get('/period_stat', 'PeriodAggregationController@stat')->name('stat');
            Route::post('period_stat/check', 'PeriodAggregationController@statCheck')->name('stat.check');
            Route::post('period_stat/team', 'PeriodAggregationController@team')->name('stat.period_stat.team');
            Route::post('period_stat/personal', 'PeriodAggregationController@personal')->name('stat.period_stat.personal');
            Route::post('period_stat/personal_by_match', 'PeriodAggregationController@personalByMatch')->name('stat.period_stat.personal_by_match');
            Route::get('/chart', 'PeriodAggregationController@chart')->name('chart');
            Route::post('/chart/get_stats', 'PeriodAggregationController@getStats')->name('chart.get_stats');
        });

        // Folder
        Route::group(['prefix' => 'team_album'], function() {
            Route::get('/', 'FolderController@list')->name('team.album');
            Route::get('/folders/{folder_id}', 'FolderController@listVideoOfFolder')->name('list.video.folder');
            Route::get('/video/{video_id}', 'VideoController@show')->name('show.video');
        });

        Route::group(['prefix' => 'folder', 'as' => 'folder.'], function() {
            Route::post('/', 'FolderController@store')->name('store');
            Route::post('/destroy', 'FolderController@destroy')->name('destroy');
            Route::put('/update/{folder_id}', 'FolderController@update')->name('update');
        });

        // Video
        Route::group(['prefix' => 'video', 'as' => 'video.'], function() {
            Route::post('/', 'VideoController@store')->name('store');
            Route::post('/destroy', 'VideoController@destroy')->name('destroy');
            Route::put('/update/{video_id}', 'VideoController@update')->name('update');
        });

        // ScoreBook
        Route::group(['prefix' => 'scorebook', 'as' => 'scorebook.'], function() {
            Route::get('/', 'ScorebookController@index')->name('list');
            Route::post('search-list', 'ScorebookController@searchListMatch')->name('search.list');
            Route::post('/destroy', 'ScorebookController@destroy')->name('destroy');

            // Play Video
            Route::post('/matches/delete_stat_video_play', 'ScorebookMatchesVideoController@deleteStatVideoPlay');
            Route::post('/matches/add_time_play_all_stats', 'ScorebookMatchesVideoController@addTimePlayAllStats');
            Route::get('/matches/{matches_id}/video/', 'ScorebookMatchesVideoController@index')->name('matches.video');

            // Stat
            Route::get('/matches/{matches_id}/stat/', 'ScorebookMatchesStatController@index')->name('matches.stat');
            Route::post('/matches/{matches_id}/stat/personal', 'ScorebookMatchesStatController@personal')->name('matches.stat.personal');
            Route::post('/matches/{matches_id}/stat/team', 'ScorebookMatchesStatController@team')->name('matches.stat.team');

            Route::get('/matches/{matches_id}/video/{stat_id}/edit', 'ScorebookMatchesVideoController@editStatVideoPlay')->name('matches.edit');
            Route::post('/matches/{matches_id}/video/{stat_id}/edit', 'ScorebookMatchesVideoController@updateStatVideoPlay')->name('matches.update');
            Route::post('/stat/get_pulldown_video', 'ScorebookMatchesVideoController@getPulldownVideo');
            Route::post('/matches/{matches_id}/play_time', 'ScorebookMatchesVideoController@updatePlayTime');

            // Chart
            Route::get('/matches/{matches_id}/chart/', 'ScorebookMatchesChartController@index')->name('matches.chart');
            Route::post('/matches/{matches_id}/chart/team', 'ScorebookMatchesChartController@team')->name('matches.chart.team');
            Route::post('/matches/{matches_id}/chart/short_chart', 'ScorebookMatchesChartController@chart')->name('matches.chart.short_chart');

            // Comment
            Route::get('/matches/{matches_id}/comment', 'ScorebookMatchesCommentController@edit')->name('matches.comment.edit');
            Route::post('/matches/{matches_id}/comment', 'ScorebookMatchesCommentController@store')->name('matches.comment.store');

            // Report
            Route::get('/matches/{matches_id}/report', 'ScorebookMatchesReportController@index')->name('matches.report');
        });

        // PDF
        Route::group(['prefix' => 'report-pdf', 'as' => 'pdf.'], function() {
            Route::get('/matches/{matches_id}/kickball_changeplayer', 'ScorebookMatchesPDFReportController@kickBallChangePlayers')->name('kickball_changeplayer');
            Route::get('/matches/{matches_id}/ball_control_rate', 'ScorebookMatchesPDFReportController@ballControlRateOfTeams')->name('ball_control_rate');
            Route::get('/matches/{matches_id}/startinglineup_verticalchart', 'ScorebookMatchesPDFReportController@startingLineUpVerticalCharts')->name('startinglineup_verticalchart');
            Route::get('/matches/{matches_id}/analysischart_hometeam', 'ScorebookMatchesPDFReportController@analysisChartHomeTeams')->name('analysischart_hometeam');
            Route::get('/matches/{matches_id}/analysischart_awayteam', 'ScorebookMatchesPDFReportController@analysisChartAwayTeams')->name('analysischart_awayteam');
            Route::get('/matches/{matches_id}', 'ScorebookMatchesPDFReportController@index')->name('index')->middleware('except.pdf');
        });

        // Ajax For Codding
        Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function() {

            // Folder
            Route::get('list-folder', 'AjaxController@listFolder')->name('list.folder');
            Route::post('folder', 'AjaxController@storeFolder')->name('store.folder');

            // Video
            Route::get('list-video', 'AjaxController@listVideo')->name('list.video');
            Route::post('chunk-video', 'UploaderController@upload')->name('chunk-video.store');
            Route::post('album-validate', 'UploaderController@albumValidate')->name('chunk-video.album-validate');
            Route::post('album-save', 'UploaderController@albumSave')->name('chunk-video.album-save');
            Route::post('play-validate', 'UploaderController@playValidate')->name('chunk-video.play-validate');
            Route::post('chunk-progress', 'UploaderController@progress')->name('chunk-video.progress');
        });

        // Tactic
        Route::resource('board', TacticController::class)->parameters(['tactic' => 'id'])->only(['index', 'show']);
        Route::group(['prefix' => 'tactic', 'as' => 'tactic.'], function() {
            Route::post('/destroy', 'TacticController@destroy')->name('destroy');
        });

        // Member
        Route::resource('team.member', MemberController::class)->only(['show']);
    });

    // Contact Routes
    Route::group(['prefix' => 'inquiry', 'as' => 'contact.'], function () {
        Route::get('/', 'ContactController@create')->name('create');
        Route::post('/confirm', 'ContactController@store')->name('store');
        Route::get('/thanks', 'ContactController@thanks')->name('thanks');
    });
});
