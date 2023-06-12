<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>SDIS - Se connecter</title>
    <link rel=stylesheet href=css\ouif\style.css>
    <link rel="shortcut icon" href="image/sdis-icone.ico">
</head>

<body>
    <?php
    require_once 'variables.inc';
    include_once 'enTete.php';
    include_once 'menu.php';
    echo "<section>";
    $message = "";

    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        $login = $_POST['login'];
        $pass_hache = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT pro_passe FROM profil WHERE pro_nom = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $resultat = $stmt->fetch();
            if (!$resultat) {
                $message = "Mauvais identifiant !";
            } else {
                $isPasswordCorrect = password_verify($_POST['pwd'], $resultat['pro_passe']);
                if (!$isPasswordCorrect) {
                    $message = "Mauvais mot de passe !";
                } else {
                    $_SESSION['nom'] = $login;
                    header("location:connecte.php");
                }
            }
        } catch (PDOException $e) {
            $message = "Echec de l'affichage :" . $e->getMessage();
        }
        $conn = null;
    }
    ?>
    <div class="login-form">
        <form method="post" action="seConnecter.php">
            <div>
                <label>Login</label>
                <input id="login" name="login" placeholder="Login" type="text" required="required">
            </div>
            <div>
                <label>Mot de passe</label>
                <input id="pwd" name="pwd" placeholder="Mot de passe" type="password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Valider</button>
            </div>
        </form>
    </div>

    <h>
        <?php
        echo " $message";
        ?>
    </h>

    </section>
</body>

<footer>
    <?php
    include_once 'piedPage.php';
    ?>
</footer>

</html>