<?php

require '../bootstrap.php';

use core\Controller;
use core\Method;
use core\Parameters;

try {

	$controller = new Controller;
	$controller = $controller->load();

	$method = new Method;
	$method = $method->load($controller);

	$parameters = new Parameters;
	$parameters = $parameters->load();

	$controller->$method($parameters);

} catch (\Exception $e) {
	// quando o projeto estiver em produção tirar $e->getFile() . $e->getLine()
	dd($e->getMessage() . $e->getFile() . $e->getLine());
	// redirect('error'); caso eu quiser mandar para uma página
}
