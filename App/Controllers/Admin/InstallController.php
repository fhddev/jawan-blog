<?php
namespace App\Controllers\Admin;

use \PDO;

class InstallController extends ControllerBase {
	
	public function __construct()
	{
		parent::__construct();
	
		$this->deny_if_installed();
    }

	public function install()
	{
		return $this->app->loader->view('admin::install');
	}

	public function install_submit()
	{
		$fileName = uniqid("picture_path_", true) . "." . strtolower(pathinfo(basename($_FILES['picture_path']['name']), PATHINFO_EXTENSION));

		$picture_path = ROOT . "/webroot/images/pictures/" . $fileName;

        move_uploaded_file($_FILES['picture_path']['tmp_name'], $picture_path);

		$stmt = $this->app->db->getConnection()->prepare("INSERT INTO users (username, full_name, picture_path, job_title, bio, facebook_link, x_link, github_link, website_link, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
		$stmt->execute([
			$this->app->input->post('username'),
			$this->app->input->post('full_name'),
			$picture_path,
			$this->app->input->post('job_title'),
			$this->app->input->post('bio'),
			$this->app->input->post('facebook_link'),
			$this->app->input->post('x_link'),
			$this->app->input->post('github_link'),
			$this->app->input->post('website_link'),
			date("Y-m-d H:i:s")
		]);

		$this->redirect('http://127.0.0.1:8000/admin/login');
	}

	protected function deny_if_installed()
	{
		$result = $this->app->db
			->query('select count(user_id) as count from users')
			->fetchAll(PDO::FETCH_ASSOC);

		if (count($result) > 0 && $result[0]['count'] > 0)
			return $this->notFound();
	}

	protected function checkAuthorization()
	{
		// disable checking
	}

	protected function validate($data)
	{
		$errors = [];

		if(empty($data['username'])) $errors[] = "Username is required";
		if(empty($data['full_name'])) $errors[] = "Full name is required";
		if(empty($data['picture_url'])) $errors[] = "Full name is required";

		return $errors;
	}

}