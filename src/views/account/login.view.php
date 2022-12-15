<?= (isset($msgHTML) ? $msgHTML : "") ?>
<div class="container" style="padding-top:2%;">
	<form action="" method="POST" style="width:18rem;">
		<div class="form-group">
			<label for="username">Enter your username or email</label>
			<input class="form-control"name="username" id="username" type="text" placeholder="username or email">
		</div>
		<div class="form-group">
			<label for="password">Enter your password</label>
			<input class="form-control"name="password" type="password" placeholder="password">
		</div>
		<button style="margin: 5% 0;"class="btn btn-success" type="submit" name="submit">Login</button>
	</form>
	<a class="btn btn-info" style="color:white;" href="/register">Don't have an account yet ? click here to register</a>
</div>