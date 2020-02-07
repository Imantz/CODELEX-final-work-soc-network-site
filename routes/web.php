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
Route::POST('/', 'WallFeedsController@create');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/check', 'UserController@userOnlineStatus');
Route::get('/my-profile', 'HomeController@show')->name('my-profile');
Route::put('/my-profile', 'ProfileController@updateMyProfile')->name('my-profile');
Route::get('/my-friends' , 'FriendController@myFriends')->name("friends");
Route::get('/my-friends/add/{username}' , 'FriendController@getAddFriend')->name("friend.add");
Route::get('/my-friends/accept/{username}' , 'FriendController@getAcceptFriend')->name("friend.accept");
Route::get('/my-friends' , 'FriendController@myFriends')->name("friends");
Route::get('/all-users', 'ProfileController@allUsers')->name("all-users");

Route::get('/profile/{user}', 'ProfileController@profile');
Route::get('/profile/{user}/add', 'ProfileController@addFriend');



