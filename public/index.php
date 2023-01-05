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

$router->map('POST', '/login', [
	'controller' => "AccountController",
	'method' => "login"
], "account-login-post");

$router->map('GET', "/register", [
	'controller' => 'AccountController',
	'method' => 'register'
], 'account-register');

$router->map('POST', "/register", [
	'controller' => 'AccountController',
	'method' => 'register'
], 'account-post-register');

// Page de Profile
$router->map('GET', '/profile', [
	'controller' => 'ProfileController',
	'method' => 'index'
], 'profile-index');

$router->map('POST', '/profile', [
	'controller' => "ProfileController",
	'method' => "updateProfile"
], "profile-update");

$router->map('GET', '/posts/[i:id]', [
	'controller' => 'PostController',
	'method' => 'showSinglePost'
], 'post-show');

$router->map('GET', '/posts', [
	'controller' => 'PostController',
	'method' => 'showAllPost'
], 'all-post-show');

$router->map('GET', '/create-post', [
	'controller' => 'PostController',
	'method'=> 'renderCreatePost'
], 'show-create-post');

$router->map('POST', '/create-post', [
	'controller' => 'PostController',
	'method' => 'createPost'
], 'create-post');

$router->map("POST", "/ajax-post",[
	"controller" => "PostController",
	"method" => "ajaxPost"
], "ajax-post");

$router->map("POST", "/ajax-comment", [
	"controller" => "CommentController",
	"method" => "ajaxComment",
], "ajax-comment");

$router->map("GET", "/validate-comments", [
	"controller" => "CommentController",
	"method" => "getCommentsToValidate"
], "get-comments-validate");

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
