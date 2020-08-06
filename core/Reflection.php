<?php

namespace core;

class Reflection {

	private $reflection;

	public function __construct($object){

		$this->reflection = new \ReflectionObject($object);
	}


	private function getNamespace(){

		return $this->reflection->getNamespaceName();
		
	}

	public function getClassName(){

		return $this->reflection->getName()();
		
	}

	public function folder(){

		// Estava assim antes -- $namespace = $this->getNamespace($object);
		$namespace = $this->getNamespace();

		$explode = explode('\\', $namespace);

		return array_pop($explode);
	}


}




		