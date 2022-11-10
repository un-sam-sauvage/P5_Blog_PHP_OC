<nav>
	<a href="/Projet5/index.php">Back To Home</a>
	<a href="controller/login.controller.php">Login</a>
	<?= isset($_SESSION["username"]) ? "" : '<a href="controller/register.controller.php">Register</a>' ?>
	<p><?= isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?></p>
</nav>