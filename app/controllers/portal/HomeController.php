<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\models\Events;
use app\models\Post;
use app\models\Slider;
use app\models\portal\User;

class HomeController extends ContainerController {

	public function index() {

		$user = new User;
		$users = $user->all();

		$events = new Events;
		$events = $events->limitWithDateLimit('data',3,'ASC');

		$sliders = new Slider;
		$sliders = $sliders->allWithLimit('posicao',3,'ASC');
		
		$lastevent = new Events;
		$lastevent = $lastevent->principal('principal','sim');

		dd($lastevent);

		$posts = new Post;
		$posts = $posts->allWithLimit('id',2,'DESC');

		$this->view([
			'titulo_users' => 'Lista de users',
			'users' => $users,
			'sliders' => $sliders,
			'titulo_events' => 'Próximos Eventos',
			'events' => $events,
			'lastevent' => $lastevent,
			'posts' => $posts,
		], 'portal.home');
	}
}