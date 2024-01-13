<?php
/**
 * CODEPRESS CMS - The Best CMS for Laravel Project
 *
 * @package sanjoo83/laravel-cms
 * @author  The Anh Dang <sbhadra0@gmail.com>
 * @link https://hatcodes.com/cms
 * @license MIT
 */

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');

    Route::get('/load-data/{func}', 'Backend\LoadDataController@loadData')->name('admin.load_data');

    Route::get('/dashboard/users', 'Backend\DashboardController@getDataUser')->name('admin.dashboard.users');

    Route::get('/dashboard/notifications', 'Backend\DashboardController@getDataNotification')->name('admin.dashboard.notifications');

    Route::get('/dashboard/views-chart', 'Backend\DashboardController@viewsChart')->name('admin.dashboard.views_chart');

    Route::get('/datatable/get-data', 'Backend\DatatableController@getData')->name('admin.datatable.get-data');

    Route::post('/datatable/bulk-actions', 'Backend\DatatableController@bulkActions')->name('admin.datatable.bulk-actions');
});

Route::group(['prefix' => '/updates'], function () {
    Route::get('/', 'Backend\UpdateController@index')->name('admin.update');
    Route::get('/check-update', 'Backend\UpdateController@checkUpdate')->name('admin.update.check');
    Route::post('/', 'Backend\UpdateController@update');
    Route::get('/get-plugins', 'Backend\UpdateController@pluginDatatable')->name('admin.update.plugins');
    Route::get('/get-themes', 'Backend\UpdateController@themeDatatable')->name('admin.update.themes');
});
