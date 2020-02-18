<?php






Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/', 'WallFeedsController@index');
Route::post('/', 'WallFeedsController@store');
Route::get('/friends' , 'FriendController@myFriends')->name("friends");
Route::get('/check', 'UserController@userOnlineStatus');
Route::get('/all-users', 'UserController@allUsers')->name("all-users");
Route::get('/my-profile', 'UserController@show')->name('profile.edit');
Route::put('/my-profile', 'UserController@update')->name('profile.update');

Route::get('/following', 'FollowerController@followingTo')->name('following');
Route::get('/followers', 'FollowerController@followers')->name('followers');

Route::get('/gallery', 'GalleryController@index')->name("gallery");
Route::post('/gallery', 'GalleryController@store')->name("gallery.create");
Route::delete('/gallery/{id}', 'GalleryController@delete')->name("gallery.delete");

Route::get('/gallery/album/{gallery}', 'AlbumController@index')->name("album.index");
Route::post('/gallery/album/{gallery}', 'AlbumController@create')->name("album.create");
Route::get('/gallery/album/photo/{album}', 'AlbumController@show')->name("album.show");
Route::delete('/gallery/album/photo/{album}', 'AlbumController@delete')->name("album.delete");

Route::get('/{user}/friends', 'FriendController@friends')->name("user.friends");
Route::post('/{user}' , 'FriendController@getAddFriend')->name("friend.add");
Route::delete('/{user}' , 'FriendController@getUnfriend')->name("friend.remove");
Route::put('/{user}' , 'FriendController@getAcceptFriend')->name("friend.accept");

Route::get('/{user}/gallery', 'GalleryController@gallery')->name("user.gallery");

Route::get('/{user}/photo/{album}', 'AlbumController@photo')->name("user.photo");
Route::get('/{user}/{gallery}', 'AlbumController@album')->name("user.album");

Route::get('/{user}', 'UserController@OtherUserProfileView')->name("profile");

Route::post('/{user}/follow' , 'FollowerController@follow')->name("follow");
Route::delete('/{user}/unfollow' , 'FollowerController@unfollow')->name("unfollow");





