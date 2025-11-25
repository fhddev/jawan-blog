<?php
namespace App\Controllers\Admin;

class DashboardController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function index()
	{
		return $this->app->loader->view('admin::dashboard', [
			'posts_count' => $this->app->db->getConnection()->query("select count(post_id) as total from posts")->fetchObject()->total,
			'users_count' => $this->app->db->getConnection()->query("select count(user_id) as total from users")->fetchObject()->total
		]);
	}

}