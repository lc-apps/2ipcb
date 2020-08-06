<?php

namespace app\controllers\admin;

use app\controllers\ContainerController;

use app\validate\admin\Login;
use app\models\admin\Admin;
use app\classes\Login as LoginClass;


class AdminLoginController extends ContainerController {



	 public function store() {


		$login = validate(Login::class);


		if ($login->hasErrors()) {

			flash($login->getErrors());

			return redirect('/admin');
		}

		auth(new Admin);

		redirect('/adminConfig/index');
		

	}

	public function destroy(){

		$login = new LoginClass;
		return $login->logout(new Admin);
	}











}
