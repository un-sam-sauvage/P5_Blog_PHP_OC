<?php

require_once("../vendor/autoload.php");
use Models\UserModel;

if (isset($_POST["register"])) {
	$msg = '';
	if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirmPassword"]))
		$msg = "Please fill all the inputs";
	else if ($_POST["password"] != $_POST["confirmPassword"])
		$msg = "Both password must be identical";
	else {
		$userModel = new UserModel();
		$results = $userModel->CheckIfUsernameOrEmailExist($_POST["username"], $_POST["email"]);
		foreach($results as $key => $value) {
			if(!$value) {
				$msg .= $key ." already taken <br />";
			}
		}
		if($results["username"] && $results["email"]) {
			$userModel->registerNewUser($_POST["username"],$_POST["email"], $_POST["password"]);
			$msg = "Successfully registered Welcome aboard";
		}
	}
}

require_once("../views/register.view.php");