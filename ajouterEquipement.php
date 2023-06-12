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

  if ($proDroitUtilisateur != 1 && $proDroitUtilisateur != 3) {
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
  <title>SDIS - Ajout d'équipement</title>
  <link rel=stylesheet href=css\ouif\style.css>
  <link rel="shortcut icon" href="image/sdis-icone.ico">
  <script src="insertionville.js" defer></script>
</head>

<body>
  <?php
  require_once 'variables.inc';
  include_once 'enTete.php';
  include_once 'menu.php';
  ?>

  <body>
    <div class="container">
      <form action="insertionEquipement.php" method="post" class="centerform">
        <label for="groupements">Groupement :</label>
        <select name="groupements" required="required" id="groupements">
          <option value="">Sélectionnez un groupement</option>
          <?php
          require_once 'variables.inc';
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT gro_id, gro_nom FROM groupement");
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datas as $data) {
              echo "<option value=\"" . $data['gro_id'] . "\">" . $data['gro_nom'] . "</option>";
            }
          } catch (PDOException $e) {
            echo "<option value=\"\">Erreur de chargement</option>";
          }
          $conn = null;
          ?>
        </select>
        <br />


        <label for="villes">Ville :</label>
        <select name="villes" required="required" id="villes"></select>
        <br />

        <!--  FORMULAIRE POUR METTRE L'ADRESSE IP -->
        <label for="adresseIP">Adresse IP :</label>
        <input name="ip" id="ip" type="text" required="required" placeholder="xxx.xxx.xxx.xxx" pattern="((^|\)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" maxlength="15">
        <br />


        <!--  SCRIPT POUR VERIFIER ET SUPPRIMER LES ELEMENTS INDESIRABLES DES IP -->
        <script>
          const form = document.querySelector("form");
          const input = document.getElementById("ip");

          input.addEventListener("input", handleInput);
          form.addEventListener("submit", handleSubmit);

          /**
           * Vérifie les caractères lors de la saisie, si un caractère est ni un nombre, ni un point, on le supprime
           */
          function handleInput(e) {
            console.log(e.data);

            if (!(isFinite(e.data) || e.data === ".")) {
              input.value = input.value.slice(0, -1);
            }
          }
        </script>

        <!--  FORMULAIREDE SELECTION D'EQUIPEMENT  -->
        <label for="typeequipement">Sélectionnez un type d'équipement :</label>
        <select id="typeequipement" required="required" name="typeequipement">

          <?php
          //
          require_once 'variables.inc';
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT typ_id, typ_nom FROM typeequipement");
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($datas as $data) {
              echo "<option value=\"" . $data['typ_id'] . "\">" . $data['typ_nom'] . "</option>";
            }
          } catch (PDOException $e) {
            echo "<option value=\"\">Erreur de chargement</option>";
          }
          $conn = null;
          ?>
        </select>

        <!--  FORMULAIRE POUR METTRE LA REFERENCE DE L'EQUIPEMENT -->
        <br />
        <label for="modele">Référence de l'équipement :</label>
        <input name="modele" required="required" id="modele" placeholder="Référence"></select>
        <br />

        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
        </div>
      </form>
    </div>

  </body>
  <footer>
    <?php
    include_once 'piedPage.php';
    ?>
  </footer>

</html>