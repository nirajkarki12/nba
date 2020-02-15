<?php

// Backend
Route::group(['prefix' => 'admin'], function(){

	Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
  Route::post('login', 'Auth\LoginController@login')->name('admin.login.post');

	Route::get('/', 'AdminController@index')->name('admin.dashboard');

	Route::get('profile', 'AdminController@profile')->name('admin.profile');
	Route::post('/profile/save', 'AdminController@profileSave')->name('admin.profile.save');
	Route::post('/change/password', 'AdminController@changePassword')->name('admin.change.password');
	Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');
	// Video
	Route::group(['prefix' => 'video'], function(){
		// list
		Route::get('/', 'VideoController@index')->name('admin.video');
		// Create
		Route::get('/create', 'VideoController@create')->name('admin.video.create');
		Route::post('/store', 'VideoController@store')->name('admin.video.store');
		// Update
		Route::get('/edit/{id}', 'VideoController@edit')->name('admin.video.edit');
		Route::post('/edit/{id}', 'VideoController@update')->name('admin.video.update');
		// Delete
		Route::get('/delete/{id}', 'VideoController@destroy')->name('admin.video.delete');

	});

	// Notice
	Route::group(['prefix' => 'notice'], function(){
		// list
		Route::get('/', 'NoticeController@index')->name('admin.notice');
		// Create
		Route::get('/create', 'NoticeController@create')->name('admin.notice.create');
		Route::post('/store', 'NoticeController@store')->name('admin.notice.store');
		// Update
		Route::get('/edit/{id}', 'NoticeController@edit')->name('admin.notice.edit');
		Route::post('/edit/{id}', 'NoticeController@update')->name('admin.notice.update');
		// Delete
		Route::get('/delete/{id}', 'NoticeController@destroy')->name('admin.notice.delete');

	});

	// Service
	Route::group(['prefix' => 'service'], function(){
		// list
		Route::get('/', 'ServiceController@index')->name('admin.service');
		// Create
		Route::get('/create', 'ServiceController@create')->name('admin.service.create');
		Route::post('/store', 'ServiceController@store')->name('admin.service.store');
		// Update
		Route::get('/edit/{id}', 'ServiceController@edit')->name('admin.service.edit');
		Route::post('/edit/{id}', 'ServiceController@update')->name('admin.service.update');
		// Delete
		Route::get('/delete/{id}', 'ServiceController@destroy')->name('admin.service.delete');

	});


});
// FrontEnd
Route::get('/', 'FrontController@index')->name('home');
Route::get('/get-videos', 'FrontController@getVideos')->name('get.videos');
Route::post('/service-detail', 'FrontController@serviceDetail')->name('service.detail');


