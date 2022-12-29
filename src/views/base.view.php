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
			top: 20px;
			left: 50px;
			z-index: 5;
		}
		.msg-success {
			background-color: lightgreen;
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
	</style>
</head>

<body>
	<?php require_once(__DIR__ . "/partials/nav.view.php"); ?>
	<p id="msg-systeme">
		<?= isset($msgSysteme) ? $msgSysteme : "" ?>
	</p>
	<?= $bodyContent ?>
</body>

</html>