<?php

namespace app\validate\portal;

use app\validate\Validate;
use app\models\portal\User;

class Login extends Validate {


	public function validate() 	{


		$this->required(['email','password']);
		$this->email(['email']);

	}



}