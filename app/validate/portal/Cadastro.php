<?php

namespace app\validate\portal;

use app\validate\Validate;
use app\models\portal\User;

class Cadastro extends Validate {


	public function validate() 	{

		$this->required([]);
		$this->email(['email']);
		$this->unique(['email' => User::class] );
	}



}