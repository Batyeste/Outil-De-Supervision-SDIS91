<?php if (session_status() === PHP_SESSION_NONE) {
  session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>SDIS - Connecté</title>
    <link rel=stylesheet href=css\ouif\style.css>
    <link rel="shortcut icon" href="image/sdis-icone.ico">
</head>

<body>
    <?php
    include_once 'enTete.php';
    include_once 'menu.php';
    ?>
    <div class="PHOTOSDIS">
    <img src="image/sdis.png"/>
    </div>

</body>

<footer>
    <?php
    include_once 'piedPage.php';
    ?>
</footer>

</html>