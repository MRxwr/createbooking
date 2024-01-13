<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 *
 * SBhadra0.
 * Date: 8/12/2021
 * Time: 4:03 PM
 */

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'Api\Auth\LoginController@login');

    Route::post('refresh', 'Api\Auth\LoginController@refresh');

    Route::post('logout', 'Api\Auth\LoginController@logout');
    Route::post('profile', 'Auth\LoginController@profile');
});
