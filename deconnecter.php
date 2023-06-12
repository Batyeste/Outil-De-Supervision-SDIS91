<?php
session_start();


/* Détruit tout */
$_SESSION = array();

/* Détruit le cookie */
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}
/* Détruit la session */
session_destroy();

header("location:index.php");

?>