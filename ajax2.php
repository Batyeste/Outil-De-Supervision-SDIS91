<?php session_start();

echo "<!DOCTYPE html>
<html lang=\"fr\">

<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width\">
  <title>Equipement</title>
  <link rel=\"stylesheet\" href=\"css\ouif\style.css\">
  
</head>
<body>";
require_once 'variables.inc';
include_once 'enTete.php';
include_once 'menu.php';

echo "<div id=resultats>
      <label for='Groupement'>Groupement</label>
      <div class='container'>\n
      <div class='input-group mb-3'>\n
      <select name='groupement' id='groupements' class='form-select'>\n
      <option value='1'>Est</option>
      <option value='2'>Nord</option>
      <option value='4'>Sud</option>
      <option value='3'>Centre</option>
      </select>";
    
echo "
</div>
</div>

<div>
  <label for=\'Villes\'>Villes</label>
  <div class='container'>\n
    <div class='input-group mb-3'>\n
      <select name='villes' id='villes' class='form-select'>\n";
echo "
      </select>
    </div>
    <table class='table-sm table-bordered table-striped table-hover'>
      <thead>
        <tr>
          <th>Type d'équipement</th>
          <th>AdresseIP</th>
          <th>Modèle</th>
       </tr>
      </thead>
      <tbody id='equipements'>
      </tbody>\n
    </table>\n
  </div>
</div>";

include_once 'piedPage.php';
include_once 'script.php';
//var_dump($_POST);
?>
</body>
</html>