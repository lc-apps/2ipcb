<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\validate\portal\Cadastro;
use app\models\portal\User;
use app\classes\Password;

class CadastroController extends ContainerController {



	public function index() {

		$this->view([
			'title' => 'Cadastro de Usuário'
		], 'portal.cadastro');


	}

	public function show() {


	}

	public function create() {

	}

	public function store() {

		$login = validate(Cadastro::class);

		if ($login->hasErrors()) {

			flash($login->getErrors());

			return back();
		}

		$user = new User;

	  $user->insert(request()->hash());

		auth($user);

		redirect('/');




	}

	public function edit($id) {

	}

	public function update($id) {

	}

	public function destroy($id) {

	}

}
