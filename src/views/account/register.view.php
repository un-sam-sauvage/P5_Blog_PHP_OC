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