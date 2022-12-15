<?php

namespace App\Controller;

use App\Models\UserModel;

class AccountController extends BaseController
{
	public function login() {
		$msgHTML = "";
		if (isset($_POST["submit"])) {
			$login = new UserModel();
			$logged = $login->checkIfLogin(htmlspecialchars($_POST["username"], ENT_QUOTES), htmlspecialchars($_POST["password"], ENT_QUOTES));
			if ($logged) {
				$msgHTML = '<p class="msg success">Sucessfully logged in</p>';
				$_SESSION["user_id"] = $login->getUserId();
				$_SESSION["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES);
			} else {
				$msgHTML = '<p class="msg alert">Wrong username or password</p>';
			}
		}
		$this->render('account/login.view.php', ['msgHTML' => $msgHTML, 'title' => 'Login Page']);
	}
	
	public function register() {
		$msg = '';
		if (isset($_POST["register"])) {
			if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirmPassword"]))
				$msg = "Please fill all the inputs";
			else if (htmlspecialchars($_POST["password"], ENT_QUOTES) != htmlspecialchars($_POST["confirmPassword"], ENT_QUOTES))
				$msg = "Both password must be identical";
			else {
				$userModel = new UserModel();
				$results = $userModel->CheckIfUsernameOrEmailExist(htmlspecialchars($_POST["username"], ENT_QUOTES), htmlspecialchars($_POST["email"], ENT_QUOTES));
				foreach($results as $key => $value) {
					if(!$value) {
						$msg .= $key ." already taken <br />";
					}
				}
				if($results["username"] && $results["email"]) {
					$userModel->registerNewUser(htmlspecialchars($_POST["username"], ENT_QUOTES), htmlspecialchars($_POST["email"], ENT_QUOTES), htmlspecialchars($_POST["password"], ENT_QUOTES));
					$msg = "Successfully registered Welcome aboard";
				}
			}
		}
		$this->render('account/register.view.php', ["msgHTML" => $msg, "title" => "Register Page"]);
	}
}
