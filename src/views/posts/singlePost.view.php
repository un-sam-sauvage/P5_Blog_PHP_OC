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
	#create-comment {
		display: flex;
		flex-direction: column;
		gap: 10px;
		width: 40%;
	}
</style>
	<h1 class="post-title"><?= $post["title"] ?></h1>
	<p class="post-meta">
		By : <span class="text-muted"><?= $post["username"] ?></span> 
		at : <span class="text-muted"><?= $post["created_at"] ?></span>
		<?= ($post["updated_at"] != $post["created_at"]) ? 'updated at : <span class="text-muted">'.$post["updated_at"].'</span>' : "" ?>
	</p>
	<p class="post-content"><?= $post["content"] ?></p>
	<?php if($isAuthor) { ?>
	<p class="btn btn-danger" id="delete-post">Delete post</p>
	<p class="btn btn-primary" id="edit-post">Edit post</p>
	<div id="edit-div" style="display: none; width:25rem;">
		<input class="form-control" id="edit-title" type="text" value="<?= $post["title"] ?>">
		<textarea style="margin: 2% 0;" class="form-control" id="edit-content" cols="30" rows="10"><?= $post["content"] ?></textarea>
		<button class="btn btn-success" id="edit-submit">Submit changes</button>
	</div>
	<?php } ?>
	<div id="comment-section">
		<div id="display-comments">
			<?php if(!empty($comments)) { foreach ($comments as $comment) { ?>
				<div class="card">
					<p>
						By : <span class="text-muted"><?= $comment["username"] ?></span> 
						at : <span class="text-muted"><?= $comment["created_at"] ?></span>
					</p>
					<p class="card-text"><?= $comment["content"] ?></p>
				</div>
			<?php }} else {echo"pas de commentaires";} ?>
		</div>
		<div id="create-comment">
			<?php if (isset($_SESSION["user_id"])) {?>
				<div id="create-comment">
					<textarea name="comment-content" id="comment-content" cols="30" rows="10" placeholder="Write a comment for this post"></textarea>
					<button id="submit-comment" class="btn btn-success">Send your comment to moderation</button>
				</div>
			<?php }?>
		</div>
	</div>
</div>
<script type="module">
	import {fct_fetchData} from "/js/mod_ajax.js";
	/*
	* Post manager
	*/
	
	//display edit div
	document.querySelector("#edit-post").addEventListener("click", () => {
		document.getElementById("edit-div").style.display = "block";
	})

	//send post modification
	document.querySelector("#edit-submit").addEventListener("click", btn => {
		btn.preventDefault();
		fct_fetchData("ajax-post", {
			route : "updatePost",
			postID : <?= $post["id"] ?>,
			title : document.querySelector("#edit-title").value,
			content : document.querySelector("#edit-content").value
		}).then(console.log);
	});

	//delete post
	document.querySelector("#delete-post").addEventListener("click", () => {
		if(confirm("Are you sure to delete this post ?")) {
			fct_fetchData("ajax-post", {
				route : "deletePost",
				postID : <?= $post["id"] ?>
			}).then( data =>{
				console.log(data);
				if(data.success) {
					window.location.href = "http://localhost:8000/posts"
				}
			});
		}
	});

	/*
	* Comment manager
	*/
	//create comment
	document.getElementById("submit-comment").addEventListener("click", btn => {
		btn.preventDefault();
		fct_fetchData("ajax-comment", {
			route : "create-comment",
			content : document.getElementById("comment-content").value,
			postId : <?= $post["id"] ?>,
		}).then (data => {
			console.log(data);
			if(data.success) {
				fct_setAlerte("Your comment has been sent to moderation for review. It will be published soon :)", "msg-success");
			}
		})
	})

</script>