<?php
require_once("../models/login.model.php");
session_start();

if (isset($_POST["submit"])) {
	$login = new Login();
	$logged = $login->checkIfLogin($_POST["username"], $_POST["password"]);
	if($logged) {
		$msgHTML = '<p class="msg success">Sucessfully logged in</p>';
		$_SESSION["user_id"] = $login->getUserId();
		$_SESSION["username"] = $_POST["username"];
	} else {
		$msgHTML = '<p class="msg alert">Wrong username or password</p>';
	}
}

require_once("../views/login.view.php");
?>