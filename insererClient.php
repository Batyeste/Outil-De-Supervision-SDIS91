<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Formulaire de rajout d'équipements</title>
  <link rel="stylesheet" href="css\ouif\style.css">
</head>

<?php session_start();


require_once 'variables.inc';

if (!isset($_SESSION['nom'])) {
  header("location:index.php");
}

include_once 'enTete.php';
include_once 'menu.php';

// Connexion à la base de données
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
  echo "Erreur de connexion : " . $e->getMessage();
}

?>
<script>
  document.getElementById("group").addEventListener("change", function() {
    document.getElementById("form").submit();
  });
</script>



<body>
  <div>
    <select name="groupement" id="group">";
      <option value="Est" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Est') echo 'selected'; ?>>Est</option>
      <option value="Sud" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Sud') echo 'selected'; ?>>Sud</option>
      <option value="Centre" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Centre') echo 'selected'; ?>>Centre</option>
      <option value="Nord" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Nord') echo 'selected'; ?>>Nord</option>
    </select>
    <form method="POST" required="required" action="insererClientBD.php" id="form">
    </form>

  </div>

  <div>
    <label>IP</label>
    <input id="IP" name="IP" placeholder="xxx.xxx.xx.xxx">
  </div>
  <div>
    <div>
      <select name="typeEqu" id="typeEqu">
        <option value="2"><?php if (isset($_POST['typeEqu']) && $_POST['typeEqu'] == '2') echo 'selected'; ?>Imprimante</option>
        <option value="1"><?php if (isset($_POST['typeEqu']) && $_POST['typeEqu'] == '1') echo 'selected'; ?>IPBX</option>
        <option value="5"><?php if (isset($_POST['typeEqu']) && $_POST['typeEqu'] == '5') echo 'selected'; ?>Onduleur</option>
        <option value="3"><?php if (isset($_POST['typeEqu']) && $_POST['typeEqu'] == '3') echo 'selected'; ?>Espion BIP</option>
        <option value="4"><?php if (isset($_POST['typeEqu']) && $_POST['typeEqu'] == '4') echo 'selected'; ?>Programatteur BIP</option>
      </select>
    </div>
    <label>Modele</label>
    <input id="modele" name="modele" placeholder="Modèle">
  </div>
  <div>
    <label>Ville</label>

    <div>
      <button type="submit">Valider</button>
    </div>
    </form>
    <?php
    include_once 'piedPage.php';
    ?>
</body>

</html>