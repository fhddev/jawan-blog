<?php

use Jawan\Core\Routing\{Router, Route};

Router::attach([
	
	Route::get('/', 'HomeController@index')->name('home')

]);

