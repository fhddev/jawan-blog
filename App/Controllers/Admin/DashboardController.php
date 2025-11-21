<?php
namespace App\Controllers\Admin;

class DashboardController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function index()
	{
		// show dashboard page
		return "dashboard page";
	}

}