<?php

require_once 'variables.inc';
echo $_POST['typeequipement'].' et '.$_POST['ip'].' et '.$_POST['villes'].' et '.$_POST['modele'];

if (isset($_POST['typeequipement']) && isset($_POST['ip']) && isset($_POST['villes']) && isset($_POST['modele'])){
  $typ = $_POST['typeequipement'];
  $adresseIP = $_POST['ip'];
  $ville = $_POST['villes'];
  $modele = $_POST['modele'];

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO equipement (equ_typeId, equ_adresseIP, equ_locid, equ_modele) 
                            VALUES (:typ, :adresseIP, :ville, :modele)");
    $stmt->bindParam(':typ', $typ);
    $stmt->bindParam(':adresseIP', $adresseIP);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':modele', $modele);
    $stmt->execute();
    echo "Les données ont été insérées avec succès.";
    header("location:index.php");
    echo "Les données ont été insérées avec succès.";
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    header("location:ajouterEquipement.php");
  }

  $conn = null;
 
  
} 
else {
  echo "Veuillez renseigner tous les champs.";
  
  
}
