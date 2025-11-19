<?php


require __DIR__.'/../vendor/autoload.php';

// ----------------------------------------------------------------

define('JAWAN_FW_VENDOR_NAME', 'fhddev');
define('JAWAN_FW_VENDOR_PACKAGE_NAME', 'jawan-framework');

// ----------------------------------------------------------------


/**
* 1 => development
* 2 => production
* 3 => testing
*
*/
define ('ENV', 1);


switch (ENV)
{
	case 1:
		error_reporting(E_ALL);
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
	break;
	case 2:
	case 3:
		error_reporting(E_ALL);
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 0);
	break;
}

// Root path to set it in FileSystem object.
define('ROOT', dirname(realpath(dirname(__FILE__))));


// ----------------------------------------------------------------


// require ROOT.str_replace(['/','\\'], DIRECTORY_SEPARATOR, '\vendor\Jawan\Core\FileSystem.php' );

$file = new Jawan\Core\FileSystem(ROOT);


// ----------------------------------------------------------------


// $file->frequire( $file->path('Jawan\Core\App') );

$app = Jawan\Core\App::getInstance($file);

$app->run();


// ----------------------------------------------------------------

// Happy Coding @*_-@ 