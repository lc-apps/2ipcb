<?php

namespace app\validate\slider;

use app\validate\Validate;

class Slider extends Validate {


	public function validateImage() {

		$this->image(['file']);
		//passa o campo e a chave da configuração
		$this->imageDimensions(['file'],'slider');


	}
}