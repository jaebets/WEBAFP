<?php

/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */

session_start();
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';

/* * *****************************JOURAL ENTRY****************** */
$login_log = fopen("assets/log/verbalisation/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
$log = "*" . date('d-m-Y H:i:s') .": Duplicata de la verbalisation Nº " . $_SESSION['d_verb'] . " effectué par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . "\n\n";
fwrite($login_log, $log);
fclose($login_log);
echo "IMPRESSION TERMINEE";
/*         * *************************************************************** */