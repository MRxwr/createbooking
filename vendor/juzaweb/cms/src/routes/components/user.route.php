<?php
/**
 * @package    juzawebcms/juzawebcms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://github.com/juzawebcms/juzawebcms
 * @license    MIT
 *
 * SBhadra0.
 * Date: 5/25/2021
 * Time: 9:02 PM
 */

Route::jwResource('users', 'Backend\UserController');
Route::get('users/{id}/config', 'Backend\UserController@config')->name('admin.users.config');
Route::post('users/{id}/config', 'Backend\UserController@configSave')->name('admin.users.config');;
