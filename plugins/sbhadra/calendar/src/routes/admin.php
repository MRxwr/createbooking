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
Route::get('employee-calendar','CalendarController@employee')->name('admin.employee-calendar');
Route::get('booking-calendar','CalendarController@index')->name('admin.booking-calendar');
Route::get('calendar/delete/{id}','CalendarController@delete')->name('admin.calendar.delete');
Route::post('save/calendar-date','CalendarController@dateSave')->name('admin.calendar-date');
Route::get('calendar-setting','CalendarController@setting')->name('admin.calendar-setting');
Route::post('save/calendar-setting','CalendarController@settingSave')->name('admin.calendar-setting');
Route::get('get-booking-json','AjaxController@getBookingJson')->name('admin.booking-json');
Route::get('get-employee-booking-json','AjaxController@getEmployeeBookingJson')->name('admin.employee-json');
