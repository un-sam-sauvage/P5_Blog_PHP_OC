<nav style="padding-left:2%;" class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
	<a class="navbar-brand" href="/">MyBlog</a>
	<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div id="navbarNav" class="collapse navbar-collapse">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="/posts">All post</a>
			</li>

			<?php if (isset($_SESSION["username"])) { ?>
			
			<li class="nav-item active">
				<a class="nav-link" href="/profile"><?= $_SESSION["username"] ?>'s profile</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="/logout">Disconnect</a>
			</li>

			<?php } else { ?>

			<li class="nav-item active">
				<a class="nav-link" href="/login">Login</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="/register">Register</a>
			</li>

			<?php } ?>
			<?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1){?>
			<li class="nav-item active">
				<a href="/validate-comments" class="nav-link">Validate new comments</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</nav>