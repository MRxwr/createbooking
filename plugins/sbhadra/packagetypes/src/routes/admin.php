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

Route::post('package-type/{id}/update', 'PackageTypesController@update')->name('admin.package-type.typeupdate');
Route::jwResource('package-type', 'PackageTypesController', ['except' => 'update']);
Route::get('/package-type-attributes/{id}', 'PackageTypesAttrController@index')->name('admin.package-type-attributes.index');
Route::jwResource('package-type-attributes', 'PackageTypesAttrController');

//Route::post('/package-type/attributes/store/{id}', 'PackageTypesController@attributeStore')->name('admin.attribute.store');