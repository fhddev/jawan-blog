<?php
namespace App\Controllers\Admin;

use \PDO;
use App\Models\Post;

class PostController extends ControllerBase {
	
	public function __construct()
	{
		parent::__construct();
    }

	public function index()
	{
		$rows = $this->app->db->getConnection()->query('select * from posts')->fetchAll(PDO::FETCH_CLASS, Post::class);

		vd($rows[1]->decodeTags());

		return $this->app->loader->view('admin::posts::index', ['rows' => $rows]);
	}

	public function create()
	{
		return $this->app->loader->view('admin::posts::create_form', ['model' => new Post()]);
	}

	public function create_submit()
	{
		$entity = Post::from_array($this->app->input->post());

		$errors = $this->validate($this->app->input->post());

		if( count($errors) > 0 )
		{
			return $this->app->loader->view('admin::posts::create_form', [
				'errors' => $errors,
				'model' => $entity
			]);
		}

		$entity->cover_image = $this->upload_picture('cover_image');
		$entity->created_at = date("Y-m-d H:i:s");

		$this->app->db
			->set([
				'url_slug' => $entity->url_slug,
				'title' => $entity->title,
				'author_id' => $this->app->session->fetch('user')->user_id,
				'x_minutes_read' => $this->calculateReadingTime($entity->content),
				'created_at' => $entity->created_at,
				'category' => $entity->category,
				'tags' => $entity->encodeTags($entity->tags),
				'content' => $entity->content,
				'cover_image' => $entity->cover_image
			])
			->insert('posts');

		$this->app->session->attach('alert', ['type'=>'success', 'alert-message'=>'Post created']);

		$this->redirect('http://127.0.0.1:8000/admin/posts');
	}

	public function details($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from posts where post_id=' . $id)->fetchObject();

		$entity = Post::from_array( (array) $entity );

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::posts::details', ['model' => $entity]);
	}

	public function edit($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from posts where post_id=' . $id)->fetchObject();

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::posts::edit_form', ['model' => $entity]);
	}

	public function edit_submit($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from posts where post_id=' . $id)->fetchObject();

		if( ! $entity )
			return $this->notFound();

		$errors = $this->validateEdit($this->app->input->post());

		if( count($errors) > 0 )
		{
			return $this->app->loader->view('admin::posts::edit_form', [
				'errors' => $errors,
				'model' => $user
			]);
		}

		if( $_FILES['conver_image'] !== null )
			$entity->conver_image = $this->upload_picture('conver_image');

		$this->app->db
			->set([
				'url_slug' => $entity->url_slug,
				'title' => $entity->title,
				'x_minutes_read' => calculateReadingTime($entity->content),
				'category' => $entity->category,
				'tags' => $entity->encodeTags($entity->tags),
				'content' => $entity->content,
				'conver_image' => $entity->conver_image
			])
			->update('posts');

		$this->app->session->attach('alert', ['type'=>'success', 'alert-message'=>'Post updated']);

		$this->redirect('http://127.0.0.1:8000/admin/posts');
	}

	public function delete_confirmation($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from posts where post_id=' . $id)->fetchObject();

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::posts::delete_confirmation_form', ['model' => $entity]);
	}

	public function destroy($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from posts where post_id=' . $id)->fetchObject();

		if( ! $entity )
			return $this->notFound();

		$this->app->db->where('post_id', $entity->post_id)->delete('posts');

		$this->app->session->attach('alert', ['type'=>'success', 'alert-message'=>'Post delete']);

		$this->redirect('http://127.0.0.1:8000/admin/posts');
	}

	protected function validate($data, $create = true)
	{
		$errors = [];

		if( empty($this->app->input->post('url_slug')) ) $errors[] = 'URL Slug is required';
		if( empty($this->app->input->post('title')) ) $errors[] = 'Title is required';
		if( empty($this->app->input->post('category')) ) $errors[] = 'Category is required';
		if( empty($this->app->input->post('tags')) ) $errors[] = 'Tags is required';
		if( empty($this->app->input->post('content')) ) $errors[] = 'Content is required';

		/**
		 * 
		 * Validate uploaded picture
		 * 
		 */

		$field_name = 'cover_image';

		if( $create && empty($_FILES[$field_name]) )
		{
			$errors[] = 'Cover Image is required';
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

	protected function validateEdit($data, $create = true)
	{
		$errors = [];

		if( empty($this->app->input->post('username')) ) $errors[] = 'Username is required';
		if( empty($this->app->input->post('full_name')) ) $errors[] = 'Full Name is required';
		if( empty($this->app->input->post('email')) ) $errors[] = 'Email is required';
		if( !filter_var($this->app->input->post('email'), FILTER_VALIDATE_EMAIL) ) $errors[] = 'Invalid email format';
		if( empty($this->app->input->post('password_hash')) ) $errors[] = 'Password is required';
		if( strlen($this->app->input->post('password_hash')) < 8 || strlen($this->app->input->post('password_hash')) > 32 ) $errors[] = 'password must be at least 8 characters to 32 characters';
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
		$targetDir = ROOT . "/webroot/images/cover_images/";

		if ( ! is_dir($targetDir) )
			mkdir($targetDir, 0777, true);

		$file = $_FILES[$field_name];
		$fileName = basename($file['name']);
		
		$fileTmp  = $file['tmp_name'];
		$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		$newName = uniqid("cover_image_", true) . "." . $fileExt;
		$targetFile = $targetDir . $newName;

		return move_uploaded_file($fileTmp, $targetFile)
			? "images/cover_images/$newName"
			: '';
	}

	protected function calculateReadingTime($text, $wpm = 200)
	{
		$wordCount = str_word_count(strip_tags($text));

		$minutes = ceil($wordCount / $wpm);

		return $minutes;
	}

}