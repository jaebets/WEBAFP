<?php

/* 
 * Author: y.dago@afriquepesage.com
 * This File is used to Insert info in the Database 
 * Ce Fichier est utilisé pour Inserer ldes infos dans la base de données
 */
include '../connections/AfriquepesageConnection.php';
// new data
$ID_TYPE_UTILISATEUR = '6';
$LIBELLE_TYPE_UTILISATEUR = 'Jack Hijack 2';

// query
$sql = "INSERT INTO [dbo].[TYPE_UTILISATEUR] ([ID_TYPE_UTILISATEUR],[LIBELLE_TYPE_UTILISATEUR]) VALUES (:ID_TYPE_UTILISATEUR,:LIBELLE_TYPE_UTILISATEUR)";
$q = $conn->prepare($sql);
$q->execute(array(':ID_TYPE_UTILISATEUR'=>$ID_TYPE_UTILISATEUR,
                  ':LIBELLE_TYPE_UTILISATEUR'=>$LIBELLE_TYPE_UTILISATEUR));
if ($q){
    echo 'Insertion SUCCESSFULL';
    $conn = null;
}else{
    echo 'Insertion FAILED';
    $conn = null;
}

