<?php

namespace app\classes;

class Config {

	public static function load($index) {

		$config = require "../config.php";

		return (object) $config[$index];
	}

}
