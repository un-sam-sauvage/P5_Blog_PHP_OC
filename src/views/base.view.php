<?php
$title = $title ?? 'Homepage';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<title>MyBlog - <?= $title ?></title>
	<style>
		#msg-systeme {
			position: fixed;
			top: 40px;
			left: 100px;
			z-index: 5;
		}
		.msg-success {
			background-color: green;
			color: green;
		}
		.msg-warning {
			background-color: orange;
			color: orangered;
		}
		.msg-fail {
			background-color: red;
			color : darkred;
		}
		.msg {
			width: fit-content;
			padding: 1%;
			color: white;
			border-radius: 20px;
			cursor: pointer;
		}

		.alert {
			background-color: red;
		}

		.success {
			background-color: green;
		}

		.hidden {
			display: none;
		}
		footer {
			position: fixed;
			bottom: 0;
			height: 80px;
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
			background-color: lightgray;
		}
	</style>
	<script src="https://kit.fontawesome.com/1b3c4452ae.js" crossorigin="anonymous"></script>

</head>

<body>
	<?php require_once(__DIR__ . "/partials/nav.view.php"); ?>
	<p id="msg-systeme">
		<?= isset($msgSysteme) ? $msgSysteme : "" ?>
	</p>
	<script type="text/javascript">
		document.getElementById("msg-systeme").addEventListener("click", (div) => {
			div.target.classList = [];
			div.target.textContent = "";
		});

		function fct_setAlerte (msg, className) {
			let msgSysteme = document.getElementById("msg-systeme");
			msgSysteme.classList = [];
			msgSysteme.classList.add("msg");
			msgSysteme.classList.add(className);
			msgSysteme.innerHTML = msg;
		}
	</script>
	<?= $bodyContent ?>
	<?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) require_once(__DIR__ . '/partials/footer.view.php') ?>;
</body>
</html>