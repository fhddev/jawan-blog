<?php
namespace App\Controllers\Admin;

use App\Models\User;

class LogoutController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function index()
	{
		$this->app->session->destroy();
		
		$this->redirect('http://127.0.0.1:8000/admin/login');
	}

	protected function checkAuthorization()
	{
		//
	}

}