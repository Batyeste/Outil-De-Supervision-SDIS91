<?php session_start();

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
  
      if ($proDroitUtilisateur != 1  && $proDroitUtilisateur != 3) {
          header('Location: ../index.php');
          exit;
      }
  } else {
      header('Location: ../index.php');
      exit;
  } 

echo "<!DOCTYPE html>
<html lang=\"fr\">

<head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width'>
      <title>SDIS - Nord</title>
      <link rel=stylesheet href=css\ouif\style.css>
      <link rel='shortcut icon' href='image/sdis-icone.ico'>
</head>
<body>";

require_once 'variables.inc';
include_once 'enTete.php';
include_once 'menu.php';

try {
    $delay = 1;
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Requête SQL pour récupérer les équipements du groupement "Nord" \\
    $sql = "SELECT loc_nom, equ_typeId, equ_adresseIP, equ_modele, typ_nom
    FROM equipement
    INNER JOIN typeequipement 
    ON (equ_typeId = typ_Id)
    JOIN localisation 
    ON equipement.equ_locId = localisation.loc_Id
    JOIN groupement 
    ON localisation.loc_groid = groupement.gro_id
    WHERE gro_id = '2'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    echo "<h2> Groupement Nord</h2> ";

    // Pour afficher les résultats dans un tableau \\
    if (count($result) > 0) {
        echo "<table class='tablegroupement'>";
        echo "<tr>
             <th>Ville</th>
             <th>Type d'équipement</th>
             <th>Adresse IP</th>
             <th>Modèle</th>
           </tr>";
        foreach ($result as $row) {
            echo "<tr>
                 <td>" . $row["loc_nom"] . "</td>
                 <td>" . $row["typ_nom"] . "</td>
                 <td>" . $row["equ_adresseIP"] . "</td>
                 <td>" . $row["equ_modele"] . "</td>
               </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
} catch (PDOException $e) {
    echo "<p>Echec de l'affichage :" . $e->getMessage() . "</p>\n";
}

$conn = null;
?>

<footer>   
    <?php 
    include_once 'piedPage.php';
    ?>
</footer>



</html>