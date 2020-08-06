<?php

namespace app\validate\blog;

use app\validate\Validate;
use app\models\Post;

class Blog extends Validate {




	public function validate() {

		

		$this->required(['titulo', 'texto']);
		
	}


	public function validateImage() {

		$this->image(['file']);
		//passa o campo e a chave da configuração
		$this->imageDimensions(['file'],'blog');


	}
}