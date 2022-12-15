<div style="padding-top:2%;" class="container">
<style>
	.post-title{
		text-transform: uppercase;
		font-weight: bold;
	}
	.post-content{
		margin-bottom: 5%;
		border:1px solid lightgray;
		width: 50rem;
		padding	: 2% 1%;
	}
</style>
	<h1 class="post-title"><?= $post["title"] ?></h1>
	<p class="post-meta text-muted"><?= $post["username"] ?></p>
	<p class="post-content"><?= $post["content"] ?></p>
	<?= ($isAuthor ? '<p class="btn btn-danger" id="delete-post">Delete post</p>' : "")?>
	<?= ($isAuthor ? '<p class="btn btn-primary" id="edit-post">Edit post</p>' : "")?>
	<?php if($isAuthor) { ?>

	<div id="edit-div" style="display: none; width:25rem;">
		<input class="form-control" id="edit-title" type="text" value="<?= $post["title"] ?>">
		<textarea style="margin: 2% 0;" class="form-control" id="edit-content" cols="30" rows="10"><?= $post["content"] ?></textarea>
		<button class="btn btn-success" id="edit-submit">Submit changes</button>
	</div>
</div>

<?php } ?>
<script type="module">
	import {fct_fetchData} from "/js/mod_ajax.js";

	document.querySelector("#edit-post").addEventListener("click", () => {
		document.getElementById("edit-div").style.display = "block";
	})

	document.querySelector("#edit-submit").addEventListener("click", btn => {
		btn.preventDefault();
		fct_fetchData("ajax-post", {
			"route" : "updatePost",
			"postID" : <?= $post["id"] ?>,
			"title" : document.querySelector("#edit-title").value,
			"content" : document.querySelector("#edit-content").value
		}).then(console.log);
	});

	document.querySelector("#delete-post").addEventListener("click", () => {
		if(confirm("Are you sure to delete this post ?")) {
			fct_fetchData("ajax-post", {
				"route" : "deletePost",
				"postID" : <?= $post["id"] ?>
			}).then( data =>{
				console.log(data);
				if(data.success) {
					window.location.href = "http://localhost:8000/posts"
				}
			});
		}
	})
</script>