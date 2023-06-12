<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>TEST</title>
    <link rel="stylesheet" href="css\ouif\style.css">
    <style>
        .ok {
            background-color: green;
        }

        .nok {
            background-color: red;
        }
    </style>
    <script>
        setTimeout(function () {
            location.reload();
        }, 3000000);
    </script>
</head>

<body>
    <?php
    require_once 'variables.inc';

    $pingresult = array();

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT equ_adresseip FROM equipement");
    $stmt->execute();
    $ips = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($ips as $ip) {
        $pingresult[$ip] = shell_exec("ping -n 1 $ip");
        if (strpos($pingresult[$ip], "TTL") !== false) {
            $pingresult[$ip] = "OK";
        } else {
            $pingresult[$ip] = "NOK";
        }
    }
    ?>

    <!-- afficher les résultats dans le tableau -->
    <table>
        <thead>
            <tr>
                <th>Adresse IP</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            <?php if (is_array($pingresult)) : ?>
                <?php foreach ($pingresult as $ip => $status) : ?>
                    <tr>
                        <td><?php echo $ip; ?></td>
                        <td class="<?php echo ($status == 'OK') ? 'ok' : 'nok'; ?>"><?php echo $status; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">Aucune adresse IP trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
