<?php
namespace App\Controllers\Admin;

use Jawan\Core\MVC\JF_Controller;

abstract class ControllerBase extends JF_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->checkAuthorization();
    }

	protected function checkAuthorization() {
		$this->authorize(['admin', 'author']);
	}

	protected function authenticated()
	{
		if( $this->app->auth->getRole() === 'guest' )
			$this->redirect("http://127.0.0.1:8000/admin/login");
	}

	protected function authorize($roles)
	{
		$this->authenticated();

		if( ! in_array($this->app->auth->getRole(), $roles) )
			$this->accessDenied();
	}

	protected function accessDenied()
	{
		$this->app->response->setOutput($this->app->loader->view('errors::access_denied'));
		$this->app->response->send();
	}

	protected function notFound()
	{
		return $this->app->getInstance()->loader->view('errors::e404');
	}

	protected function redirect($uri) {
		header("Location: $uri");
    	exit();
	}

}