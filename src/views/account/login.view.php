<?= (isset($msgHTML) ? $msgHTML : "") ?>
<form action="" method="POST">
	<label for="username">Enter your username or email</label>
	<input name="username" id="username" type="text">
	<label for="password">Enter your password</label>
	<input name="password" type="password">
	<button type="submit" name="submit">Login</button>
</form>
<a href="/register">Don't have an account yet ? click here to register</a>