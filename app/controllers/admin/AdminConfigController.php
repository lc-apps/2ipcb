<?php

namespace app\controllers\admin;

use app\classes\Upload;
use app\controllers\ContainerController;
use app\models\Config;
use app\validate\config\Config as ConfigValidate;
use app\models\Post;

class AdminConfigController extends ContainerController {

	public function __construct() {

		guestAdmin();

	}

	public function index() {

	    $posts = new Post;
		$posts = $posts->count();	

		$this->view([
			'title' => 'Principal',
			'blog' => $posts,
		], 'admin.dashboard');

	}

	public function create() {

	}

	/**
	 * @param $id
	 */
	public function destroy($id) {

	}

	/**
	 * @param $id
	 */
	public function edit($id) {

		$this->view([
			'title' => 'Configurações',
			'titulo' => 'Configurações do Site',
			'pagina' => 'Configurações do Site',
			'evento' => 'Editar',
		], 'admin.config2');

	}

	

	public function show() {

	}

	public function store() {

	}

	public function update() {

		$configValidate = validate(ConfigValidate::class);

		if ($configValidate->hasErrors()) {

			flash($configValidate->getErrors());

			return back();
		}

		// chama a classe upload
		$upload = new Upload();

		$upload->upload('logo', 'file');

		$config = new Config;

		$config->update(request('logo')->get(), ['id' => 1]);

		redirect('/adminConfig/edit');

	}
}