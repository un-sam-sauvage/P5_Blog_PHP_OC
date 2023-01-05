<style>
	.btns {
		display: inline;
	}

	#wrapper-reject {
		background-color: #0d6efdAA;
		position: fixed;
		top: 5%;
		left: 0px;
		width: 100%;
		height: 100%;
		padding: 8% 35%;
	}

	#div-reject-comment{
		background: lightgrey;
		border: 1px solid gray;
		border-radius: 25px;
		padding: 2%;
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	#wrapper-reject.hidden{
		display: none;
	}

	#reject-comment {
		margin-bottom: 3%;
	}
	#confirm-reject {
		width: fit-content;
		margin: 0 auto;
	}
</style>
<div class="container" style="padding-top:2%">
	<?php foreach($comments as $comment) {?>
		<div class="card" style="width:18rem; margin-bottom:2rem;" id="<?= $comment["id"] ?>">
			<div class="card-body">
				<p class="card-text"><?= $comment["content"] ?></p>
				<p>By <span class="text-muted"><?= $comment["username"] ?></span></p>
			</div>
			<div class="btns">
				<button class="validate btn btn-success">Validate</button>
				<button class="reject btn btn-danger">Reject</button>
			</div>
		</div>
	<?php } ?>
</div>
<div id="wrapper-reject" class="hidden">
	<span id="close-reject" style="color:red;font-weight:bold;cursor:pointer;">X</span>
	<div id="div-reject-comment" class="form-group">
		<input type="hidden" id="comment-id">
		<input type="text" class="form-control" id="reject-comment" placeholder="explain briefly the rejection">
		<button id="confirm-reject"class="btn btn-danger">Reject this comment</button>
	</div>
</div>
<script type="module">
	import {fct_fetchData} from "/js/mod_ajax.js";

	document.querySelectorAll(".validate").forEach(element => {
		element.addEventListener("click", btn => {
			btn.preventDefault();
			fct_fetchData("ajax-comment", {
				route : "validate-comment",
				id : btn.target.parentNode.parentNode.id
			}).then(data => {
				console.log(data);
				fct_setAlerte(data.msg, data.typeMsg)
				btn.target.parentNode.parentNode.remove();
			})
		})
	})

	document.querySelectorAll(".reject").forEach(element => {
		element.addEventListener("click", btnClicked => {
			btnClicked.preventDefault();
			document.getElementById("wrapper-reject").classList.toggle("hidden");
			document.getElementById("comment-id").value = btnClicked.target.parentNode.parentNode.id;
		})
	})

	document.getElementById("confirm-reject").addEventListener("click", btn => {
		btn.preventDefault();
		fct_fetchData("ajax-comment", {
			route : "reject-comment",
			id : document.getElementById("comment-id").value,
			comment : document.getElementById("reject-comment").value
		}).then(data => {
			console.log(data);
			fct_setAlerte(data.msg, data.typeMsg)
			document.getElementById("wrapper-reject").classList.toggle("hidden");
			document.getElementById(document.getElementById("comment-id").value).remove();
		})
	})
	document.getElementById("close-reject").addEventListener("click", () => {
		document.getElementById("wrapper-reject").classList.add("hidden");
	})
</script>