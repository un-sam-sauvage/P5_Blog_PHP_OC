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
    'controller' => 'AccountController',
    'method' => 'login'
], 'account-login');


// Page de register
$router->map('GET', '/register', [
    'controller' => 'AccountController',
    'method' => 'register'
], 'account-register');

// Page de Profile
$router->map('GET', '/profile', [
    'controller' => 'ProfileController',
    'method' => 'index'
], 'profile-index');


$router->map('GET', '/post/[i:id]', [
    'controller' => 'PostController',
    'method' => 'show'
], 'post-show');

$match = $router->match();


// Dispatcher
if ($match) {
    // Si la route existe, on l'affiche
    $controllerName = "\\App\Controller\\" . $match['target']['controller'];
    $methodName = $match['target']['method'];
    $params = $match['params'];

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
    $baseCtrlObject = new \App\Controller\BaseController();
    $baseCtrlObject->error404();
}
