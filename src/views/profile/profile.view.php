<style>
	.container {
		display: flex;
		gap: 100px;
	}
	.card {
		width: 50%;
		margin: 0 auto 5%;
	}
	.rejection-comment {
		width: fit-content;
		background-color: darkred;
		padding: 2%;
		color: white;
		margin: 0 auto;
	}
	#wrapper-comments > h2{
		text-align: center;
	}
	#legend {
		display: flex;
		flex-direction: column;
		gap: 5px;
		align-items: center;
		margin : 5% auto;
		width: 50%;
	}
	#legend > div {
		width: fit-content;
		padding: 1%;
	}
	.hidden {
		display: none;
	}
	#edit-comment-div {
		position: fixed;
		background-color: lightgray;
		padding: 1%;
		left: 80%;
		top: 10%;
	}
</style>

<div class="container" style="padding-top:2%;">
	<div id="wrapper-infos">
		<div id="user-infos">
			<h1>Welcome to your profile <span id="username"><?= strtoupper($_SESSION["username"]) ?></span> !</h1>
			<p id="description"><?= $userInfos["description"] ?> </p>
			<a href="github.com/<?= $userInfos["github"] ?>" id="github">Github Page</a>
		</div>
		
		<button style="margin: 5% 0 2%;"class="btn btn-info" id="btn-edit">Edit your profile</button>
		
		<div id="edit-profile" style="width:30rem;" class="hidden">
			<div class="form-group">
				<label for="">Change your username (must be unique)</label>
				<input class="form-control" type="text" id="username-edit" value="<?= $_SESSION["username"] ?>" placeholder="new username">
			</div>
			<div class="form-group">
				<label for="">Add you Github Account</label>
				<input class="form-control" type="text" id="github-edit" value="<?= $userInfos["github"] ?>" placeholder="name of your github account">
			</div>
			<div class="form-group">
				<label for="">Change your description</label>
				<textarea class="form-control" id="description-edit" cols="30" rows="10" placeholder="Describe yourself"><?= $userInfos["description"] ?></textarea>
			</div>
			<button style="margin-top: 2%;"class="btn btn-success" id="submit-change">Validate new infos</button>
		</div>
	</div>
	<?php if (!empty($comments)) { ?>
	<div id="wrapper-comments">
		<h2>These are all your comments</h2>
		<div id="legend">
			<div style="background-color:green">Approved comment</div>
			<div style="background-color:red">Rejected comment</div>
		</div>
		<div id="comments">
			<?php foreach($comments as $comment) { ?>
				<div class="card" id="card_<?= $comment["id"] ?>" style="
					<?= ($comment["isAuthorized"] == 1) ? 'background-color:green;' : "" ?> 
					<?= (!empty($comment["rejectionComment"])) ? 'background-color:red;' : "" ?> "
				>
					<?= (!empty($comment["rejectionComment"])) ? '<p class="rejection-comment">'.$comment["rejectionComment"] : '' ?>
					<div class="card-body">
						<p class="card-text"><?= $comment["content"] ?></p>
					</div>
					<div class="btns">
						<button data-id-comment="<?= $comment["id"] ?>" class="edit-comment btn btn-primary">Edit your comment</button>
						<small>Another validation is needed after editing</small>
						<button data-id-comment="<?= $comment["id"] ?>" class="delete-comment btn btn-danger">Delete your comment</button>
					</div>
				</div>
			<?php } ?>
		</div>
		<div id="edit-comment-div" class="hidden">
			<span id="close-edit-comment" style="color:red;cursor:pointer;font-weight:bold">X</span>
			<h6>Edit your comment</h6>
			<input type="hidden" data-id-comment="">
			<textarea class="form-control" id="edit-comment" style="margin-bottom:5%"cols="30" rows="10"></textarea>
			<button class="btn btn-success" id="submit-edit-comment">Submit edited comment</button>
		</div>
	</div>
	<?php } ?>
</div>

<script type="module">
	import {fct_fetchData} from "./js/mod_ajax.js";

	/*
	Profile Manager
	*/

	let btnEdit = document.getElementById("btn-edit");
	btnEdit.addEventListener("click", () => {
		let divEdit = document.getElementById("edit-profile")
		divEdit.classList.toggle("hidden");
		if (divEdit.classList.contains("hidden")) {
			btnEdit.textContent = "Edit your profile";
		} else {
			btnEdit.textContent = "Cancel changes";
		}
	})
	document.getElementById("submit-change").addEventListener("click", btn => {
		btn.preventDefault();
		fct_fetchData("profile", {
			username: "<?= $_SESSION["username"] ?>",
			github: document.getElementById("github-edit").value,
			description: document.getElementById("description-edit").value,
			newUsername: document.getElementById("username-edit").value
		}).then(data => {
			console.log(data);
			document.getElementById("username").textContent = document.getElementById("username-edit").value.toUpperCase();
			document.getElementById("description").textContent = document.getElementById("description-edit").value;
			document.getElementById("github").href = "http://github.com/" + document.getElementById("github-edit").value;
		})
	})

	/*
	Comment Manager
	*/
	document.querySelectorAll(".edit-comment").forEach(element => {
		element.addEventListener("click", btn => {
			btn.preventDefault();
			let editDiv = document.getElementById("edit-comment-div");
			editDiv.classList.remove("hidden");
			editDiv.querySelector("input[type=hidden]").setAttribute("data-id-comment", btn.target.getAttribute("data-id-comment"));
			editDiv.querySelector("textarea").textContent = btn.target.parentNode.parentNode.querySelectorAll(".card-text")[0].textContent;
			document.getElementById("submit-edit-comment").addEventListener("click", btn => {
				console.log(document.getElementById("edit-comment").value);
				btn.preventDefault();
				fct_fetchData("ajax-comment", {
					route : "edit-comment",
					id : editDiv.querySelector("input[type=hidden]").getAttribute("data-id-comment"),
					content : document.getElementById("edit-comment").value
				}).then(data => {
					console.log(data);
					fct_setAlerte(data.msg, data.typeMsg);
					if (data.typeMsg == "msg-success") {
						let idComment = editDiv.querySelector("input[type=hidden]").getAttribute("data-id-comment");
						let parentDiv = document.querySelector("#card_"+idComment);
						parentDiv.style.background = "inherit";
						parentDiv.querySelectorAll(".rejection-comment")[0].remove();
						parentDiv.querySelectorAll(".card-text")[0].textContent = document.getElementById("edit-comment").value;
					}
				})
			})
		})
	})

	document.getElementById("close-edit-comment").addEventListener("click", span => {
		let editDiv = document.getElementById("edit-comment-div");
		editDiv.classList.add("hidden");
	})

	document.querySelectorAll(".delete-comment").forEach(element => {
		element.addEventListener("click", btn => {
			btn.preventDefault();
			let commentId = btn.target.getAttribute("data-id-comment");
			if (confirm("Are you sure to delete this comment")) {
				fct_fetchData("ajax-comment", {
					route : "delete-comment",
					id : btn.target.getAttribute("data-id-comment")
				}).then (data => {
					console.log(data);
					fct_setAlerte(data.msg, data.typeMsg);
					document.getElementById("card_"+commentId).remove();
				})
			}
		})
	})

</script>