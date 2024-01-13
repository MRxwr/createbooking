<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:cache');
    return 'DONE'; //Return anything
});
Route::get('/storage-link', function() {
       Artisan::call('storage:link');
    return 'DONE'; //Return anything
});

require __DIR__ . '/installer.php';

Route::group(['middleware' => 'guest',], function () {
    Route::get('login', 'Auth\LoginController@index')->name('login');
    Route::get('register', 'Auth\RegisterController@index')->name('register');
    Route::get('forgot-password', 'Auth\ForgotPasswordController@index')->name('forgot_password');
    Route::get('reset-password', 'Auth\ForgotPasswordController@index')->name('reset_password');

    Route::get('verification/{email}/{token}', 'Auth\VerificationController@verification')->name('verification');
    Route::get('reset-password', 'Auth\ResetPasswordController@index');

    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('forgot-password', 'Auth\ForgotPasswordController@forgotPassword');
    Route::post('reset-password', 'Auth\ResetPasswordController@resetPassword');
});

Route::group(['prefix' => 'user', 'middleware' => 'guest',], function () {
    Route::get('login', 'Auth\LoginController@index')->name('user.login');
    Route::get('register', 'Auth\RegisterController@index')->name('user.register');
    Route::get('forgot-password', 'Auth\ForgotPasswordController@index')->name('user.forgot_password');
    Route::get('reset-password', 'Auth\ResetPasswordController@index')->name('user.reset_password');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function () {
    Route::get('notification', 'Frontend\ProfileController@notification')->name('profile.notification');
    Route::get('change-password', 'Frontend\ProfileController@changePassword')->name('profile.change_password');
    Route::post('change-password', 'Frontend\ProfileController@doChangePassword');
    Route::get('/{slug?}', 'Frontend\ProfileController@index')->name('profile');
});

Route::match(['get', 'post'], 'ajax/{slug}', 'Frontend\AjaxController@ajax')->name('ajax');

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::post('/payment', 'Frontend\PaymentController@index')->name('payment');
Route::get('/payment/success', 'Frontend\PaymentController@getSuccess')->name('payment.success');
Route::get('/payment/failed', 'Frontend\PaymentController@getFailed')->name('payment.failed');

Route::match(['get', 'post'], 'search', 'Frontend\SearchController@index')->name('search');
Route::match(['get', 'post'], 'search/ajax', 'Frontend\SearchController@ajaxSearch')->name('ajax.search');
Route::post('{base}/{slug}', 'Frontend\PostController@comment')->name('comment');

  
Route::get('{slug?}', 'Frontend\RouteController@index')->where('slug', '.*');
Route::post('{slug?}', 'Frontend\RouteController@index')->where('slug', '.*');
//Route::get('{slug?}', 'Frontend\RouteController@index')->where('slug', '.*');
