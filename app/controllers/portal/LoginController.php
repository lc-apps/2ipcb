<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\validate\portal\Login;
use app\models\portal\User;
use app\classes\Login as LoginClass;

class LoginController extends ContainerController {

	public function index() {

		$this->view([
			'title' => 'Login',
		], 'portal.login');
	
	}

	public function show($request) {

		
	}

	public function create() {

	}

	public function store() {

		$login = validate(Login::class);


		if ($login->hasErrors()) {

			flash($login->getErrors());

			return redirect('/login');
		}

		auth(new User);

		redirect('/');

	}


	public function edit($id) {

	}

	public function update($id) {

	}

	public function destroy() {

		$login = new LoginClass;
		return $login->logout(new User);

	}

}