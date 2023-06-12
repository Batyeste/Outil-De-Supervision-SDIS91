<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Insertion d'equipement </title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if (!isset($_SESSION['nom'])) {
        header("location:index.php");
    }
    require_once 'variables.inc';
    include_once 'enTete.php';
    include_once 'menu.php';
    echo "<section>\n";

    if (isset($_POST['IP'])   &&   isset($_POST['typeEqu'])   &&  isset($_POST['modele'])) {

        $IP = $_POST['IP'];
        $typeEqu = $_POST['typeEqu'];
        $modele = $_POST['modele'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifier si l'IP est déjà pris
            $stmt = $conn->prepare("SELECT * FROM equipement WHERE equ_adresseIP = :equ_adresseIP");
            $stmt->bindParam(':equ_adresseIP', $IP);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // Si l'IP est déjà pris, afficher un message d'erreur
                $message = "L'adresse IP est déjà pris, veuillez en choisir un autre";
            } else {

                $stmt = $conn->prepare("INSERT INTO equipement ( `equ_adresseIp`, `equ_typeId, `equ_modele`` )
            VALUES ( :IP, :typeEqu, :modele)");

                $stmt->bindParam(':IP', $IP);
                $stmt->bindParam(':typeEqu', $typeEqu);
                $stmt->bindParam(':modele', $modele);


                $stmt->execute();

                $message = "Insertion(s) effectuée(s) : " . $stmt->rowCount();
                header("location:afficherClients.php");
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

    include_once 'piedPage.php';

    ?>
</body>

</html>