<?php
namespace App\Controllers;

use Jawan\Core\MVC\JF_Controller;
use \PDO;
use App\Models\User;
use App\Models\Post;

class AuthorController extends JF_Controller {
	
	public function index($username)
	{
		$user_data = $this->app->db
			->getConnection()
			->query("select * from users where username='".$username."'")
			->fetch(PDO::FETCH_ASSOC);

        if( empty($user_data) )
			return $this->notFound();

		$author = User::from_array($user_data);

        $stmt = $this->app->db
            ->getConnection()
            ->prepare("select * from posts where author_id=".$author->user_id);
        
        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_CLASS, Post::class);
        
		return $this->app->loader->view('author::index', [
			'author' => $author,
            'posts' => $posts
		]);
	}

    protected function notFound()
	{
		$this->app->response->setOutput($this->app->loader->view('errors::e404'));
		$this->app->response->send();
		// return $this->app->getInstance()->loader->view('errors::e404');
	}

}