<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include_once 'variables.inc';
if (isset($_SESSION['nom'])) {
  $utilisateur = $_SESSION['nom'];
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT pro_droit FROM profil WHERE pro_nom = :nom");
  $stmt->bindParam(':nom', $utilisateur);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $droit = $row['pro_droit'];
  }


  $message = "Vous êtes connecté en tant que : " . $_SESSION['nom'] . "\n";
  $menuConnexion = "<a href='..\deconnecter.php'>Déconnexion</a>\n";
  echo  "<div class=\"encadre\"> <h3> $message </h3> </div> 
  <style> 
  .encadre h3
  { 
    background-color: rgb(0, 0, 0); 
    border: 2px solid #ff0000; 
    padding: 10px; 
    display: inline-block; 
  } 
    </style>";
} else {
  $menuConnexion = "<a href='seConnecter.php'>Connexion</a>";
}



echo "<nav>
  <ul>
    <li>
      <a href=\".\index.php\">Accueil</a>
    </li>";
if ((isset($_SESSION['nom']) AND $droit == 3)) {
  echo "<li>
      <a href='.\aaficherEquipements.php'>Afficher les équipements</a>
    </li>
    <li>
      <a href='requetePing.php'>Tester un équipement</a>
    </li>
    <li>
      <a href='.\ajouterEquipement.php'>Ajouter un équipement</a>
    </li>
    <li>
      <a href='.\insererUtilisateur.php'>Ajouter un utilisateur</a>
    </li>
    <li class=\"menu-deroulant\">
      <a>Tous les groupements</a>
      <ul class=\"sous-menu\">                
        <li><a href=\".\GroupementNord.php\">Groupement Nord</a></li>
        <li><a href=\".\GroupementSud.php\">Groupement Sud</a></li>
        <li><a href=\".\GroupementEst.php\">Groupement Est</a></li>
        <li><a href=\".\GroupementCentre.php\">Groupement Centre</a></li>
      </ul>
    </li>";
} elseif ((isset($_SESSION['nom']) AND $droit == 1)) {
  echo "<li>
  <a href='.\aaficherEquipements.php'>Afficher les équipements</a>
</li>";
  echo "<li>
  <a href='requetePing.php'>Tester un équipement</a>
</li>";
  echo "<li>
      <a href='.\ajouterEquipement.php'>Ajouter un équipement</a>
    </li>";
  echo "<li class=\"menu-deroulant\">
    <a>Tous les groupements</a>
    <ul class=\"sous-menu\">                
      <li><a href=\".\GroupementNord.php\">Groupement Nord</a></li>
      <li><a href=\".\GroupementSud.php\">Groupement Sud</a></li>
      <li><a href=\".\GroupementEst.php\">Groupement Est</a></li>
      <li><a href=\".\GroupementCentre.php\">Groupement Centre</a></li>
    </ul>
   </li>";
} elseif ((isset($_SESSION['nom']) AND $droit == 2)) {
  echo "<li>
      <a href='.\aaficherEquipements.php'>Afficher les équipements</a>
    </li>";
}

echo "<li>$menuConnexion</li>";
echo "</ul>
</nav>";
?>