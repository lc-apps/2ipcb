<?php


use app\validate\Validate;
use app\validate\Sanitize;

use app\models\Model;
use app\models\portal\User;
use app\models\admin\Admin;
use app\models\Config;
use app\models\Post;

use app\classes\Login;
use app\classes\Redirect;
use app\classes\Flash;
use app\classes\Gmaps;
use app\classes\Config as ConfigClass;
use app\classes\Pagination;


function dd($dump) {
	var_dump($dump);

	die();
}

function toJson($data){

	header('Content-Type: application/json');
	echo json_encode($data);

}

function textReplace($origin, array $find )

{
	foreach ($find as $key => $value) {

		$origin = str_replace($key, $value, $origin);

	}

	return $origin;
}

function array_insert_after( array $array, $key, array $new ) {
	$keys = array_keys( $array );
	$index = array_search( $key, $keys );
	$pos = false === $index ? count( $array ) : $index + 1;
	return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
}

function validate($validate){

	$validate = new $validate();

	$validate->validate();

	return $validate;

}

function validateImage($validate){

	$validate = new $validate();

	$validate->validateImage();

	return $validate;

}


function request($key = null, $field = null){

	$sanitized = new Sanitize;

	if (!is_null($field)) {
		return $sanitized->sanitized()->field;
	}

	return $sanitized->sanitized($key);
}

function limitarTexto($texto, $limite, $quebrar = true){

   //conta as tags do texto para evitar corte errado
   $contador = strlen(strip_tags($texto));
   if($contador <= $limite):
     //se o número do texto form menor ou igual o limite então retorna ele mesmo
     $newtext = $texto;
   else:
     if($quebrar == true): //se for maior e $quebrar for true
       //corta o texto no limite indicado e retira o ultimo espaço branco
       $newtext = trim(mb_substr($texto, 0, $limite))."...";
     else:
       //localiza ultimo espaço antes de $limite
       $ultimo_espaço = strrpos(mb_substr($texto, 0, $limite)," ");
       //corta o $texto até a posição lozalizada
       $newtext = trim(mb_substr($texto, 0, $ultimo_espaço))."...";
     endif;
   endif;
   return $newtext;
 }


function auth(Model $model){

	return (new Login)->login($model);


}


function redirect($target){

	return Redirect::redirect($target);


}

function back(){

	return Redirect::back();

}

function flash($messages) {

	return Flash::add($messages);
}

function guestUser(){

	return (new Login)->guest(New User);
}

function guestAdmin(){

	return (new Login)->guest(New Admin);
}

function getConfig(){

	return (new Config())->find('id', 1);

}


function latLong(){

	$key = ConfigClass::load('mapa');

	$gmaps = new Gmaps($key->key);

	$config = getConfig();

	$endereco = $config->logradouro." , ".$config->numero." , ".$config->bairro." , ".$config->cidade." , ".$config->pais;

	return $gmaps->geoLocal($endereco);
	// caso precise usar outra classe
	//https://packagist.org/packages/anthonymartin/geo-location
}




