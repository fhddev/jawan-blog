<?php

return [

	'class' => [
		'request' => 'Jawan\Core\Http\Request\Request',
		'user_agent' => 'Jawan\Core\Http\Request\UserAgent',
		'uri' => 'Jawan\Core\Http\Request\URI',
		'input' => 'Jawan\Core\Http\Request\Input',
		'router' => 'Jawan\Core\Routing\Router',
		'loader' => 'Jawan\Core\Routing\RouteLoader',
		'response' => 'Jawan\Core\Http\Response\Response',
		'config' => 'Jawan\Core\Configuration',
		'lang' => 'Jawan\Core\Language',
		'locale' => 'Jawan\Core\Locale\LocaleDispatcher',
		'db' => 'Jawan\Core\Data\Database\Database',
		'auth' => 'Jawan\Core\Securty\UserAuthentication',
	],

	
	
	'factory' => [
	],

	
	
	
];