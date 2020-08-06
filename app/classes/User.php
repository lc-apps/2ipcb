<?php

namespace app\classes;

use app\models\Model;

class User {

	// retorna o usuário Logado
	public function user(Model $model) {
		
		if (isset($_SESSION[$model->session])) {
			return $model->find('id', $_SESSION[$model->user_id]);
		}

		return false;
	}

}