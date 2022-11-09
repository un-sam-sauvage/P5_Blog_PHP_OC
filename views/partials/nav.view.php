<style>
	nav{
		padding: 2%;
		display: flex;
		justify-content: space-between;
	}
	a {
		text-decoration: none;
	}
	#link{
		display: flex;
		gap: 15px;
	}
	#link > a:hover{
		text-decoration: underline;
	}
</style>
<nav>
	<div id="logo">
		<a href="/Projet5/index.php">MyBlog</a>
	</div>
	<div id="link">
		<a href="controller/login.controller.php">Login</a>
		<?= isset($_SESSION["username"]) ? "" : '<a href="controller/register.controller.php">Register</a>' ?>
		<p><?= isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?></p>
	</div>
</nav>