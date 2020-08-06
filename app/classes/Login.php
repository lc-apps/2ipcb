<?php

namespace app\classes;

use app\models\Model;
use app\classes\Password;
use app\classes\Config;
use core\Reflection;

class Login {


	private $model;
	private $user;


	public function login(Model $model){

		$this->model = $model;

		$this->user = $this->model->find('email', request()->get()->email);

		if (!$this->user) {

			return $this->isNotLoggedIn();
		}

		if (Password::verify(request()->get()->password, $this->user->password)) {

			return $this->loggedIn();

		}

		return $this->isNotLoggedIn();

	}

	private function loggedIn(){



		$_SESSION[$this->model->session] = true;
		$_SESSION[$this->model->user_id] = $this->user->id;

		session_regenerate_id();

		return true;
	}

	private function isNotLoggedIn(){

		$config = Config::load('login');

		flash(['login' => $config->error]);

		back();

		exit();

	}


	public function guest(Model $model){

		$config = Config::load('redirect');

		$folder = (new Reflection($model))->folder();

		if (!isset($_SESSION[$model->session])) {
			return redirect($config->$folder['notLoggedIn']);
		}
	}

	public function logout(Model $model){

		session_destroy();

		$config = Config::load('redirect');

		$folder = (new Reflection($model))->folder();

		return redirect($config->$folder['logout']);
	}


}
