<?php

use app\classes\User as UserClass;
use app\models\portal\User;
use app\models\admin\Admin;
use app\models\Config;
use app\models\Categoria;
use app\models\Modulos;
use app\models\Events;


// função de teste
$this->functions[] = $this->functionsToView('teste', function () {
	return 'teste de função do Twig';
});

// mostra mensagem de erro nas telas de Login // $type = 'danger'
$this->functions[] = $this->functionsToView('message', function ($key, $type = 'danger') {
	return (new app\classes\Flash)->get($key, $type);
});

// verifica se o usuário esta logado na view
$this->functions[] = $this->functionsToView('user', function () {
	return (new UserClass())->user(new User);
});

// verifica se o administrador esta logado na view
$this->functions[] = $this->functionsToView('admin', function () {
	return (new UserClass())->user(new Admin);
});

// Pega o id do usurio e retorna o nome
$this->functions[] = $this->functionsToView('nome', function ($id) {

	$admin = (new Admin())->find('id', $id);
	return $admin->name;
});

// Pega o id da categoria e retorna o nome
$this->functions[] = $this->functionsToView('categoria', function ($id) {

	$categoria = (new Categoria())->find('id', $id);
	return $categoria->categoria;
});

// Pega o id da categoria e retorna o nome
$this->functions[] = $this->functionsToView('countcatevent', function ($id) {

	$events = (new Events())->countCat($id);

    $events = (array) $events;

    $events = (int)$events["COUNT(*)"];
    
	return $events;
});




// Limita os caracteres do texto 
$this->functions[] = $this->functionsToView('limita250', function ($texto) {

	$limite = 250;

	$texto = limitarTexto($texto,$limite);

	return $texto;
	
});


// carrega as configurações do site em qualquer view twig

$this->functions[] = $this->functionsToView('config', function () {
	return (new Config())->find('id', 1);
});
