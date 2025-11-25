<?php
namespace App\Controllers\Admin;

use \PDO;
use App\Models\User;

class InstallController extends ControllerBase {
	
	public function __construct()
	{
		parent::__construct();
	
		$this->deny_if_installed();
    }

	public function install()
	{
		return $this->app->loader->view('admin::install', ['model'=>new User()]);
	}

	public function install_submit()
	{
		$user = User::from_array($this->app->input->post());

		$errors = $this->validate($this->app->input->post());

		if( count($errors) > 0 )
		{
			return $this->app->loader->view('admin::install', [
				'errors' => $errors,
				'model' => $user
			]);
		}

		$user->picture_path = $this->upload_picture('picture_path');
		$user->created_at = date("Y-m-d H:i:s");

		$this->app->db
			->set([
				'username' => $user->username,
				'full_name' => $user->full_name,
				'picture_path' => $user->picture_path,
				'job_title' => $user->job_title,
				'bio' => $user->bio,
				'facebook_link' => $user->facebook_link,
				'x_link' => $user->x_link,
				'github_link' => $user->github_link,
				'website_link' => $user->website_link,
				'created_at' => $user->created_at
			])
			->insert('users');

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

	protected function validate($data, $create = true)
	{
		$errors = [];

		if( empty($this->app->input->post('username')) ) $errors[] = 'Username is required';
		if( empty($this->app->input->post('full_name')) ) $errors[] = 'Full Name is required';
		if( empty($this->app->input->post('job_title')) ) $errors[] = 'Job Title is required';
		if( empty($this->app->input->post('bio')) ) $errors[] = 'Bio is required';
		if( empty($this->app->input->post('facebook_link')) ) $errors[] = 'Facebook Link is required';
		if( empty($this->app->input->post('x_link')) ) $errors[] = 'X Link is required';
		if( empty($this->app->input->post('github_link')) ) $errors[] = 'Github Link is required';
		if( empty($this->app->input->post('website_link')) ) $errors[] = 'Website Link is required';

		/**
		 * 
		 * Validate uploaded picture
		 * 
		 */

		$field_name = 'picture_path';

		if( $create && empty($_FILES[$field_name]) )
		{
			$errors[] = 'Picture is required';
		}
		else if( ! empty($_FILES[$field_name]) )
		{
			$file = $_FILES[$field_name];

			$allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
			$maxSize = 2 * 1024 * 1024; // 2 MB

			$fileName = basename($file['name']);
			$fileSize = $file['size'];
			$fileTmp  = $file['tmp_name'];
			$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

			if ( ! in_array($fileExt, $allowedTypes) )
			{
				$errors[] = "Invalid file type. Allowed: " . implode(", ", $allowedTypes);
			}

			if ( $fileSize > $maxSize )
			{
				$errors[] = "File too large. Max size is 2MB.";
			}

			if ( $file['error'] !== UPLOAD_ERR_OK )
			{
				$errors[] = "Upload error code: " . $file['error'];
			}
		}

		return $errors;
	}

	protected function upload_picture($field_name)
	{
		$targetDir = ROOT . "/webroot/images/pictures/";

		if ( ! is_dir($targetDir) )
			mkdir($targetDir, 0777, true);

		$file = $_FILES[$field_name];
		
		$fileTmp  = $file['tmp_name'];
		$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		$newName = uniqid("picture_", true) . "." . $fileExt;
		$targetFile = $targetDir . $newName;

		return move_uploaded_file($fileTmp, $targetFile)
			? "images/pictures/$newName"
			: '';
	}

}