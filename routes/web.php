<?php


Auth::routes(['verify' => true]);
Route::get('/', 'WallFeedsController@index')->name("home");
Route::post('/', 'WallFeedsController@store');
Route::delete('/{wallFeed}/delete', 'WallFeedsController@delete')->name("post.delete");
Route::get('/all-users', 'UserController@allUsers')->name("all-users");
Route::get('/check', 'UserController@userOnlineStatus');
Route::get('/following', 'FollowerController@followingTo')->name('following');
Route::get('/followers', 'FollowerController@followers')->name('followers');
Route::get('/friends' , 'FriendController@myFriends')->name("friends");
Route::get('/gallery', 'GalleryController@index')->name("gallery");
Route::post('/gallery', 'GalleryController@store')->name("gallery.create");
Route::get('/gallery/album/photo/{album}', 'AlbumController@show')->name("album.show");
Route::delete('/gallery/album/photo/{album}', 'AlbumController@delete')->name("album.delete");
Route::get('/gallery/album/{gallery}', 'AlbumController@index')->name("album.index");
Route::post('/gallery/album/{gallery}', 'AlbumController@create')->name("album.create");
Route::delete('/gallery/{id}', 'GalleryController@delete')->name("gallery.delete");

Route::get("/messages", "Messages\MessagesController")->name("messages");
Route::post("/message/{id}", "Messages\MessageSendController")->name("message.send");


Route::get('/my-profile', 'UserController@show')->name('profile.edit');
Route::put('/my-profile', 'UserController@update')->name('profile.update');
Route::post('/{user}' , 'FriendController@getAddFriend')->name("friend.add");
Route::put('/{user}' , 'FriendController@getAcceptFriend')->name("friend.accept");
Route::delete('/{user}' , 'FriendController@getUnfriend')->name("friend.remove");
Route::get('/{user}', 'UserController@OtherUserProfileView')->name("profile");
Route::post('/{user}/follow' , 'FollowerController@follow')->name("follow");
Route::get('/{user}/friends', 'FriendController@friends')->name("user.friends");
Route::get('/{user}/gallery', 'GalleryController@gallery')->name("user.gallery");
Route::get('/{user}/photo/{album}', 'AlbumController@photo')->name("user.photo");
Route::delete('/{user}/unfollow' , 'FollowerController@unfollow')->name("unfollow");
Route::get('/{user}/{gallery}', 'AlbumController@album')->name("user.album");
Route::post('/post/{wallFeed}', 'LikeController@likePost')->name("like.post");
Route::delete('/post/{wallFeed}', 'LikeController@unlikePost')->name("unlike.post");
Route::post('/photo/{album}', 'LikeController@likePhoto')->name("like.photo");
Route::delete('/photo/{album}', 'LikeController@unlikePhoto')->name("unlike.photo");







