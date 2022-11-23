<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php foreach ($posts as $post) { ?>
		<div>
			<h4 class="post-title"><?= $post["title"] ?></h4>
			<p class="post-content"><?= $post["content"] ?></p>
		</div>
	<?php } ?>
</body>
</html>