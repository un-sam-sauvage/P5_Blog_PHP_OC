<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./views/styles/homepage.css">
	<title>MyBlog - Homepage</title>
</head>
<body>
	<?php require_once("./views/partials/nav.view.php"); ?>

	<h1 id="title">MyBlog</h1>
	<div id="header">

		<div id="catchphrase">
			<h3>Welcome to MyBlog where you can share any tips about video game / web development</h3>
			<h3>Feel free to post any tutos about something you're proud of</h3>
			<h3>Even the simplest things can help someone who's starting</h3>
			<h4>You can also ask for help if you're stuck somewhere !</h4>
		</div>
		<div id="cta">
			<a href="./controller/register.controller.php" id="register" class="btn-cta">Register to join the community</a>
			<a href="./controller/login.controller.php" id="login"class="btn-cta">Login to your account</a>
		</div>
	</div>
</body>
</html>