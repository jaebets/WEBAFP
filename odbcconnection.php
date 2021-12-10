<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {
    $dbh = new PDO("firebird:dbname=localhost:F:\WIMDB\WIM.FDB", "SYSDBA", "masterkey");
    echo 'am the master';
} catch (PDOException $e) {
    echo $e->getMessage();
}

/*
try{
    $conn = new PDO ("odbc:Firebird");

    die(json_encode(array('outcome' => true)));
}
catch(PDOException $ex){
     die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
}
*/