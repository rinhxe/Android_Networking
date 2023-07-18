<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/290fc3f375.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./view/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php require('./view/header.php') ?>
    <?php require('./view/banner.php') ?>
    <?php require('./view/body.php') ?>
    <?php require('./view/footer.php') ?>
</body>

</html>