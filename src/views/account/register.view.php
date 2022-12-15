<?= isset($msg) ? $msg : "" ?>
<div class="container" style="padding-top:2%">
	<form action="" method="POST" style="width:18rem;">
		<div class="form-group">
			<label for="">Username</label>
			<input class="form-control" type="text" name="username" required="true" placeholder="username">
		</div>
		<div class="form-group">
			<label for="">Email</label>
			<input class="form-control" type="email" name="email" required="true" placeholder="email">
		</div>
		<div class="form-group">
			<label for="">Password</label>
			<input class="form-control" type="password" name="password" required="true" placeholder="password">
			<label for="">Confirm password</label>
			<input class="form-control" type="password" name="confirmPassword" required="true" placeholder="confirm password">
		</div>
		<button style="margin-top:2%;" class="btn btn-success" type="submit" name="register">Submit and register</button>
	</form>
</div>