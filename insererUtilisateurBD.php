<?php
session_start();
require_once 'variables.inc';

if (isset($_POST['login']) &&  isset($_POST['pwd']) && isset($_POST['droit'])) {
  $droit = $_POST['droit'];
  $login = $_POST['login'];
  $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le nom d'utilisateur est déjà pris
    $stmt = $conn->prepare("SELECT * FROM profil WHERE pro_nom = :pro_nom");
    $stmt->bindParam(':pro_nom', $login);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      // Si le nom d'utilisateur est déjà pris, afficher un message d'erreur
      $message = "Le nom d'utilisateur est déjà pris, veuillez en choisir un autre";
    } else {

      $stmt = $conn->prepare("INSERT INTO profil (pro_nom, pro_passe, pro_droit)
   VALUES (:pro_nom, :pro_passe, :pro_droit)");
      $stmt->bindParam(':pro_nom', $login);
      $stmt->bindParam(':pro_passe', $pwd);
      $stmt->bindParam(':pro_droit', $droit);
      $stmt->execute();
      $message = "Insertion(s) effectée(s) : " . $stmt->rowCount();
      header("location:index.php");

      
    }
  } catch (PDOException $e) {
    $message = "Echec de l'insertion :" . $e->getMessage();
  }
  $conn = null;
} else {
  $message = "Toutes les données doivent être renseignées";
}

echo "<p>" . $message . "</p>\n";
echo "</section>\n";


