<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function (){
    return redirect('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','AdminController@index')->name('admin');

Route::prefix('admin')->group(function (){
    Route::get('/', 'AdminController@index')->name('admin_index');
});

Route::prefix('category')->group(function (){
    Route::get('/', 'CategoryController@index')->name('category');
    Route::post('/', 'CategoryController@create')->name('create');
    Route::get('/{id}', 'CategoryController@edit')->name('edit');
    Route::put('/{id}', 'CategoryController@update')->name('update');
    Route::get('/delete/{id}', 'CategoryController@destroy')->name('destroy');
});

Route::prefix('platform')->group(function (){
    Route::get('/', 'PlatformController@index')->name('platform');
    Route::post('/', 'PlatformController@create')->name('create');
    Route::get('/{id}', 'PlatformController@edit')->name('edit');
    Route::put('/{id}', 'PlatformController@update')->name('update');
    Route::get('/delete/{id}', 'PlatformController@destroy')->name('destroy');
});

// Route::post('file/upload', 'FileController@store')->name('file.upload');
Route::post('upload', 'FileController@upload')->name('upload');

Auth::routes();

