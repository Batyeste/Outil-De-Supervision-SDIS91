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
    <title>SDIS - Test d'équipement</title>
    <link rel=stylesheet href=css\ouif\style.css>
    <link rel="shortcut icon" href="image/sdis-icone.ico">
</head>

<body>
    <?php
    include_once 'enTete.php';
    include_once 'menu.php';
    require_once 'variables.inc';
    ?>

    <section>
        <form method="post" action="requeteManu.php">
            <label for="adresseIP">Formulaire pour pinger l'équipement que vous voulez !</label>
            <input name="adrip" id="adrip" type="text" required="required" placeholder="xxx.xxx.xxx.xxx"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '')" maxlength="15">
            <br />
            <button id="id_btn"type="submit">Test de l'équipement</button>
        </form>
    </section>
    <?php
    include_once 'piedPage.php';
    ?>

  <script>

/*    const IP = document.getElementById("adrip")
    const btn_form = document.getElementById("id_btn")
    btn_form.addEventListener("click", () => {
    xhttp.open("POST","requeteManu.php", true)
    let xhttp = new XMLHttpRequest();
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log("requete envoyé")
        }
    };
    let data = 'adrip='+IP.value;

    xhttp.send(data)
});
    */
  </script>
  
</body>

</html>