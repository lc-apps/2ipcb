<?php

namespace app\controllers\admin;
use app\controllers\ContainerController;
use app\models\Events;
use app\models\Categoria;
use app\validate\events\Events as EventsValidate;
use app\classes\Upload;

class AdminEventController extends ContainerController {

	
	public function __construct() {

		guestAdmin();

	}

	public function index() {

		$events = new Events;
		$events = $events->all();

		$this->view([
			'title' => 'Eventos - Lista',
			'pagina' => 'Eventos',
			'evento' => "Lista",
			'events' => $events,
		], 'admin.events.list');

	}


	public function create() {

		$categorias = new Categoria;
		$categorias = $categorias->all();

		$this->view([
			'title' => 'Eventos - Novo',
			'pagina' => 'Inserir Eventos',
			'evento' => "Adicionar Evento",
			'categorias' => $categorias,
		],  'admin.events.add');

	}

	public function edit($id) {

		$events = new Events;
		$events = $events->find('id',$id->parameter);	

		$categorias = new Categoria;
		$categorias = $categorias->all();

		$this->view([
			'title' => 'Eventos - Editar',
			'pagina' => 'Editar Evento',
			'evento' => "Editar um Evento",
			'categorias' => $categorias,
			'events' => $events,
		], 'admin.events.edit');

	}

	public function delete($id) {

		$events = new Events;

		$events->delete('id',$id->parameter);

		redirect('/adminEvent/index');

	}

	public function store() {

		$eventsValidate = validate(EventsValidate::class);

		if ($eventsValidate->hasErrors()) {

			flash($eventsValidate->getErrors());

			return back();
		}

		// chama a classe upload
		$upload = new Upload();

		$upload->upload('eventos', 'file');

		$events = new Events;

		$events->insert(request('imagem')->get());

		redirect('/adminEvent/index');

	}

		public function update() {

		$eventsValidate = validate(EventsValidate::class);

		if ($eventsValidate->hasErrors()) {

			flash($eventsValidate->getErrors());

			return back();
		}


		$events = new Events;

		$events->update(request()->get(), ['id' => request()->get()->id]);

		redirect('/adminEvent/index');

	}

	public function upload(){

		$eventsValidate = validateImage(EventsValidate::class);


		if ($eventsValidate->hasErrors()) {

		flash($eventsValidate->getErrors());

		return back();	
		}		
		
		//chama a classe upload
		$upload = new Upload();

		$upload->upload('eventos', 'file');        

		$events = new Events;

		$events->update(request('imagem')->get(), ['id' => request()->get()->id]);

		redirect('/adminEvent/index');


	}
}

?>