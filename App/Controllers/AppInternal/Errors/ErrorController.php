<?php
namespace App\Controllers\AppInternal\Errors;

use Jawan\Core\MVC\JF_Controller;
use Jawan\Core\App;

class ErrorController extends JF_Controller {
	
	public function show404Error()
	{
		return App::getInstance()->loader->view('errors::e404');
	}
	
}