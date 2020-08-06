<?php

return [
	"database" => [
		'host' => 'mysql07.hstbr.net',
		'dbname' => 'mvc_devclass',
		'username' => 'mvc_user',
		'password' => 'lD9Kifh0OC',
		'charset' => 'utf8',
	],
	'login' => [
		'error' => 'Usuário ou senha inválidos',
	],
	'mapa' => [
		'key' => 'AIzaSyA56cQO8ifAAk43anhaY9E5eJ0zD0Wc2Zs',
	],	
	'mapa_tom_tom' => [
		'key' => 'XYqTXW3vhPw7Ddjj17Xw8rHxromeGaww',	
	],
	'redirect' => [
		'portal' => [
			'notLoggedIn' => '/login',
			'logout' => '/',
		],
		'admin' => [
			'notLoggedIn' => '/admin',
			'logout' => '/admin',
		],
	],
	'imagens' => [
		'types' => [
			'gif' => 'gif',
			'jpeg' => 'jpeg',
			'png' => 'png',
		],
		'logo' => [
			'folder' => "/assets/images",
			'height' => 36,// altura
			'width' => 271,// largura
			'ratio' => 6,65
		],
		'blog' => [
			'folder' => "/assets/images/blog", // /assets/images/blog
			'height' => 600,// altura
			'width' => 800,// largura
			'ratio' => 1.33,
			'height_tb' => 60,
			'width_tb' => 80

		],
		'eventos' => [
			'folder' => "/assets/images/eventos", // /assets/images/blog
			'height' => 600,// altura
			'width' => 800,// largura
			'ratio' => 1.33,
			'height_tb' => 60,
			'width_tb' => 80

		],
		'slider' => [
			'folder' => "/assets/images/slider", // /assets/images/blog
			'height' => 635,// altura
			'width' => 1280,// largura
			'ratio' => 2,
			'height_tb' => 60,
			'width_tb' => 80

		],
	],
	'email' => [
		'error' => 'Ocorreu um erro -  E-mail não enviado.',
		'success' => 'E-mail enviado com sucesso.',
	],

];
