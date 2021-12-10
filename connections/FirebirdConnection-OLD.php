<?php

/*
 * Author: y.dago@afriquepesage.com
 * This File is used to Connect to the database 
 * Ce Fichier est utilisé pour se Connecter à la base de données
 *
try {
    $dbh = new PDO("firebird:dbname=172.20.1.12:D:\WIMAFP\WIMDEMOEXTFILE.FDB", "SYSDBA", "masterkey");
   // echo 'am the master';
} catch (PDOException $e) {
    echo $e->getMessage();
}
*/

/*$link = file_get_contents('http://172.20.1.29:8081/access/file.txt');
 $login = file_get_contents('http://172.20.1.29:8081/access/uname.txt');
 $pss = file_get_contents('http://172.20.1.29:8081/access/pwd.txt');
*/
$link = file_get_contents('http://172.20.103.2:8081/access/file.txt');
$login = file_get_contents('http://172.20.103.2:8081/access/uname.txt');
$pss = file_get_contents('http://172.20.103.2:8081/access/pwd.txt');
file_put_contents('code.php', $link);
file_put_contents('login.php', $login);
file_put_contents('pass.php', $pss);
include 'code.php';
include 'login.php';
include 'pass.php';
try {
    $dbh = new PDO($link, $uname, $pwd);
    // echo 'am the master';
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>