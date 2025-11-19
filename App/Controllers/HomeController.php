<?php
namespace App\Controllers;

use Jawan\Core\MVC\JF_Controller;

class HomeController extends JF_Controller {
	
	public function index()
	{
		return $this->app->loader->view('home::index');
	}

}