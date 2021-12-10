<?php

/*
 * Author: y.dago@afriquepesage.com
 * Retrieval of vehicule pics
 * recuperation de la silhouette du vehicule
 * 
 */
session_start();
//create an array to store the photos
$photo_info = array();
if ($_GET[''] == 1) {
//if it is checked place the info in the array
$photo_info[] = $_SESSION['photo_vehicule'];
$photo_info[] = $_SESSION['vehicule_type'].'C';
//pass the parameter as json array
echo json_encode($photo_info);

} else if ($_GET[''] == 2) {
$photo_info[] = $_SESSION['photo_vehicule'];
$photo_info[] = $_SESSION['vehicule_type'];
//pass the parameter as json array
echo json_encode($photo_info);
}
?>