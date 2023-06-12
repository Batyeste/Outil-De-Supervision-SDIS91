<?php session_start(); 

header("Content-Type: text/html; charset: UTF-8");
require_once 'variables.inc';
$json = "[]";

// $ville = $_GET["ville"]
// $groupement = $_GET["groupement];
if (isset($_POST['villes'])) {
  $idGlobal = $_POST['villes'];
  $idDecoupe = explode("_", $idGlobal);
  $idVilles = $idDecoupe[0];
  $idGrpt = $idDecoupe[1];
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(($idVilles != 54) && ($idVilles != 55) && ($idVilles != 56) && ($idVilles != 57))
    {
      $stmt = $conn->prepare("SELECT equ_id, equ_modele, equ_adresseIP, equ_typeId,  typ_nom, loc_nom
                              FROM equipement 
                              INNER JOIN typeequipement  
                              ON (equ_typeId = typ_Id)
                              INNER JOIN localisation
                              ON (equ_locid = loc_id)
                              WHERE equ_locId = :idVilles");
      $stmt->bindParam(':idVilles', $idVilles);
    }
    else
    {
      $stmt = $conn->prepare("SELECT equ_id, equ_modele, equ_adresseIP, equ_typeId,  typ_nom, loc_nom
                              FROM equipement 
                              INNER JOIN typeequipement  
                              ON (equ_typeId = typ_Id)
                              INNER JOIN localisation
                              ON (equ_locid = loc_id)
                              WHERE loc_groid = :idGrpt");
      $stmt->bindParam(':idGrpt', $idGrpt);
    }
    
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($datas);
  } catch (PDOException $e) {
    echo $json;
  }
  $conn = null;

  echo $json;
}
