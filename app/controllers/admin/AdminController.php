<?php

namespace app\controllers\admin;

use app\classes\Password;

class AdminController extends \app\controllers\ContainerController {



	public function index() {

		
		$this->view([
			'title' => 'Login',
		], 'admin.login2');
	}

}