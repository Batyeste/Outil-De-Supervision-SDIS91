<?php
session_start();

if (!isset($_SESSION['nom'])) {
  header('Location: ../index.php');
  exit;
}

include_once 'variables.inc';

$proDroitUtilisateur = $_SESSION['nom'];
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT pro_droit FROM profil WHERE pro_nom = :nom");
$stmt->bindParam(':nom', $proDroitUtilisateur);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $proDroitUtilisateur = $row['pro_droit'];

  if ($proDroitUtilisateur != 1 && $proDroitUtilisateur != 2 && $proDroitUtilisateur != 3) {
    header('Location: ../index.php');
    exit;
  }
} else {
  header('Location: ../index.php');
  exit;
} ?>

<!DOCTYPE html>
<html lang=fr>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>SDIS - Équipement</title>
  <link rel=stylesheet href=aa\ah.css>
  <link rel="shortcut icon" href="image/sdis-icone.ico">
</head>

<body>

  <?php
  require_once 'variables.inc';
  include_once 'enTete.php';
  include_once 'menu.php';
  include_once 'pingEqu.php';

// Ce qui permet de choisir les groupements (id=resultats)
// Suivis de la création du tableau / des cases 
  echo "
<div id=resultats>
    <div class='container2'>
        <label for='Groupement'>Groupement
        </label>
          <select name='groupement' id='groupements' class='form-select'>
            <option value='1'>Est</option>
            <option value='2'>Nord</option>
            <option value='4'>Sud</option>
            <option value='3'>Centre</option>
          </select>
          <br>
          <label for='Villes'>Villes
          </label>
          <select name='villes' id='villes' class='form-select'>
          </select>
    </div>
</div>

<div>
<form method='post' action='supprimerDb.php'>
    <div class='input-group mb-3'>
    
    </div>
      <table class='table-sm table-bordered table-striped table-hover'>
        <thead>
          <tr>
          <th>Etat</th>
          <th>Type d'équipement</th>
          <th>Adresse IP</th>
          <th>Modèle</th>
          <th>Ville</th>  
          <th> 
          <input class='supprim' type='submit' id='btnDelete' name='delete' value='Supprimer !' />
          </th>
          </tr>
        </thead>
        <tbody id='equipements'>
        </tbody>
      </table>   
</div>
</form>
";

  include_once 'afficher.php';

  //var_dump($_POST);
  ?>
</body>

<footer>
  <?php
  include_once 'piedPage.php';
  ?>
</footer>

</html>