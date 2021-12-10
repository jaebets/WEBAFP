<?php

session_start();
include('phpqrcode/qrlib.php');
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
//GET DEVISE
        $dev = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
        $dev->execute();
        $devs = $dev->fetch();
        $devise = $devs['devisePARAM'];

$station = $_SESSION['site'];
$dte = date('d-m-Y');
$immatriculation = $_SESSION['duplicata_immatriculation'];
$num_fv = $_SESSION['duplicata_num_verb'];
$montant = number_format($_SESSION['duplicata_montant_a_paye'],0,'','.')." ".$devise;;
$societe = $_SESSION['duplicata_nom_client'];
$produit = $_SESSION['duplicata_produit_transporte'];
$exportateur = $_SESSION['duplicata_exportateur'];
$transport = $_SESSION['duplicata_transport'];
//$param = $_GET['id']; // remember to sanitize that - it is user input!
// we need to be sure ours script does not output anything!!!
// otherwise it will break up PNG binary!

ob_start("callback");

// here DB request or some processing
$codeText = $station ."\n" . 'DATE: ' . $dte . "\n" . 'IMMAT VEHICULE: ' . $immatriculation . "\n" . 'Nº VERBALISATION: ' . $num_fv . "\n" . 'MONTANT A PAYER: ' . $montant. "\n" . 'SOCIETE/PROP: ' . $societe. "\n" . 'PRODUIT: ' . $produit. "\n" . 'EXPORTATEUR: ' . $exportateur."\n" . 'TRANSPORT: '.$transport;

// end of processing here
// $debugLog = ob_get_contents();
ob_end_clean();

// outputs image directly into browser, as PNG stream
QRcode::png($codeText);
?>