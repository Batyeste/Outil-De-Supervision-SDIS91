<?php

header('Content-Type: text/html; charset: UTF-8');
require_once 'variables.inc';
$json = "[]";
if (isset($_POST['groupements'])) {
  $locGroupements = $_POST['groupements'];
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM localisation 
                           WHERE loc_groid = :locGroupements");
    $stmt->bindParam(':locGroupements', $locGroupements);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($datas);
  } catch (PDOException $e) {
    echo $json;
  }
  $conn = null;
  echo $json;
}
