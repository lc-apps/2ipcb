<?php

namespace app\controllers\portal;

use app\classes\Config;
use app\classes\Email;
use app\controllers\ContainerController;
use app\validate\contact\Mail;

class ContatoController extends ContainerController {


	public function index() {

		$key = Config::load('mapa');

		$this->view([
			'pagina' => 'Contato',
			'script' => 'contato',
			'key' => $key->key,
			'mapa' => latLong(),
		], 'portal.contato');

	}

	public function send() {


		$mailValidate = validate(Mail::class);

		if ($mailValidate->hasErrors()) {

			flash($mailValidate->getErrors());

			return back();
		}

		// chama a classe upload
		$email = new Email();

		$email->sendMail(request()->get(), 'contato');

		redirect('/contato/index');

	

	}
}
