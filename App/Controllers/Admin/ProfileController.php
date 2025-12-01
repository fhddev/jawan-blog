<?php
namespace App\Controllers\Admin;

use \PDO;
use App\Models\User;

class ProfileController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function index()
	{
		$user_data = $this->app->db
			->getConnection()
			->query("select * from users where user_id=".$this->app->session->fetch('user')->user_id)
			->fetch(PDO::FETCH_ASSOC);

		$user = User::from_array($user_data);

		return $this->app->loader->view('admin::profile::index', [
			'user' => $user
		]);
	}

}