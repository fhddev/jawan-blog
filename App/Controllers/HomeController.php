<?php
namespace App\Controllers;

use Jawan\Core\MVC\JF_Controller;
use \PDO;
use App\Models\Post;
use App\Models\User;

class HomeController extends JF_Controller {
	
	public function index()
	{
		$recent_posts = $this->app->db
			->getConnection()
			->query('SELECT 
				p.*,
				u.picture_path,
				u.full_name,
				u.username,
				u.user_id
				FROM posts AS p JOIN users AS u ON p.author_id = u.user_id ORDER BY p.post_id DESC LIMIT 10;')
			->fetchAll(PDO::FETCH_ASSOC);

		$recent_posts = array_map(fn($row) => Post::from_array($row), $recent_posts);

		$authors = $this->app->db
			->getConnection()
			->query("SELECT *
						FROM users
						WHERE role = 'author'
						ORDER BY RAND()
						LIMIT 3;")
			->fetchAll(PDO::FETCH_CLASS, User::class);

		return $this->app->loader->view(
			'home::index',
			[
				'recent_posts' => $recent_posts,
				'authors' => $authors,
				'app'=>$this->app
			]
		);
	}

}