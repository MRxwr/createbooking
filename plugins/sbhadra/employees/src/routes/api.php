<?php

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

Route::get('/get/vendors', 'EmployeesController@index')->name('api.get.vendors');
Route::post('/add/vendor', 'EmployeesController@add')->name('api.add.vendor');
Route::post('/get/vendor', 'EmployeesController@getVendorByUsername')->name('api.get.vendor');
Route::post('/update/vendor', 'EmployeesController@updateVendor')->name('api.update.vendor');
Route::post('/save/vendor', 'EmployeesController@UpdateVendorData')->name('api.save.vendor');