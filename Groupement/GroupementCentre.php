<?php session_start();

echo "<!DOCTYPE html>
<html lang=\"fr\">

<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width\">
  <title>Equipement</title>
  <link rel=\"stylesheet\" href=\"\css\ouif\style.css\">

</head>

<body>";

require_once '..\variables.inc';
include_once '..\enTete.php';
include_once '..\menu.php';

try {
    $delay = 1;
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Requête SQL pour récupérer les équipements du groupe "Centre"
    $sql = "SELECT   loc_nom,equ_typeId,equ_adresseIP, equ_modele,typ_nom FROM equipement INNER JOIN typeequipement  ON (`equ_typeId` = `typ_Id`) JOIN localisation ON equipement.equ_locId = localisation.loc_Id WHERE loc_groupement = 'Centre'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    echo "<div class=\"Groupement\">Groupement Centre</div> ";

    // Affichage des résultats dans un tableau
    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>
             <th>Ville</th>
             <th>Nom</th>
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

include_once '..\piedPage.php';

echo "
</html>";
