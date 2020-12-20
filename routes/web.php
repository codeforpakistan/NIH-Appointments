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

use App\Http\Controllers\HomeController;

Route::get('/', 'HomeController@index')->name('home');
Route::get('settings', 'HomeController@settings')->name('settings');

Auth::routes();

Route::resource('user', 'UserController');
Route::resource('appointments', 'AppointmentController');
