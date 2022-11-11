<nav>
	<a href="/">Back To Home</a>
	<a href="/login">Login</a>
	<?= isset($_SESSION["username"]) ? "" : '<a href="/register">Register</a>' ?>
	<?= isset($_SESSION["username"]) ? '<a href="/profile">Go to your profile</a>' : "" ?>
	<?= isset($_SESSION["username"]) ? '<a href="/logout">Disconnect</a>' : "" ?>
	<p><?= isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?></p>
</nav>