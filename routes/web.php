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




Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'WallFeedsController@index');
Route::post('/', 'WallFeedsController@store');

Route::get('/check', 'UserController@userOnlineStatus');

Route::get('/all-users', 'UserController@allUsers')->name("all-users");

Route::get('/my-profile', 'UserController@show')->name('profile.edit');
Route::put('/my-profile', 'UserController@update')->name('profile.update');

Route::get('/following', 'FollowerController@followingTo')->name('following');
Route::get('/followers', 'FollowerController@followers')->name('followers');
Route::get('/friends' , 'FriendController@myFriends')->name("friends");

Route::get('/gallery', 'GalleryController@index')->name("gallery");
Route::post('/gallery', 'GalleryController@store')->name("gallery.create");

Route::get('/gallery/album/{gallery}', 'AlbumController@index')->name("album.index");
Route::post('/gallery/album/{gallery}', 'AlbumController@create')->name("album.create");
Route::get('/gallery/album/photo/{album}', 'AlbumController@show')->name("album.show");


//TODO put/ delete / post
Route::get('/{user}', 'UserController@profile')->name("profile");
Route::post('/{user}' , 'FriendController@getAddFriend')->name("friend.add");
Route::delete('/{user}' , 'FriendController@getUnfriend')->name("friend.remove");
Route::put('/{user}' , 'FriendController@getAcceptFriend')->name("friend.accept");

Route::post('/{user}/follow' , 'FollowerController@follow')->name("follow");
Route::delete('/{user}/unfollow' , 'FollowerController@unfollow')->name("unfollow");
