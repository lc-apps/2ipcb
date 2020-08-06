<?php

namespace app\traits;

use app\models\Model;

trait LoginVerify {

	public function guest(Model $model) {
		if (!isset($_SESSION[$model->session])) {
			return $this;
		}
	}

}