<?php
session_start();?>

<!DOCTYPE html>
<html lang=fr>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>SDIS - Supprimé</title>
  <link rel=stylesheet href=aa\ah.css>
  <link rel="shortcut icon" href="image/sdis-icone.ico">
  <?php
  include_once 'enTete.php';
  ?>
</head>

<body>
  <?php
require_once 'variables.inc'; 
include_once 'menu.php';
//$id = $_POST['test'];
//echo". $id";
if(isset($_POST['equ_idm']))
{
  foreach( $_POST['equ_idm'] as $val ) 
  { 
    $stmt = $conn->prepare("DELETE FROM `equipement`  WHERE `equ_id` = :id  ");
    $stmt->bindParam(':id', $val);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      echo "Les informations ont été supprimée avec succès.";
    } else {
      echo "Les informations n'ont pas été trouvée.";
    }
  }
}
else
{
  echo "Il y a un problème";
} 

?>
</body>

<footer>
  <?php 
  include_once 'piedPage.php';
  ?>
</footer>