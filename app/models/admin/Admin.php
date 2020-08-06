<?php

namespace app\models\admin;

use app\models\Model;

class Admin extends Model{

  protected $table = 'admin';

  public $session = "admin_logado";

  public $user_id ="admin_id";

  protected $fillable = ['name', 'email', 'password'];

}
