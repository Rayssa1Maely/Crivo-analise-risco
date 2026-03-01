<?php
	require_once "rotas.php";
	require_once 'vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	spl_autoload_register(function ($class) {
		if (file_exists('Controllers/' . $class . '.class.php')) {
			require_once 'Controllers/' . $class . '.class.php';
		} else if (file_exists('Models/' . $class . '.class.php')) {
			require_once 'Models/' . $class . '.class.php';
		} else if (file_exists('Models/DAO/' . $class . '.class.php')) {
			require_once 'Models/DAO/' . $class . '.class.php';
		} else {
			die("Arquivo não existe " . $class);
		}
	});


	$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
	$projetoPath = '/crivo';
	if (strpos($uri, $projetoPath) === 0) {
		$uri = substr($uri, strlen($projetoPath));
	}

	if (empty($uri)) {
		$uri = "/";
	}

	$route->verificar_rota($_SERVER["REQUEST_METHOD"], $uri);

?>