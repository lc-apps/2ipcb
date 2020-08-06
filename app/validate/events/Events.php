<?php

namespace app\validate\events;

use app\validate\Validate;

class Events extends Validate {

	public function validate() {

		$this->required(['titulo', 'data', 'horario']);

	}

	public function validateImage() {

		$this->image(['file']);
		//passa o campo e a chave da configuração
		$this->imageDimensions(['file'],'eventos');


	}
}