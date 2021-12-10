<?php

/*
 * Author: y.dago@afriquepesage.com
 * This File is used to configure the database parameters
 * Ce Fichier est utilisé pour configurer les paramètres de la base de données
 */

// Initialize the session.
session_start();

/* * *****************************JOURAL ENTRY****************** */
$login_log = fopen("assets/log/logout/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
$log = "*" . date('d-m-Y H:i:s') .": Deconnexion de *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle'] . "\n\n";
fwrite($login_log, $log);
fclose($login_log);
/* * *************************************************************** */
// Unset all of the session variables.
$_SESSION = array();
$_POST['username'] = null;
$_POST['password'] = null;
// kill the session, delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
if (session_destroy()) {
    header("Location:index.php");
    die;
}