<?php

//Register verification
Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');
//Social login google
Route::get('/auth/google', 'Auth\GoogleController@redirectToProvider');
Route::get('/auth/google/callback', 'Auth\GoogleController@handleProviderCallback');
//Social login facebook
Route::get('/auth/facebook', 'Auth\FacebookController@redirectToProvider');
Route::get('/auth/facebook/callback', 'Auth\FacebookController@handleProviderCallback');
//Social login twitter
Route::get('/auth/twitter', 'Auth\TwitterController@redirectToProvider');
Route::get('/auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback');

Auth::routes();

Route::group(['middleware' => 'admin'], function () {
	//Admin Dashboard
  	Route::get('/admin/dashboard', 'DashboardController@index');
  //Admin Menu
  	Route::post('/admin/tambah-menu', 'MenuController@store');
  	Route::get('/admin/menu', 'MenuController@index');
  	Route::post('/admin/menu/{id}/update', 'MenuController@update');
  	Route::get('/admin/menu/{id}/destroy', 'MenuController@destroy');
  //Admin Product
    Route::get('/admin/product', 'ProductController@index');
    Route::get('/admin/product/create', 'ProductController@create');
    Route::post('/admin/product/store', 'ProductController@store');
    Route::get('/admin/product/{id}/edit', 'ProductController@edit');
    Route::post('/admin/product/{id}/update', 'ProductController@update');
    Route::get('/admin/product/{id}/destroy', 'ProductController@destroy');
    Route::post('/admin/product/{id}/status', 'ProductController@status');
    Route::post('/admin/product/{id}/comment-status', 'ProductController@commentStatus');
  //Admin Picture
    Route::get('/admin/picture/{id}/destroy', 'PictureController@destroy');
  //Admin Logo
    Route::get('/admin/logo', 'LogoController@index');
    Route::post('/admin/logo/store', 'LogoController@store');
    Route::post('/admin/logo/{id}/updateImg', 'LogoController@updateImg');
    Route::post('/admin/logo/{id}/updateDesc', 'LogoController@updateDesc');
  //Admin Promo
    Route::get('/admin/promo', 'PromoController@index');
    Route::post('/admin/promo/store', 'PromoController@store');
    Route::get('/admin/promo/{id}/edit', 'PromoController@edit');
    Route::post('/admin/promo/{id}/update', 'PromoController@update');
    Route::post('/admin/promo/{id}/status', 'PromoController@status');
    Route::get('/admin/promo/{id}/preview', 'PromoController@preview');
  //Admin Follow
    Route::get('/admin/follow', 'FollowController@index');
    Route::post('/admin/follow/store', 'FollowController@store');
    Route::get('/admin/follow/{id}/destroy', 'FollowController@destroy');
  //Admin Share
    Route::get('/admin/share', 'ShareController@index');
    Route::post('/admin/share/store', 'ShareController@store');
    Route::get('/admin/share/{id}/destroy', 'ShareController@destroy');
  //Admin Emoji
    Route::get('/admin/emoji', 'EmoticonController@index');
    Route::post('/admin/emoji/store', 'EmoticonController@store');
    Route::get('/admin/emoji/{id}/destroy', 'EmoticonController@destroy');
  //Admin Contact
    Route::get('/admin/inbox', 'InboxController@index');
    Route::get('/admin/inbox/{id}/destroy', 'InboxController@destroy');
  //Admin Users
    Route::get('/admin/users', 'UserController@index');
    Route::get('/admin/user/{id}/status', 'UserController@status');
    Route::get('/admin/user/{id}/banned', 'UserController@banned');
  //Admin Forum
    Route::get('/admin/forum', 'ForumController@index');
    Route::post('/admin/forum/tambah-kotegori', 'ForumController@tambahKategori');
    Route::post('/admin/forum/category/{id}/update', 'ForumController@editKategori');
    Route::get('/admin/forum/category/{id}/destroy', 'ForumController@destroy');
  //Admin Threads
    Route::get('/admin/threads', 'ForumController@threads');
    Route::post('/admin/thread/{id}/status', 'ForumController@threadStatus');
    Route::get('/admin/thread/{id}/destroy', 'ForumController@threadDestroy');
  //Admin Statistic
    Route::get('/admin/statistic', 'StatisticController@index');
    Route::get('/statistics-period', 'StatisticController@statistics');
  //File Manager
    Route::get('/admin/filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/admin/filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
});
// Home
Route::get('/', 'HomeController@index');
//User
Route::get('/user/{slug}', 'UserController@show');
//User Auth Forum
Route::group(['middleware' => 'auth'], function () {
  Route::get('/user/forum/create', 'ForumController@create');
  Route::post('/user/forum/store', 'ForumController@store');
  Route::get('/user/forum/{id}/edit', 'ForumController@edit');
  Route::post('/user/forum/{id}/update', 'ForumController@update');
  Route::post('/user/edit/{id}/profil', 'UserController@editProfil');
});
//Forum
Route::get('/all/{menu}', 'ForumController@menu');
Route::get('/category/{menu}','ForumController@kategori');
Route::get('/category/{menuSlug}/{forumSlug}','ForumController@show');
// User Product Show
Route::get('/{url}','GlobalController@menu');
Route::get('/{menu}/read/{slug?}',['uses' =>'ProductController@show'], function ($menu, $slug) {});
//Product Comment
Route::post('/comment/{id}/product', 'CommentController@product');
Route::post('/comment/{id}/product/update', 'CommentController@productUpdate');
//Forum Comment
Route::post('/comment/{id}/thread', 'CommentController@forum');
Route::post('/comment/{id}/thread/update', 'CommentController@forumUpdate');
//Product Vote Emoticon
Route::get('/product-like/{lid}/product/{pid}', 'LikeController@productlike');
Route::get('/thread-like/{lid}/thread/{fid}', 'LikeController@threadlike');
//Comment Like
Route::post('/comment-like/{id}', 'LikeController@commentlike');
//Melihat user yang like
Route::get('/comment/{id}/get-user-like', 'LikeController@getUserLike');
//Melihat User Vote
Route::get('/emoji/{mid}/get/{pid}/product-users-vote', 'LikeController@getUserProductVote');
Route::get('/emoji/{mid}/get/{pid}/thread-users-vote', 'LikeController@getUserThreadVote');
// Contact
Route::post('/contact/store', 'InboxController@store');
