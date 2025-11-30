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
		$rows = $this->app->db
			->getConnection()
			->query('select * from posts')
			->fetchAll(PDO::FETCH_CLASS, Post::class);

		return $this->app->loader->view(
			'admin::posts::index',
			[
				'rows' => $rows,
				'app'=>$this->app
			]
		);
	}

	public function create()
	{
		return $this->app->loader->view(
			'admin::posts::create_form',
			[
				'model' => new Post()
			]
		);
	}

	public function create_submit()
	{
		$postData = $this->app->input->post();
    	
		$entity = Post::from_array($postData);

		$errors = $this->validate($postData);

		if (!empty($errors)) {
			return $this->app->loader->view(
				'admin::posts::create_form',
				[
					'errors' => $errors,
					'model'  => $entity,
				]
			);
		}

		$entity->cover_image = $this->upload_picture('cover_image');
		$entity->created_at  = date("Y-m-d H:i:s");
		$entity->author_id   = $this->app->session->fetch('user')->user_id;
		$entity->x_minutes_read = $this->calculateReadingTime($entity->content);

		$this->app->db
			->set([
				'url_slug'       => $entity->url_slug,
				'title'          => $entity->title,
				'author_id'      => $entity->author_id,
				'x_minutes_read' => $entity->x_minutes_read,
				'created_at'     => $entity->created_at,
				'category'       => $entity->category,
				'tags'           => $entity->encodeTags($entity->tags),
				'content'        => $entity->content,
				'cover_image'    => $entity->cover_image,
			])
			->insert('posts');
		
		$this->app->session->attach('alert', [
			'type'=>'success',
			'alert-message'=>'Post created'
		]);

		$this->redirect('/admin/posts');
	}

	public function details($id)
	{
		$entity = $this->app->db
			->getConnection()
			->query('select * from posts where post_id=' . $id)
			->fetchObject();

		$entity = Post::from_array( (array) $entity );

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::posts::details', ['model' => $entity]);
	}

	public function edit($id)
	{
		$entity = $this->app->db->getConnection()->query('select * from posts where post_id=' . $id)->fetchObject();

		$entity = Post::from_array( (array) $entity );

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view('admin::posts::edit_form', ['model' => $entity]);
	}

	public function edit_submit($id)
	{
		$entity = $this->app->db
			->getConnection()
			->query('select * from posts where post_id=' . $id)
			->fetchObject();

		$postData = $this->app->input->post();

		$entity = Post::from_array( (array) $entity );
		
		$newEntity = Post::from_array($postData);

		if( ! $entity )
			return $this->notFound();

		$errors = $this->validate($postData, false);

		if ( ! empty($errors) ) {
			return $this->app->loader->view(
				'admin::posts::edit_form', [
					'errors' => $errors,
					'model' => $entity
				]
			);
		}

		if( ! empty($_FILES['cover_image']['name']) )
			$newEntity->cover_image = $this->upload_picture('cover_image');
		else
			$newEntity->cover_image = $entity->cover_image;
		
		$this->app->db
			->set([
				'url_slug' => $newEntity->url_slug,
				'title' => $newEntity->title,
				'x_minutes_read' => $this->calculateReadingTime($newEntity->content),
				'category' => $newEntity->category,
				'tags' => $newEntity->encodeTags($newEntity->tags),
				'content' => $newEntity->content,
				'cover_image' => $newEntity->cover_image
			])
			->where('post_id', $entity->post_id)
			->update('posts');

		$this->app->session->attach('alert',
			[
				'type'=>'success',
				'alert-message'=>'Post updated'
			]
		);

		$this->redirect('/admin/posts');
	}

	public function delete_confirmation($id)
	{
		$entity = $this->app->db
			->getConnection()
			->query('select * from posts where post_id=' . $id)
			->fetch(PDO::FETCH_ASSOC);

		$entity = Post::from_array( $entity );

		if( ! $entity )
			return $this->notFound();

		return $this->app->loader->view(
			'admin::posts::delete_confirmation_form',
			[
				'model' => $entity
			]
		);
	}

	public function destroy($id)
	{
		$entity = Post::from_array(
			$this->app->db
				->getConnection()
				->query('select * from posts where post_id=' . $id)
				->fetch(PDO::FETCH_ASSOC)
		);

		if( ! $entity )
			return $this->notFound();

		$this->app->db
			->where('post_id', $entity->post_id)
			->delete('posts');

		$this->app->session->attach('alert', [
			'type'=>'success',
			'alert-message'=>'Post delete'
		]);

		$this->redirect('/admin/posts');
	}

	protected function validate(array $data, bool $create = true): array
	{
		$errors = [];

		$requiredFields = ['url_slug', 'title', 'category', 'tags', 'content'];

		foreach ($requiredFields as $field)
			if (empty($data[$field])) $errors[] = ucfirst($field) . ' is required';

		$file      = $_FILES['cover_image'] ?? null;

		if ($create && empty($file['name'])) {
			$errors[] = 'Cover Image is required';
		} elseif (!empty($file['name'])) {
			$errors = array_merge($errors, $this->validateFile($file));
		}

		return $errors;
	}

	protected function validateFile(array $file): array
	{
		$errors = [];

		$allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
		$maxSize      = 2 * 1024 * 1024; // 2 MB

		$fileName = basename($file['name']);
		$fileSize = $file['size'];
		$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		if (!in_array($fileExt, $allowedTypes)) {
			$errors[] = "Invalid file type. Allowed: " . implode(", ", $allowedTypes);
		}

		if ($fileSize > $maxSize) {
			$errors[] = "File too large. Max size is 2MB.";
		}

		if ($file['error'] !== UPLOAD_ERR_OK) {
			$errors[] = "Upload error code: " . $file['error'];
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