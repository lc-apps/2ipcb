<?php

namespace app\validate\admin;

use app\validate\Validate;
use app\models\admin\Admin;

class Login extends Validate {


	public function validate() 	{


		$this->required(['email','password']);
		$this->email(['email']);
		//$this->max(['email' => 10, 'password' => 20]);
		//$this->unique(['email' => Admin::class] );
	}



}
