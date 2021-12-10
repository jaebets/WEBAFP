<?php

/*
 * Author: y.dago@afriquepesage.com
 * This File is used to Connect to the database 
 * Ce Fichier est utilisé pour se Connecter à la base de données
 *
 
try {
    $dbh = new PDO("firebird:dbname=localhost:G:\WIMAFP\WIM.FDB", "SYSDBA", "masterkey");
   // echo 'am the master';
} catch (PDOException $e) {
    echo $e->getMessage();
}
/*
 * FOR NETWORK ACCESS
 * 
 */

try {
    $dbh = new PDO("firebird:dbname=localhost:C:\Program Files (x86)\CAPTELS\WIM V1H09a1 UEMOA\Plugins\Data\WIM.FDB"); "SYSDBA". "masterkey")
   // echo 'am the master';
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>