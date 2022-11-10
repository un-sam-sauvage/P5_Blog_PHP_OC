<?php

use Models\UserModel;
session_start();
require_once("../vendor/autoload.php");

$userModel = new UserModel();
$userInfos = $userModel->getProfileInfo($_SESSION["username"]);

require_once("../views/profile.view.php");