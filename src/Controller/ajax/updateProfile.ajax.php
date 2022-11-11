<?php

require_once("../../vendor/autoload.php");
use App\Models\UserModel;
session_start();

if(isset($_POST["username"]) && isset($_POST["github"]) && isset($_POST["description"]) && isset($_POST["newUsername"])) {
	echo fct_updateProfile($_POST["username"], $_POST["github"], $_POST["description"], $_POST["newUsername"]);
} else {
	echo json_encode(
		array(
			"error" => "il y a une error dans le POST" , "POST" => $_POST
		)
	);
}

function fct_updateProfile($username, $github, $description, $newUsername) {
	$usermodel = new UserModel();
	try{
		$usermodel->setProfileInfo($username,$github,$description, $newUsername);
		return json_encode(array("result" => "done"));
	} catch (Exception $e) {
		return json_encode(array("error" => $e->getMessage()));
	}
}