<h1>Welcome to your profile <span id="username"><?= strtoupper($_SESSION["username"]) ?></span> !</h1>
<p id="description"><?= $userInfos["description"] ?> </p>
<a href="github.com/<?= $userInfos["github"] ?>" id="github">Github Page</a>
<button id="btn-edit">Edit your profile</button>
<div id="edit-profile" class="hidden">
	<label for="">Change your username (must be unique)</label>
	<input type="text" id="username-edit" value="<?= $_SESSION["username"] ?>">
	<label for="">Add you Github Account</label>
	<input type="text" id="github-edit" value="<?= $userInfos["github"] ?>">
	<label for="">Change your description</label>
	<textarea id="description-edit" cols="30" rows="10"><?= $userInfos["description"] ?></textarea>
	<button id="submit-change">Validate new infos</button>
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
		fct_fetchData("updateProfile.ajax.php", {
			username: "<?= $_SESSION["username"] ?>",
			github: document.getElementById("github-edit").value,
			description: document.getElementById("description-edit").textContent,
			newUsername: document.getElementById("username-edit").value
		}).then(console.log)
	})
</script>