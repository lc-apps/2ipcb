<?php

namespace app\classes;

use app\classes\Config;
use app\classes\Image;
use PDO;

class Upload {
	/**
	 * @var mixed
	 */
	private $file;

	/**
	 * @var mixed
	 */
	private $type;

	/**
	 * @param $local
	 * @param $field
	 */
	public function upload($local, $field) {

	
		$key = $local;

		$fields = $field;

		$config = Config::load('imagens');


		//$this->mkDir($config->$key);

		$this->moveFile($config->$key, $field);



	}

	/**
	 * @param $fields
	 * @return mixed
	 */

	// pega a extensão da imagem -- ver como aproveitar a função do Validate
	private function getExtension($fields) {

		$field = $_FILES[$fields];

		return strtolower(end(explode('.', $field['name'])));
	}

	/**
	 * @param $folder
	 */
	private function mkDir($folder) {

		if (!is_dir($folder['folder'])) {

			mkdir($folder['folder']);

		}

	}

	/**
	 * @param $folder
	 * @param $field
	 */
	private function moveFile($folder, $field) {

		$file = $_FILES[$field];

		$destination = $_SERVER['DOCUMENT_ROOT'] . $folder['folder'] . DIRECTORY_SEPARATOR . $file["name"];

		if (move_uploaded_file($file["tmp_name"], $destination)) {

			echo "Upload realizado com sucesso !";

		} else {

			throw new \Exception("Não foi possivel realizar o upload.");

		}
	}



}