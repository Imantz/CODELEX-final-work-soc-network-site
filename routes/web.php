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

Route::get('/', 'HomeController@index')->name('authUser');
Route::post('/', 'WallFeedsController@create');
Route::get('/authUser', 'HomeController@index')->name('authUser');
Route::get('/check', 'UserController@userOnlineStatus');
Route::get('/all-users', 'ProfileController@allUsers')->name("all-users");

Route::get('/my-profile', 'HomeController@show')->name('my-profile');
Route::put('/my-profile', 'ProfileController@updateMyProfile')->name('my-profile');

Route::get('/my-friends' , 'FriendController@myFriends')->name("friends");
Route::get('/profile/{id}-{name}-{surname}', 'ProfileController@profile')->name("profile");
Route::get('/profile/{id}-{name}-{surname}/add' , 'FriendController@getAddFriend')->name("friend.add");
Route::get('/my-friends/{id}-{name}-{surname}/remove' , 'FriendController@getUnfriend')->name("friend.remove");
Route::get('/my-friends/{id}-{name}-{surname}/accept' , 'FriendController@getAcceptFriend')->name("friend.accept");






