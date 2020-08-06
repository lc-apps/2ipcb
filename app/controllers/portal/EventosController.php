<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\models\Events;
use app\models\Categoria;

class EventosController extends ContainerController {

	public function index() {

	$event = new Events;
	$events = $event->all();	

	$categoria = new Categoria;
	$categorias = $categoria->CatJoin('eventos');

    $evento = new Events;
    $principal = $evento->onlyWhere('principal','sim');

	$this->view([
			'title' => 'Eventos',
			'events' => $events,
			'categorias' => $categorias,
			'principal' => $principal,
		], 'portal.eventos.eventos');
	}

	public function details($id) {

		$event = new Events;
		$event = $event->find('id', $id->parameter);

		$this->view([
			'event' => $event,
			'lastevent' => $lastevent,
		], 'portal.eventos.eventos');
	}


	public function categoria($id) {

		$evento = new Events;

		$events = $evento->allWhere('id_categoria',$id->parameter);

		$evento = new Events;
        $principal = $evento->onlyWhere('principal','sim');

        $categoria = new Categoria;
	    $categorias = $categoria->CatJoin('eventos');
		
		$this->view([
			'pagina' => 'Eventos Por Categoria',
			'categoria' => $categorias->categoria,
			'events' => $events,
			'principal' => $principal,
			'categorias' => $categorias,
		], 'portal.eventos.eventos');
	}


	// Trocar as chamas por 
	public function find($id) {

		$event = new Events;
		$event = $event->find('id',$id->parameter);	

		$lastevents = new Events;
		$lastevents = $lastevents->limitWithDateLimit('data',3,'ASC');

		$categoria = new Categoria;
	    $categorias = $categoria->CatJoin('eventos');

	    $evento = new Events;
        $principal = $evento->onlyWhere('principal','sim');

		$this->view([
			'title' => $event->titulo,
			'pagina' => 'Eventos',
			'event' => $event,
			'lastevents' => $lastevents,
			'categorias' => $categorias,
			'principal' => $principal,
		], 'portal.eventos.event_single');

	}


}