<?php

require_once __DIR__ . '/../vendor/autoload.php';
session_start();

// Routes de l'application
$router = new AltoRouter();

// Page d'accueil
$router->map('GET', '/', [
    'controller' => 'HomeController',
    'method' => 'index'
], 'home-index');

// Page de login
$router->map('GET', '/login', [
    'controller' => 'LoginController',
    'method' => 'index'
], 'login-index');


$router->map('GET', '/profile/[i:id]', [
    'controller' => 'ProfileController',
    'method' => 'show'
], 'profile-show');

$match = $router->match();


// Dispatcher
if ($match) {
    // Si la route existe, on l'affiche
    $controllerName = "\\App\Controller\\" . $match['target']['controller'];
    $methodName = $match['target']['method'];
    $params = $match['target']['params'];

    // on instancie le controller
    $controllerObject = new $controllerName();

    // on appelle la méthode du controleur
    if (is_array($params)) {
        $controllerObject->$methodName(...array_values($params));
    } else {
        $controllerObject->$methodName();
    }
} else {
    // On affiche une page 404
}
