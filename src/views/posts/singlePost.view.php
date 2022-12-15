<h1><?= $post["title"] ?></h1>
<p><?= $post["content"] ?></p>
<p><?= $post["username"] ?></p>
<?= ($isAuthor ? '<p id="delete-post">Delete post</p>' : "")?>
<?= ($isAuthor ? '<p id="edit-post">Edit post</p>' : "")?>
<?php if($isAuthor) { ?>
<div id="edit-div" style="display: none;">
	<input id="edit-title" type="text" value="<?= $post["title"] ?>">
	<textarea name="" id="edit-content" cols="30" rows="10"><?= $post["content"] ?></textarea>
	<button id="edit-submit">Submit changes</button>
</div>

<?php } ?>
<script type="module">
	import {fct_fetchData} from "./js/mod_ajax.js";

	document.querySelector("#edit-post").addEventListener("click", () => {
		document.getElementById("edit-div").style.display = "block";
	})

	document.querySelector("#edit-submit").addEventListener("click", btn => {
		btn.preventDefault();
		fct_fectData("ajax-post", {
			"route" : "updatePost",
			"id" : <?= $post["id"] ?>,
			"title" : document.querySelector("#edit-title").value,
			"content" : document.querySelector("edit-content").value
		}).then(console.log);
	});

	document.querySelector("#delete-post").addEventListener("click", () => {
		if(confirm("Are you sure to delete this post ?")) {
			fct_fetchData("ajax-post", {
				"route" : "deletePost",
				"id" : <?= $post["id"] ?>
			}).then( data =>{
				console.log(data);
				// window.location.href = "http://localhost:8000/posts"
			});
		}
	})
</script>