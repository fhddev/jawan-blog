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
	Route::get('/admin/posts/edit', 'Admin/PostController@edit'),
	Route::post('/admin/posts/edit_submit', 'Admin/PostController@edit_submit'),
	Route::get('/admin/posts/delete_confirmation', 'Admin/PostController@delete_confirmation'),
	Route::post('/admin/posts/destroy', 'Admin/PostController@destroy')
	
]);

