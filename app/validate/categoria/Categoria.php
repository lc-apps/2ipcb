<?php

namespace app\validate\categoria;

use app\validate\Validate;
use app\models\Categoria as ModelCategoria;

class Categoria extends Validate {

	public function validate() {

		$this->required(['categoria']);
	}

	
}