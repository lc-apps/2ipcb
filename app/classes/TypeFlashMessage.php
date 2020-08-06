<?php

namespace app\classes;

class TypeFlashMessage {
	/**
	 * @var array
	 */
	private static $types = [
		'danger', 'success',
	];

	/**
	 * @param $message
	 * @param $type
	 */
	public static function showMessage($message, $type) {
		if (!in_array($type, static::$types)) {
			throw new \Exception("Esse tipo de mensagem não é aceito");
		}

		return '<span class="text-' . $type . '">' . $message . '</span>';

	}
}