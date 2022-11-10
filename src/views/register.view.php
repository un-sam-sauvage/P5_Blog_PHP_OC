<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php require_once("../views/partials/nav.view.php") ?>
	<?= isset($msg) ? $msg : "" ?>
	<form action="" method="POST">
		<label for="">Username</label>
		<input type="text" name="username" required="true">
		<label for="">Email</label>
		<input type="email" name="email" required="true">
		<label for="">Password</label>
		<input type="password" name="password" required="true">
		<label for="">Confirm password</label>
		<input type="password" name="confirmPassword" required="true">
		<button type="submit" name="register">Submit and register</button>
	</form>
</body>
</html>