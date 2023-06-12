<?php
require_once 'variables.inc';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->query("SELECT equ_adresseip FROM equipement");
$stmt->execute();
$ips = $stmt->fetchAll(PDO::FETCH_COLUMN);

foreach ($ips as $ip) {
    $pingresult[$ip] = shell_exec("ping -n 1 $ip");
                    // SOUS LINUX : ping -c 1 $ip
    if (strpos($pingresult[$ip], "TTL") !== false) {
                    // SOUS LINUX : "ttl"
        $pingresult[$ip] = "OK";
    } else {
        $pingresult[$ip] = "NOK";
    }
}
/* Encode les résultats en JSON */ 
$pingresultJson = json_encode($pingresult);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <script>
    var pingresult = <?php echo $pingresultJson; ?>;

        setTimeout(function() {
            location.reload();
        }, 18000000);
    </script>
</head>

<body>
</body>

</html>