<?php

/*
 * Author: y.dago@afriquepesage.com
 * This File is used to Connect to the database 
 * Ce Fichier est utilisé pour se Connecter à la base de données
 */

// configuration
$dbtype        = "sqlsrv";
$dbhost        = "localhost";
$dbname        = "Afriquepesage";
$dbuser        = "sa";
$dbpass        = "rooT@@";

/* Database Connection
 * Connection à la base de données
 */
try{
    $conn = new PDO("sqlsrv:Server=$dbhost;Database=$dbname", $dbuser, $dbpass);
}  catch (PDOException $e) {
    echo "Erreur de Connection &agrave; la base de donn&eacute;es";
   
    echo $e->getCode().'<br/>'; // Outputs: "28000"
    echo $e->getMessage();
   
}
?>