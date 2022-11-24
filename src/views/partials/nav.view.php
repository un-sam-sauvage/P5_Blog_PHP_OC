<nav>
	<a href="/">Back To Home</a>
	<a href="/posts">All post</a>
	<?php if (isset($_SESSION["username"])) { ?>
		<a href="/profile">Go to your profile</a>
		<a href="/logout">Disconnect</a>
		<p><?= $_SESSION["username"] ?></p>
	<?php } else { ?>
		<a href="/login">Login</a>
		<a href="/register">Register</a>
	<?php } ?>
</nav>