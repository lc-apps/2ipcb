<?php

namespace app\Validate;

use app\classes\Config;

abstract class Validate {
	/**
	 * @var array
	 */
	private $errors = [];

	/**
	 * @var mixed
	 */
	private $file;

	/**
	 * @param $fields
	 */
	public function email($fields) {

		$this->fieldsIsArray($fields);

		foreach ($fields as $key => $field) {

			if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {

				$this->errors[$field][] = "Esse e-mail não é válido";

			}

		}

	}

	/**
	 * @return mixed
	 */
	public function getErrors() {

		return $this->errors;

	}

	public function hasErrors() {

		return !empty($this->errors);

	}

	/**
	 * @param $fields
	 */
	public function id($fields) {

		$this->fieldsIsArray($fields);

		foreach ($fields as $key => $field) {

			if (!filter_var($_POST[$field], FILTER_SANITIZE_NUMBER_INT)) {

				$this->errors[$field][] = "Id do registro não é válido";

			}

		}

	}

	/**
	 * @param $fields
	 */
	public function image($fields) {

		$this->fieldsIsArray($fields);

		$extension = $this->getExtension($fields);

		if (!$this->isImage($extension)) {

			$this->errors[$fields[0]][] = "O Arquivo não é uma imagem !";

		}

	}

	// pega as dimensões da imagem passada pelo campo conforme paramentro
	// carrega as configurações da chave imagens
	// chama a função para pegar as dimensões
	// compara se as dimensões da imagem estão de acordo com as configurações
	// obs. tem que mudar o $config->logo -- esse ->logo tem que ser dimanico,
	// de acordo com o campo que for feito o upload.
	/**
	 * @param $fields
	 */
	public function imageDimensions($fields,$local) {

		$config = Config::load('imagens');

		// [0] width - [1] height

		$dimensions = $this->getImageDimensions($fields);

		if ($dimensions[0] < $config->$local['width'] || $dimensions[1] < $config->$local['height']) {
			$this->errors[$fields[0]][] = "A imagem é menor que o recomendado";

		}

	}

	/**
	 * @param $fields
	 */
	public function max($fields) {

		$this->fieldsIsArray($fields);

		foreach ($fields as $key => $length) {
			if (strlen($_POST[$key]) > $length) {

				$this->errors[$key][] = "Esse campo deve ter no máximo {$length} caracteres";
			}
		}

	}

	/**
	 * @param $fields
	 * @return null
	 */
	public function required($fields) {

		$this->fieldsIsArray($fields);

		if (empty($fields)) {

			foreach ($_POST as $key => $value) {

				$this->isEmpty($key);

			}

			return;
		}

		foreach ($fields as $key => $field) {

			$this->isEmpty($field);

		}

	}

	/**
	 * @param $fields
	 */
	public function unique($fields) {

		$this->fieldsIsArray($fields);

		foreach ($fields as $key => $model) {

			$model = new $model;

			if ($model->find($key, $_POST[$key])) {

				$this->errors[$key][] = "Já existe um registro para {$key} ";

			}
		}

	}

	/**
	 * @param $fields
	 */
	private function fieldsIsArray($fields) {

		if (!is_array($fields)) {

			throw new Exception('Validação precisa ser um array no required');
		}

	}

	/**
	 * @param $file
	 * @return mixed
	 */
	private function getExtension($fields) {

		$field = $_FILES[$fields[0]];

		return strtolower(end(explode('.', $field['name'])));
	}

	/**
	 * @param $fields
	 */
	private function getImageDimensions($fields) {

		$file = $_FILES[$fields[0]];

		return getimagesize($file["tmp_name"]);

	}

	/**
	 * @param $field
	 */
	private function isEmpty($field) {

		if (empty($_POST[$field])) {
			$this->errors[$field][] = "Esse Campo e Obrigatorio";
		}

	}

	/**
	 * @param $extensao
	 */
	private function isImage($extension) {

		$extensions = array('gif', 'jpeg', 'jpg', 'png'); // extensoes permitidas

		if (in_array($extension, $extensions)) {
			return true;
		}

	}

	public function imageEmpty($fields) {

		$this->fieldsIsArray($fields);

		$file = $_FILES[$fields[0]];

		if (empty($file)) {

			redirect('/adminBlog/updatenofile');
			
		}			

	}

	public function checkImage($fields,$model) {

		$this->fieldsIsArray($fields);

		$id = $_POST[$fields[0]];

		$file = $_FILES[$fields[1]];

		$oldfile = $_POST[$fields[2]];

		$model = new $model;

		$imagem = $model->find('imagem', $oldfile);

		dd($imagem->imagem);

		// comparar imagem exibida com imagem do banco
		// se for igual, não validar e cancelar update
		// se for diferente, validar e fazer update

				

	}
}