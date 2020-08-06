<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\models\portal\User;
use Carbon\Carbon;

class CursoController extends ContainerController {
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

	}

	public function index() {

		

		$this->view([
			'semana' => Carbon::now(),
		], 'portal.curso.curso');

	}

	/**
	 * @param $request
	 */
	public function show($request) {

		$consulta = new User;
		$consulta = $consulta->receiveString()->orderBy($request->next,'DESC')->limit($request->parameter)->__toString();

		$this->view([
			'title' => 'Curso',
			'curso' => 'Index',
			'consulta' => $consulta,
		], 'portal.curso');

	}

	public function store() {

	}

	/**
	 * @param $id
	 */
	public function update($id) {

	}
}
