<?php

namespace App\Controller;

use App\Models\UserModel;

class ProfileController extends BaseController
{
	public function index()
	{
		$userModel = new UserModel();
		$userInfos = $userModel->getProfileInfo($_SESSION["username"]);

		// Affiche la vue
		$this->render('profile/index.view.php', ['userInfos' => $userInfos, 'title' => 'Page de profil']);
	}
}
