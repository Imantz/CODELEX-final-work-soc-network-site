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
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('authUser');
Route::post('/', 'WallFeedsController@create');

Route::get('/authUser', 'HomeController@index')->name('authUser');
Route::get('/check', 'UserController@userOnlineStatus');
Route::get('/all-users', 'ProfileController@allUsers')->name("all-users");
Route::get('/my-profile', 'HomeController@show')->name('my-profile');
Route::put('/my-profile', 'ProfileController@updateMyProfile')->name('my-profile');
Route::get('/following', 'FollowerController@followingTo')->name('following');
Route::get('/followers', 'FollowerController@followers')->name('followers');
Route::get('/friends' , 'FriendController@myFriends')->name("friends");

Route::get('/gallery', 'GalleryController@index')->name("gallery");
Route::post('/gallery', 'GalleryController@create')->name("gallery.create");

Route::get('/gallery/album/{gallery}', 'AlbumController@show')->name("album.show");
Route::post('/gallery/album/{gallery}', 'AlbumController@create')->name("album.create");

//TODO put/ delete / post
Route::get('/{user}', 'ProfileController@profile')->name("profile");
Route::get('/{user}/add' , 'FriendController@getAddFriend')->name("friend.add");
Route::get('/{user}/remove' , 'FriendController@getUnfriend')->name("friend.remove");
Route::get('/{user}/accept' , 'FriendController@getAcceptFriend')->name("friend.accept");

Route::post('/{user}/follow' , 'FollowerController@follow')->name("follow");
Route::delete('/{user}/unfollow' , 'FollowerController@unfollow')->name("unfollow");








