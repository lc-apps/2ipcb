<?php

namespace app\models\portal;

use app\models\Model;

class User extends Model {

	protected $table = 'users';

	public $session = "user_logado";

	public $user_id ="user_id";

}
