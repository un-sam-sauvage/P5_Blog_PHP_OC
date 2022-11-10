<nav>
	<a href="/Projet5">Back To Home</a>
	<a href="../controller/login.controller.php">Login</a>
	<?= isset($_SESSION["username"]) ? "" : '<a href="../controller/register.controller.php">Register</a>' ?>
	<?= isset($_SESSION["username"]) ? '<a href="../controller/profile.controller.php">Go to your profile</a>' : "" ?>
	<?= isset($_SESSION["username"]) ? '<a href="logout.controller.php">Disconnect</a>' : "" ?>
	<p><?= isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?></p>
</nav>