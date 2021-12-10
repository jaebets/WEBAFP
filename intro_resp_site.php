<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
include 'connections/FirebirdConnection.php';
    include 'connections/AfriquepesageConnection.php';
    unset($_SESSION['LIBELLE_TYPE_INF']);
    unset($_SESSION['MONTANT_INF']);
    unset($_SESSION['CODE_TYPE_INF']);
    unset($_SESSION['LIBELLE_CODE_INF']);
    $sth = $dbh->prepare('SELECT a."Numero_Pesee", a."Id_VP", a."Date_Pesee", a."Heure_Pesee", a."Unite_Mesure_Pesee", a."Vitesse_Moyenne_Pesee", a."Acceleration_Moyenne_Pesee", a."Selectionne_Pesee", a."Photo_Pesee", a."Commentaire_Pesee", a."Utilisateur_Pesee", a."poids_total_vehicule_Pesee", a."surcharge_Vehicule_Pesee", a."Vitesse_Min_Pesee", a."Vitesse_Max_Pesee", a."Erreur_Pesee", a."Type_Pesee", a."position_virgule", a.RDB$DB_KEY FROM "Pesee" a ORDER BY a."Numero_Pesee" DESC rows 1 to 1');
    $sth->execute();
    $result = $sth->fetch();
    echo $result["Numero_Pesee"];
?>
