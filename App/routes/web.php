<?php

use Jawan\Core\Routing\{Router, Route};

Router::attach([
	
	//** Public website **//

	Route::get('/', 'HomeController@index')->name('home'),

	//** Admin dashboard **//
	
	Route::get('/admin/install', 'Admin\InstallController@install'),
	Route::post('/admin/install_submit', 'Admin\InstallController@install_submit'),

	Route::get('/admin/login', 'Admin\LoginController@login'),
	Route::post('/admin/login_submit', 'Admin\LoginController@login_submit'),

	Route::get('/admin/logout', 'Admin\LogoutController@index'),

	Route::get('/admin/dashboard', 'Admin\DashboardController@index'),

	Route::get('/admin/posts', 'Admin/PostController@index'),
	Route::get('/admin/posts/create', 'Admin/PostController@create'),
	Route::post('/admin/posts/create_submit', 'Admin/PostController@create_submit'),
	Route::get('/admin/posts/details/id', 'Admin/PostController@details|id')->where(['id'=>'(\d+)']),
	Route::get('/admin/posts/edit/id', 'Admin/PostController@edit|id')->where(['id'=>'(\d+)']),
	Route::post('/admin/posts/edit_submit/id', 'Admin/PostController@edit_submit|id')->where(['id'=>'(\d+)']),
	Route::get('/admin/posts/delete_confirmation/id', 'Admin/PostController@delete_confirmation|id')->where(['id'=>'(\d+)']),
	Route::post('/admin/posts/destroy/id', 'Admin/PostController@destroy|id')->where(['id'=>'(\d+)'])
	
]);

