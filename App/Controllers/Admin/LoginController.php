<?php
namespace App\Controllers\Admin;

class LoginController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function index()
	{
		// show login form
		return "login page";
	}

	public function login()
	{
		// login form submit
	}

	protected function checkAuthorization() {
		//
	}

}