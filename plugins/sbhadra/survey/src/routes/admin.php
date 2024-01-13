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
Route::get('/survey/details/{id}', 'SurveyController@getDetails')->name('admin.survey.view');
Route::get('/survey/referral-code', 'CouponsController@index');
Route::Resource('survey', 'SurveyController');
Route::Resource('question', 'QuestionController');