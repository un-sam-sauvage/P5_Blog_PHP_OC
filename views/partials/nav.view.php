<nav>
	<a href="/Projet5/index.php">Back To Home</a>
	<a href="controller/login.controller.php">Login</a>
	<p><?= isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?></p>
</nav>