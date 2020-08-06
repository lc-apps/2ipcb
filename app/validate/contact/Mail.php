<?php

namespace app\validate\contact;

use app\validate\Validate;

class Mail extends Validate {
	
	public function validate() {

		$this->required(['name', 'email', 'comments']);
		$this->email(['email']);
		$this->max(['email' => 50]);

	}
}