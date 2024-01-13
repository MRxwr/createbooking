<?php
/**
 * CODEPRESS CMS - The Best CMS for Laravel Project
 *
 * @package sanjoo83/laravel-cms
 * @author  The Anh Dang <sbhadra0@gmail.com>
 * @link https://hatcodes.com/cms
 * @license MIT
 */

Route::group(['prefix' => 'file-manager'], function () {
    Route::get('/', 'FileManager\FileManagerController@index');

    Route::get('/errors', 'FileManager\FileManagerController@getErrors');

    Route::any('/upload', 'FileManager\UploadController@upload')->name('filemanager.upload');

    Route::get('/jsonitems', 'FileManager\ItemsController@getItems');

    /*Route::get('/move', 'ItemsController@move');

    Route::get('/domove', 'ItemsController@domove');*/

    Route::post('/newfolder', 'FileManager\FolderController@addfolder');

    Route::get('/folders', 'FileManager\FolderController@getFolders');

    /*Route::get('/rename', 'RenameController@getRename');

    Route::get('/download', 'DownloadController@getDownload');*/

    Route::post('/delete', 'FileManager\DeleteController@delete');
});
