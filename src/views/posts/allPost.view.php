<?php foreach ($posts as $post) {?>
	<div>
		<h4 class="post-title"><?= $post["title"] ?></h4>
		<p class="post-content"><?= $post["content"] ?></p>
		<p class="post-author">By : <?= $post["username"]?></p>
		<a href="/posts/<?= $post["id"] ?>">See full post</a>
	</div>
<?php } ?>
