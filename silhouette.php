<?php
/*
 * Author: y.dago@afriquepesage.com
 * Retrieval of vehicule pics
 * recuperation de la silhouette du vehicule
 * 
 */
session_start();
include 'connections/AfriquepesageConnection.php';
//get parameter from jquery call
$opt = $_GET['opt'];
//declare an array for json enoding
$photo_info = array();
$photo_info2 = array();

//get the vehicule link from the session
$photo_vehicule_link = $_SESSION['vehicule_link'];

if ($opt == 1) {
    $photo_vehiculelink = $_SESSION['vehicule_link'] . 'C';
    $photo_vehiculeinfo = $conn->query("SELECT [silhouette]  FROM [Afriquepesage].[dbo].[PARAM_SURCH] WHERE [Type_vehicule]='$photo_vehiculelink'");
    $photo_vehiculeinfo->execute();
    $photo_vehicule = $photo_vehiculeinfo->fetch();
    $lien_photo = $photo_vehicule['silhouette'];
    ob_start();
    echo "<img src='".$lien_photo."'>";
    $var = ob_get_clean();
    $photo_info[] = $var;
    $photo_info[] = substr($photo_vehiculelink, 7);
    echo json_encode($photo_info);
} else if ($opt == 2) {
    $photo_vehiculelink = $_SESSION['vehicule_link'];
    $photo_vehicule_info = $conn->query("SELECT [silhouette]  FROM [Afriquepesage].[dbo].[PARAM_SURCH] WHERE [Type_vehicule]='$photo_vehiculelink'");
    $photo_vehicule_info->execute();
    $photo_vehicule = $photo_vehicule_info->fetch();
    $lien_photo = $photo_vehicule['silhouette'];
    ob_start();
    echo "<img src='".$lien_photo."'>";
    $var = ob_get_clean();
    $photo_info[] = $var;
    $photo_info[] = substr($photo_vehiculelink, 7);
    echo json_encode($photo_info);
    
}
?>