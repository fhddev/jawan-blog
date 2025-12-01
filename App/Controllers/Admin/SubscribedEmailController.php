<?php
namespace App\Controllers\Admin;

use \PDO;
use App\Models\EmailSubscription;

class SubscribedEmailController extends ControllerBase {
	
	public function __construct() {
		parent::__construct();
    }

	public function index()
	{
		$rows = $this->app->db
			->getConnection()
			->query('select * from newsletter_subscribers')
			->fetchAll(PDO::FETCH_CLASS, EmailSubscription::class);

		return $this->app->loader->view(
			'admin::subscribed-emails::index',
			[
				'rows' => $rows,
				'app'=>$this->app
			]
		);
	}

}