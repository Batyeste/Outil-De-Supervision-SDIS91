<!--  --->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php session_start();
if (!isset($_SESSION['nom']) || $_SESSION['nom'] != 'Administrateur' && $_SESSION['nom'] != 'Terminal' && $_SESSION['nom'] != 'Supervision') {
  echo '<script type="text/javascript"> window.alert("Non");</script>';
  header('Location: ../index.php');
  exit;
}?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>SDIS - Équipement</title>
    <link rel=stylesheet href=css\ouif\style.css>
    <link rel="shortcut icon" href="image/sdis-icone.ico">
</head>
<body>

<?php
require_once 'variables.inc';
include_once 'enTete.php';
include_once 'menu.php';

//include_once 'jquery.js';

///////////////////// Choix des groupements ///////////////////////
echo "

  <form method=\"POST\" action=\"afficherEquipements.php\" id=\"form\">
    <div>
    <select name=\"groupement\" id=\"group\">";
?>
<option value="Est" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Est') echo 'selected'; ?>>Est</option>
<option value="Sud" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Sud') echo 'selected'; ?>>Sud</option>
<option value="Centre" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Centre') echo 'selected'; ?>>Centre</option>
<option value="Nord" <?php if (isset($_POST['groupement']) && $_POST['groupement'] == 'Nord') echo 'selected'; ?>>Nord</option>
<option value="Tous" <?php if (!isset($_POST['groupement']) || $_POST['groupement'] == 'Tous') echo 'selected'; ?>>TOUS</option>
</select>
<?php
echo "  </div>
  </form>";
///////////////////// Script tableau automatique ///////////////////////
?>
<script>
  document.getElementById("group").addEventListener("change", function() {
    document.getElementById("form").submit();
  });
  $(document).ready(function() {

    $("#btnDelete").click(function() {
      alert('j ai supp un id');

      $.ajax({
        type: "POST",
        url: 'requeteSQLPourverif.php?id=' + id,
        // data
        data: str,
        success: function(response) {
          alert(response);
          if (response == 'ok')
            // recuperation id dynamique 
            $('#test-METTREICILEBONID').style('background-color:pink');
          /*$('#'+<?php // echo $id; 
                  ?>)*/
        }

      });

    });
    $(".test").click(function() {


      $.ajax({
        type: "POST",
        url: 'requeteSQLPourverif.php',
        // data

        success: function(response) {
          alert(response);
          if (response == 'ok')
            $('.test').text('test');
          //alert('jE SUIS une alerte');

        }

      });
    });
  });
</script>

<?php
echo "
</body>

<!--- Tableau --->
 <form method='POST' action='#'>
  <section>
<table>
<thead>
  <tr>
    <th>Etat de l'équipement</th> 
    <th>Type d'équipement</th>
    <th>Adresse IP</th>
    <th>Modèle</th>
    <th>Ville</th>
    <th>Groupement</th> 
    <th> <input type='submit' id='btnDelete' name='delete' Value='Supprimer !'/> </th>
  </tr>
</thead><tbody>";

