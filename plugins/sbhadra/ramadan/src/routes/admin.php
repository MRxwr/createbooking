<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


Route::post('timeslot/ramadan/setting', 'RamadanController@settingSave')->name('admin.ramadan.setting');
Route::Resource('timeslot/ramadan', 'RamadanController');