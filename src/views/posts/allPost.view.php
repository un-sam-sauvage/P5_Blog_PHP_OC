<div style="padding-top:2%;" class="container">

	<?php foreach ($posts as $post) {?>
		<div class="card" style="width:18rem; margin-bottom:2rem;">
			<div class="card-body">
				<h4 class="card-title"><?= $post["title"] ?></h4>
				<p class="card-text"><?= (strlen($post["content"]) > 150) ? substr($post["content"],0,150)."..." : $post["content"] ?></p>
				<p class="post-author">By : <span class="text-muted"><?= $post["username"]?></span></p>
				<a class="btn btn-sm btn-secondary" href="/posts/<?= $post["id"] ?>">See full post</a>
			</div>
		</div>
	<?php } ?>
	<?= isset($_SESSION["username"]) ? '<a href="create-post" class="btn btn-primary">Create new post</a>' : "" ?>
</div>
