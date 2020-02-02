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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/my-profile', 'HomeController@show')->name('my-profile');
Route::put('/my-profile', 'ProfileController@updateMyProfile')->name('my-profile');

Route::get('/profile/{user}', 'ProfileController@profile');
