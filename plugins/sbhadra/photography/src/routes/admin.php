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

Route::postTypeResource('packages', 'PackageController');
Route::Resource('services', 'ServiceController');
Route::Resource('branches', 'BranchController');
Route::Resource('timeslots', 'TimeslotController');
Route::get('/setting/booking', 'SettingsController@index')->name('admin.setting.get');
Route::post('/setting/booking', 'SettingsController@save')->name('admin.setting.post');
Route::get('/bookings/details/{id}', 'BookingController@getBookingDetails')->name('admin.bookings.view');
Route::get('/bookings/add-new/{id}', 'BookingController@addNewBooking')->name('admin.bookings.addnew');
Route::post('/bookings/cancel', 'BookingController@getBookingCancel')->name('admin.bookings.cancel');
Route::post('/bookings/refund', 'BookingController@getBookingRefund')->name('admin.bookings.refund');
Route::post('/bookings/complete', 'BookingController@getBookingComplete')->name('admin.bookings.complete');
Route::post('/bookings/send-sms', 'BookingController@getBookingSendSMS')->name('admin.bookings.sendsms');
Route::post('/bookings/send-survey-sms', 'BookingController@getBookingSurveySendSMS')->name('admin.bookings.surveysms');
Route::post('/bookings/change-theme', 'BookingController@changeBookingTheme')->name('admin.change.theme');
Route::post('/bookings/add-notes', 'BookingController@AddBookingNote')->name('admin.add.notes');
Route::post('/bookings/add-employee', 'BookingController@AddBookingEmployee')->name('admin.add.employee');
Route::get('/success-bookings', 'SuccessBookingController@index')->name('admin.success.booking');
Route::get('/cancel-bookings', 'CancelBookingController@index')->name('admin.cancel.booking');
Route::get('/complete-bookings', 'CompletedBookingController@index')->name('admin.complete.booking');
Route::Resource('bookings', 'BookingController');
