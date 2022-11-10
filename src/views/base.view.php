<?php
$title = $title ?? 'Homepage'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog - <?= $title ?></title>
    <style>
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
    <?= $bodyContent ?>
</body>

</html>