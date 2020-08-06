<?php

namespace app\validate;

use app\classes\Password;

class Sanitize {
	/**
	 * @var array
	 */
	protected $sanitized = [];

	public function get() {

		return (object) $this->sanitized;

	}

	public function hash() {

		if (array_key_exists('password', $this->sanitized)) {
			$this->sanitized['password'] = filter_var(Password::hash($this->sanitized['password']), FILTER_SANITIZE_STRING);
		}

		return (object) $this->sanitized;

	}

	/**
	 * @return mixed
	 */
	public function sanitized($key) {

		$posts = $_POST;

		$fields = $this->isFileSet($key,$posts);

		foreach ($fields as $name => $value) {

			$this->sanitized[$name] = filter_var($value, FILTER_SANITIZE_STRING);

		}

		return $this;
	}

	// função para verificar se existe o $_FILES
	private function isFileSet($key, $posts){

		if (!empty($_FILES)) {

			$file[$key] = $_FILES['file']['name'];
			
			return $posts = array_insert_after( $posts, 'id', $file);
		}

		return $posts;
	}
}