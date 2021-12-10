<?php

/* 
 * Author: y.dago@afriquepesage.com
 * This File is used to Handle in a readable manner the database exceptions thrown by the transactions
 * Ce Fichier est utilisé pour gérer de manière lisible les exceptions générées par la base de données lors des transactions
 */
include '../connections/AfriquepesageConnection.php';
class PDODbException extends PDOException{
    public function __construct(PDOException $e) {
        if(strstr($e->getMessage(), 'SQLSTATE[')) {
            preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
            $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
            $this->message = $matches[3];
        }
    } 
}