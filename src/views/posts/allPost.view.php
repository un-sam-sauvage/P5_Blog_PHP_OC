<?php foreach ($posts as $post) {?>
	<div>
		<h4 class="post-title"><?= $post["title"] ?></h4>
		<p class="post-content"><?= $post["content"] ?></p>
	</div>
<?php } ?>
