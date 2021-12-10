<?php

/*
 * Author: y.dago@afriquepesage.com
 * Retrieval of vehicule pics
 * recuperation de la silhouette du vehicule
 * 
 */
session_start();
include 'connections/AfriquepesageConnection.php';
$opt = $_GET['opt'];
if ($opt == 1) {
    $vehicule_type = $_SESSION['vehicule_link'].'C';
    ?>
<input id="form-field-1" class="form-control" value="<?php echo substr($vehicule_type, 7); ?>" type="text" placeholder="" readonly >
<?php 
} else if ($opt == 2) {
    $vehicule_type = $_SESSION['vehicule_link'];
    ?>
<input id="form-field-1" class="form-control" value="<?php echo substr($vehicule_type, 7); ?>" type="text" placeholder="" readonly >
<?php 
}
?>