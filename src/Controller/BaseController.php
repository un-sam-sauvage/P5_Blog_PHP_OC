<?php

namespace App\Controller;

class BaseController
{
	public function render($viewName, $params = [])
	{
		// On transforme les clés du tableaux params en variables
		// ex : 
		// ['title' => 'Mon titre'] devient $title = 'Mon titre'
		extract($params);

		// On execute le code récupérer le rendu html que l'on stocke dans la variable $bodyContent
		ob_start();
		require __DIR__ . "/../views/" . $viewName;
		$bodyContent = ob_get_clean();

		// On utilise la variable $bodyContent dans le layout de base
		require __DIR__ . "/../views/base.view.php";
	}

	public function error($viewName = 'base/error.view.php')
	{
		header("HTTP/1.1 500 Internal Server Error");
		$this->render($viewName);
	}

	public function error404($viewName = 'base/error404.view.php')
	{
		header("HTTP/1.1 404 Not Found");
		$this->render($viewName);
	}
}
