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
  
      if ($proDroitUtilisateur != 3) {
          header('Location: ../index.php');
          exit;
      }
  } else {
      header('Location: ../index.php');
      exit;
  }

?>
<!DOCTYPE html>
<html lang="fr">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width">
      <title>SDIS - Ajout d'utilisateur</title>
      <link rel=stylesheet href=css\ouif\style.css>
      <link rel="shortcut icon" href="image/sdis-icone.ico">
</head>


<body>
      <?php
      include_once 'enTete.php';
      include_once 'menu.php';
      ?>
      <section>
            <form method="post" action="insererUtilisateurBD.php">
                  <div>
                        <label>Login</label>
                        <input id="login" name="login" placeholder="Login" type="text" required="required">
                  </div>
                  <div>
                        <label>Mot de passe</label>
                        <input id="pwd" name="pwd" placeholder="Mot de passe" type="password" required="required">
                  </div>
                  <div>
                        <label>Droit de l'utilisateur</label>
                        <select name="droit" id="droit">
                              <option disabled selected="" disabled selected>Accès :</option>
                              <option value="1">Rajout d'équipement</option>
                              <option value="2">Supervision uniquement</option>
                              <option value="3">Administrateur</option>
                        </select>
                       
<?php
/* <select id="droit"  name="droit">

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT int_id, typ_nom FROM intervenir");
  $stmt->execute();
  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($datas as $data) {
    echo "<option value=\"" . $data['typ_id'] . "\">" . $data['typ_nom'] . "</option>";
  }
} catch (PDOException $e) {
  echo "<option value=\"\">Erreur de chargement</option>";
}
$conn = null;</select>
*/
?>





                        <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block">Valider</button>
                        </div>
                  </div>
            </form>
      </section>
      <?php
      include_once 'piedPage.php';
      ?>
</body>

</html>