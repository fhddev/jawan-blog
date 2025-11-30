<?php
namespace App\Controllers\Admin;

use \PDO;
use App\Models\User;

class UserController extends ControllerBase {
	
	public function __construct()
	{
		parent::__construct();
    }

	public function index()
	{
		$rows = $this->app->db->getConnection()->query('select * from users')->fetchAll(PDO::FETCH_CLASS, User::class);

		return $this->app->loader->view('admin::users::index', ['rows' => $rows, 'app'=>$this->app]);
	}

	public function create()
	{
		return $this->app->loader->view('admin::users::create_form', ['model' => new User()]);
	}

	public function create_submit()
	{
		$entity = User::from_array($this->app->input->post());

		$errors = $this->validate($this->app->input->post());

		if( count($errors) > 0 )
		{
			return $this->app->loader->view('admin::users::create_form', [
				'errors' => $errors,
				'model' => $entity
			]);
		}

		$entity->picture_path = $this->upload_picture('picture_path');
		$entity->created_at = date("Y-m-d H:i:s");

		$this->app->db
			->set([
				'role' => $entity->role,
				'username' => $entity->username,
				'email' => $entity->email,
				'password_hash' => password_hash($entity->password_hash, PASSWORD_DEFAULT),
				'full_name' => $entity->full_name,
				'job_title' => $entity->job_title,
				'bio' => $entity->bio,
				'facebook_link' => $entity->facebook_link,
				'x_link' => $entity->x_link,
				'github_link' => $entity->github_link,
				'website_link' => $entity->website_link,
				'picture_path' => $entity->picture_path
			])
			->insert('users');

		$this->app->session->attach('alert', ['type'=>'success', 'alert-message'=>'User created']);

		$this->redirect('http://127.0.0.1:8000/admin/users');
	}

	public function details($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from users where user_id=' . $id)->fetchObject();

		$entity = User::from_array( (array) $entity );

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::users::details', ['model' => $entity]);
	}

	public function edit($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from users where user_id=' . $id)->fetchObject();

		$entity = User::from_array( (array) $entity );

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::users::edit_form', ['model' => $entity]);
	}

	public function edit_submit($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from users where user_id=' . $id)->fetchObject();

		$entity = User::from_array( (array) $entity );
		$newEntity = User::from_array($this->app->input->post());

		if( ! $entity )
			return $this->notFound();

		$errors = $this->validate($this->app->input->post(), false);

		if( count($errors) > 0 )
		{
			return $this->app->loader->view('admin::users::edit_form', [
				'errors' => $errors,
				'model' => $entity
			]);
		}

		if( ! empty($_FILES['picture_path']['name']) )
			$newEntity->picture_path = $this->upload_picture('picture_path');
		else
			$newEntity->picture_path = $entity->picture_path;
		
		$this->app->db
			->set([
				'role' => $newEntity->role,
				'email' => $newEntity->email,
				'full_name' => $newEntity->full_name,
				'job_title' => $newEntity->job_title,
				'bio' => $newEntity->bio,
				'facebook_link' => $newEntity->facebook_link,
				'x_link' => $newEntity->x_link,
				'github_link' => $newEntity->github_link,
				'website_link' => $newEntity->website_link,
				'picture_path' => $newEntity->picture_path
			])
			->where('user_id', $entity->user_id)
			->update('users');

		$this->app->session->attach('alert', ['type'=>'success', 'alert-message'=>'User updated']);

		$this->redirect('http://127.0.0.1:8000/admin/users');
	}

	public function delete_confirmation($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from users where user_id=' . $id)->fetch(PDO::FETCH_ASSOC);

		$entity = User::from_array( $entity );

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::users::delete_confirmation_form', ['model' => $entity]);
	}

	public function destroy($id)
	{
		$entity = User::from_array(
			$this->app->db->getConnection()->query('select * from users where user_id=' . $id)->fetch(PDO::FETCH_ASSOC)
		);

		if( ! $entity )
			return $this->notFound();

		$this->app->db->where('user_id', $entity->user_id)->delete('users');

		$this->app->session->attach('alert', ['type'=>'success', 'alert-message'=>'User deleted']);

		$this->redirect('http://127.0.0.1:8000/admin/users');
	}

	protected function validate($data, $create = true)
	{
		$errors = [];

		if( empty($this->app->input->post('username')) ) $errors[] = 'Username is required';
		if( empty($this->app->input->post('full_name')) ) $errors[] = 'Full Name is required';
		if( empty($this->app->input->post('email')) ) $errors[] = 'Email is required';
		if( !filter_var($this->app->input->post('email'), FILTER_VALIDATE_EMAIL) ) $errors[] = 'Invalid email format';
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

		if ( $create )
		{
			if( empty($this->app->input->post('password_hash')) ) $errors[] = 'Password is required';
			if( strlen($this->app->input->post('password_hash')) < 8 || strlen($this->app->input->post('password_hash')) > 32 ) $errors[] = 'password must be at least 8 characters to 32 characters';
		}

		if( $create && empty($_FILES[$field_name]['name']) )
		{
			$errors[] = 'Picture is required';
		}
		else if( ! empty($_FILES[$field_name]['name']) )
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
		$fileName = basename($file['name']);
		
		$fileTmp  = $file['tmp_name'];
		$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		$newName = uniqid("picture_", true) . "." . $fileExt;
		$targetFile = $targetDir . $newName;

		return move_uploaded_file($fileTmp, $targetFile)
			? "images/pictures/$newName"
			: '';
	}

}