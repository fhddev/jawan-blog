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

	Route::get('/admin/dashboard', 'Admin\DashboardController@index'),
	
]);