try {
  $delay = 1;

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  ///////////////////// Sélection des groupements //////////////////
  if (isset($_POST['groupement'])) {
    $groupement = $_POST['groupement'];
  }

  ///////////////////// Groupement Est ///////////////////////
  if (isset($_POST['groupement']) && $_POST['groupement'] == "Est") {
    $stmt = $conn->query("SELECT `equ_id`,`equ_adresseIP`,`equ_modele`,`typ_nom`,`loc_nom`,`gro_nom`,`gro_id`
    FROM equipement 
    INNER JOIN typeequipement ON (`equ_typeid` = `typ_id`) 
    INNER JOIN localisation ON (`equ_locid` = `loc_id`)
    INNER JOIN groupement ON (`loc_groid` = `gro_id`)
    WHERE `gro_id` = '1';
 ");

    ///////////////////// Groupement Centre ///////////////////////    
  } elseif (isset($_POST['groupement']) && $_POST['groupement'] == "Centre") {
    $stmt = $conn->query("SELECT `equ_id`,`equ_adresseIP`,`equ_modele`,`typ_nom`,`loc_nom`,`gro_nom`,`gro_id`
    FROM equipement 
    INNER JOIN typeequipement ON (`equ_typeid` = `typ_id`) 
    INNER JOIN localisation ON (`equ_locid` = `loc_id`)
    INNER JOIN groupement ON (`loc_groid` = `gro_id`)
    WHERE `gro_id` = '3';
 ");
    /*                     POUR CHOSIR LA VILLE MAIS NE MARCHE PAS A FAIRE EN JS
    echo "<form method=\"post\" action=\"afficherEquipements.php\"> 
      <label for=\"vil\">Choisir la ville :</label><br />
      <select name=\"vil\" id=\"vil\">";

    $reponse = $conn->query("SELECT `loc_nom`,`loc_Id` 
    FROM localisation 
    INNER JOIN equipement ON (`equ_locId` = `loc_Id`) 
    INNER JOIN groupement
    WHERE gro_nom ='Centre';");



    while ($donnees = $reponse->fetch()) {
      echo "<option value=" . $donnees['loc_nom'] . ">" . $donnees['loc_nom'] . "</option>";
    }

    echo "
      </select>
    </form>";
*/
    ///////////////////// Groupement Sud ///////////////////////    
  } elseif (isset($_POST['groupement']) && $_POST['groupement'] == "Sud") {
    $stmt = $conn->query("SELECT `equ_id`,`equ_adresseIP`,`equ_modele`,`typ_nom`,`loc_nom`,`gro_nom`,`gro_id`
    FROM equipement 
    INNER JOIN typeequipement ON (`equ_typeid` = `typ_id`) 
    INNER JOIN localisation ON (`equ_locid` = `loc_id`)
    INNER JOIN groupement ON (`loc_groid` = `gro_id`)
    WHERE `gro_id` = '4';
 ");


    ///////////////////// Groupement Nord ///////////////////////    
  } elseif (isset($_POST['groupement']) && $_POST['groupement'] == "Nord") {
    $stmt = $conn->query("SELECT `equ_id`,`equ_adresseIP`,`equ_modele`,`typ_nom`,`loc_nom`,`gro_nom`,`gro_id`
    FROM equipement 
    INNER JOIN typeequipement ON (`equ_typeid` = `typ_id`) 
    INNER JOIN localisation ON (`equ_locid` = `loc_id`)
    INNER JOIN groupement ON (`loc_groid` = `gro_id`)
    WHERE `gro_id` = '2';
 ");

    ///////////////////// Tout les Groupements  ///////////////////////    
  } else {
    $stmt = $conn->prepare("SELECT `equ_id`,`equ_adresseIP`,`equ_modele`,`typ_nom`,`loc_nom`,`gro_nom`,`gro_id`
    FROM equipement 
    INNER JOIN typeequipement ON (`equ_typeid` = `typ_id`) 
    INNER JOIN localisation ON (`equ_locid` = `loc_id`)
    INNER JOIN groupement ON (`loc_groid` = `gro_id`);");

    $reponse = $conn->query("SELECT `loc_nom`,`loc_Id` 
    FROM localisation 
    INNER JOIN equipement 
    ON (`equ_locId` = `loc_Id`) ");
  }
  $stmt->execute();
  ////////////////////// Affiche les données dans le tableau ///// //////////<td class='etat'>" . $row['id'] . "</td>
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
 <td class='" . (isset($pingresult[$row['equ_adresseIP']]) ? ($pingresult[$row['equ_adresseIP']] == 'OK' ? 'ok' : 'nok') : '') . " test'>" . (isset($pingresult[$row['equ_adresseIP']]) ? ($pingresult[$row['equ_adresseIP']] == 'OK' ? 'OK' : 'NOK') : '') . "</td>
          <td>" . $row['typ_nom'] . "</td>
          <td>" . $row['equ_adresseIP'] . "</td>
          <td>" . $row['equ_modele'] . "</td>
          <td>" . $row['loc_nom'] . "</td>
          <td>" . $row['gro_nom'] . "</td>";
  

echo"
<td>
<input type='checkbox' name='supprimer_idequ[]' value='" . $row['equ_id'] . "'> 
</td>
    </tr>";
  }
} catch (PDOException $e) {
  echo "<p>Echec de l'affichage :" . $e->getMessage() . "</p>\n";
}
echo "</form>";
//////////////// POUR SUPPRIMER ////////////////////
if (isset($_POST["supprimer_idequ"])) {
  foreach ($_POST["supprimer_idequ"] as $idequipement) {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    ////////////////////// REQUETE SQL DE SUPPRESSION //////////////////
    $SQL_supprimer = $conn->prepare("DELETE FROM equipement WHERE equ_id = :suppEqu");
    $SQL_supprimer->bindParam(':suppEqu', $idequipement);
    $SQL_supprimer->execute();
  }
}

?>

<?php


"</form>";
$conn = null;

echo "</tbody>
     </table>
    </section>";

include_once 'piedPage.php';

?>


</html>