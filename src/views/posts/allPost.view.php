<div style="padding-top:2%;" class="container">

	<?php foreach ($posts as $post) {?>
		<div class="card" style="width:18rem; margin-bottom:2rem;">
			<div class="card-body">
				<h4 class="card-title"><?= $post["title"] ?></h4>
				<p class="card-text">
					<!-- echo the chapo if it exists truncate the post's content if it's too long -->
					<?= 
						((!empty($post["chapo"]))
						? $post["chapo"] 
						: ((strlen($post["content"]) > 150) 
							? substr($post["content"],0,150). "..." 
							: $post["content"]))
					?>
					</p>
				<p class="post-author">
					By : <span class="text-muted"><?= $post["username"]?></span> 
					at : <span class="text-muted"><?= date("d-m-Y", strtotime($post["created_at"])) ?></span>
				</p>
				<a class="btn btn-sm btn-secondary" href="/posts/<?= $post["id"] ?>">See full post</a>
			</div>
		</div>
	<?php } ?>
</div>
