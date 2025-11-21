<?php

use Jawan\Core\Routing\{Router, Route};

Router::attach([
	
	//** Public website **//

	Route::get('/', 'HomeController@index')->name('home'),

	//** Admin dashboard **//

	Route::get('/admin/login', 'Admin\LoginController@index')->name('login_form'),
	Route::post('/admin/login', 'Admin\LoginController@login')->name('login_form_submit'),

	Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin_dashboard'),
	
]);

