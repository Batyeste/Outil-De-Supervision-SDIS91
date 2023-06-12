<!DOCTYPE html>
<html lang=fr>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>SDIS - Réponse du test</title>
  <link rel=stylesheet href=css\ouif\style.css>
  <link rel="shortcut icon" href="image/sdis-icone.ico">
</head>

<body>


  <?php
  require_once 'enTete.php';
  require_once 'menu.php';
  if (isset($_POST['adrip'])) {
    $adresseIP = $_POST['adrip'];

    // Exécute la commande ping sur l'adresse IP
    $output = shell_exec("ping -n 1 " . $adresseIP);
    // POUR LINUX :  $output = shell_exec("ping -C 1 " . $adresseIP);
    if (strpos($output, "TTL") !== false) {
      // POUR LINUX : if (strpos($output, "ttl") !== false) {
      echo "L'équipement que vous avez pingé/testé est : OK";
    } else {
      echo "L'équipement que vous avez pingé/testé est : NOK";
    }
  }
  ?>

</body>

<footer>
  <?php
  require_once 'piedPage.php';
  ?>
</footer>

</html>