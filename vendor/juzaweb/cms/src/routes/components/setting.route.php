<?php
/**
 * CODEPRESS CMS - The Best CMS for Laravel Project
 *
 * @package sanjoo83/laravel-cms
 * @author  The Anh Dang <sbhadra0@gmail.com>
 * @link https://hatcodes.com/cms
 * @license MIT
 */
Route::group(['prefix' => 'setting/system'], function () {
    Route::get('/', 'Backend\Setting\SystemSettingController@index')->name('admin.setting');

    Route::get('/{form}', 'Backend\Setting\SystemSettingController@index')->name('admin.setting.form');

    Route::post('/save', 'Backend\Setting\SystemSettingController@save')->name('admin.setting.save');
});
