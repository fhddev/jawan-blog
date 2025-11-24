<?php
namespace App\Controllers\Admin;

class LoginController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function login()
	{
		// show login form
		return "login page";
	}

	public function login_submit()
	{
		// login form submit
	}

	protected function checkAuthorization()
	{
		//
	}

}