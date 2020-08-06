<?php

namespace app\controllers\admin;

use app\controllers\ContainerController;
use app\models\Categoria;
use app\validate\categoria\Categoria as CategoriaValidate;


class AdminCategoriaController extends \app\controllers\ContainerController {

	public function __construct() {

		guestAdmin();

	}


	public function index() {

		$categoria = new Categoria;
		$categorias = $categoria->all();

		
		$this->view([
			'title' => 'Categorias',
			'pagina' => 'Categorias/Grupos',
			'evento' => "Lista",
			'categorias' => $categorias,
		], 'admin.categoria.list');
	}

	public function create() {

		$this->view([
			'title' => 'Categoria ou Grupos',
			'pagina' => 'Adicionar categorias ou grupos',
			'evento' => "Adicionar",
		],  'admin.categoria.add');

	}

	public function store() {

		$categoriaValidate = validate(CategoriaValidate::class);

		if ($categoriaValidate->hasErrors()) {

			flash($categoriaValidate->getErrors());

			return back();
		}


		$categoria = new Categoria;

		$categoria->insert(request()->get());

		redirect('/adminCategoria/index');

	}

	public function edit($id) {

		$categoria = new Categoria;
		$categoria = $categoria->find('id',$id->parameter);	

		$this->view([
			'title' => 'Categoria - Editar',
			'pagina' => 'Editar uma categoria',
			'evento' => 'Editar',
			'categoria' => $categoria,
		], 'admin.categoria.edit');

	}

	public function update() {

		$categoriaValidate = validate(CategoriaValidate::class);

		if ($categoriaValidate->hasErrors()) {

			flash($categoriaValidate->getErrors());

			return back();
		}


		$categoria = new Categoria;

		$categoria->update(request()->get(), ['id' => request()->get()->id]);

		redirect('/adminCategoria/index');

	}


	public function delete($id) {

		$categoria = new Categoria;

		$categoria->delete('id',$id->parameter);

		redirect('/adminCategoria/index');

	}

}