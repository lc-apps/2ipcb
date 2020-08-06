<?php

namespace app\validate\config;

use app\validate\Validate;

class Config extends Validate {
	
	public function validate() {

		$this->required(['titulo', 'slogan', 'email_contato']);
		$this->email(['email_contato']);
		$this->image(['file']);
		$this->imageDimensions(['file'],'logo');

	}
}