<div class="container" style="padding-top:2%;">

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

<script type="module">
	import {
		fct_fetchData
	} from "./js/mod_ajax.js";
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
</script>