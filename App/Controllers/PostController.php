<?php
namespace App\Controllers;

use Jawan\Core\MVC\JF_Controller;
use \PDO;
use App\Models\Post;

class PostController extends JF_Controller {
	
	public function details($urlSlug)
	{
		$stmt = $this->app->db
			->getConnection()
			->prepare('SELECT 
				p.*,
				u.picture_path,
				u.full_name,
				u.username,
				u.user_id
			FROM posts AS p 
			JOIN users AS u ON p.author_id = u.user_id
			WHERE p.url_slug = :urlSlug
			LIMIT 1');

		$stmt->execute(['urlSlug' => $urlSlug]);

		$post_data = $stmt->fetch(PDO::FETCH_ASSOC);

		if( empty($post_data) )
			$this->notFound();

		$post = Post::from_array($post_data);

		return $this->app->loader->view(
			'post::details',
			[
				'post' => $post,
				'app'=>$this->app
			]
		);
	}

	protected function notFound()
	{
		$this->app->response->setOutput($this->app->loader->view('errors::e404'));
		$this->app->response->send();
		// return $this->app->getInstance()->loader->view('errors::e404');
	}

}