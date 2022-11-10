<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MyBlog - Login</title>
	<style>
		.msg{
			width: fit-content;
			padding: 1%;
			color: white;
			border-radius: 20px;
		}
		.alert{
			background-color: red;
		}
		.success{
			background-color: green;
		}
	</style>
</head>
<body>
	<?php require_once("../views/partials/nav.view.php");?>
	<?= (isset($msgHTML) ? $msgHTML : "") ?>
	<form action="" method="POST">
		<label for="username">Enter your username or email</label>
		<input name="username" id="username" type="text">
		<label for="password">Enter your password</label>
		<input name="password" type="password">
		<button type="submit" name="submit">Login</button>
	</form>
	<a href="register.controller.php">Don't have an account yet ? click here to register</a>
</body>
</html>