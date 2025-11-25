<?php
namespace App\Controllers\Admin;

use App\Models\User;

class LoginController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function login()
	{
		return $this->app->loader->view('admin::login_form', ['model'=>new User()]);
	}

	public function login_submit()
	{
		$user = User::from_array($this->app->input->post());

		$errors = $this->validate($this->app->input->post());

		if( count($errors) > 0 )
		{
			return $this->app->loader->view('admin::login', [
				'errors' => $errors,
				'model' => $user
			]);
		}

		$result = $this->app->db
			->getConnection()
			->query("select * from users where email = '$user->email'")
			->fetchObject();

		if( ! $result || ! password_verify($user->password_hash, $result->password_hash) || ! in_array($result->role, ['admin', 'author']) )
			return $this->app->loader->view('admin::login_form', ['errors'=>['Invalid Credentials']]);

		$this->app->session->attach('user', $result);
		$this->app->session->attach('role', $result->role);

		$this->redirect('http://127.0.0.1:8000/admin/dashboard');
	}

	protected function checkAuthorization()
	{
		//
	}

	protected function validate($data)
	{
		$errors = [];

		if( empty($this->app->input->post('email')) ) $errors[] = 'Validation error';
		if( empty($this->app->input->post('password_hash')) ) $errors[] = 'Validation error';

		return $errors;
	}

}