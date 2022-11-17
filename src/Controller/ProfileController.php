<?php

namespace App\Controller;

use App\Models\UserModel;
use Exception;

class ProfileController extends BaseController
{
	public function index()
	{
		$userModel = new UserModel();
		$userInfos = $userModel->getProfileInfo($_SESSION["username"]);

		// Affiche la vue
		$this->render('profile/index.view.php', ['userInfos' => $userInfos, 'title' => 'Page de profil']);
	}

	public function updateProfile () {
		if(isset($_POST["username"]) && isset($_POST["github"]) && isset($_POST["description"]) && isset($_POST["newUsername"])) {
			echo $this->fct_updateProfile($_POST["username"], $_POST["github"], $_POST["description"], $_POST["newUsername"]);
		} else {
			echo json_encode(
				array(
					"error" => "il y a une error dans le POST" , "POST" => $_POST
				)
			);
		}
	}
			
	private function fct_updateProfile($username, $github, $description, $newUsername) {
		$usermodel = new UserModel();
		try{
			$usermodel->setProfileInfo($username,$github,$description, $newUsername);
			return json_encode(array("result" => "done"));
		} catch (Exception $e) {
			return json_encode(array("error" => $e->getMessage()));
		}
	}
}
