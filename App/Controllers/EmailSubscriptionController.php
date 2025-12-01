<?php
namespace App\Controllers;

use Jawan\Core\MVC\JF_Controller;
use \PDO;
use App\Models\EmailSubscription;

class EmailSubscriptionController extends JF_Controller {
	
	public function subscribe()
    {
        $email = $_POST['email'] ?? null;

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->app->loader->view(
                'email_subscription::feedback',
                [
					'status' => 'failed',
                    'message' => 'Please enter a valid email address.',
                    'app' => $this->app
                ]
            );
        }

        $stmt = $this->app->db
			->getConnection()
			->prepare("SELECT COUNT(*) FROM newsletter_subscribers WHERE email = :email");
        
		$stmt->execute(['email' => $email]);
        	
		$exists = $stmt->fetchColumn();

        if ($exists) {
            return $this->app->loader->view(
                'email_subscription::feedback',
                [
					'status' => 'failed',
                    'message' => 'This email is already subscribed.',
                    'app' => $this->app
                ]
            );
        }

		$this->app->db
			->getConnection()
			->prepare("INSERT INTO newsletter_subscribers (email, subscribed_at) VALUES (:email, NOW())")
        	->execute(['email' => $email]);

        return $this->app->loader->view(
            'email_subscription::feedback',
            [
				'status' => 'success',
                'message' => 'Thank you for subscribing!',
                'app' => $this->app
            ]
        );
    }

}