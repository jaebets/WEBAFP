<?php

session_start();
include('phpqrcode/qrlib.php');
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
$sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"= ' . $_SESSION['num_pesee']);
$sql->execute();
$result = $sql->fetch();
//echo $result['high'];


$info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' .$result['high'].' order by surch desc rows 1 to 1');
$info->execute();
$essieux = $info->fetch();
//echo $essieux['nom_EP'];

//GET DEVISE
        $dev = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
        $dev->execute();
        $devs = $dev->fetch();
        $devise = $devs['devisePARAM'];

$station = $_SESSION['site'];
$dte = date('d-m-Y');
$immatriculation = $_SESSION['immatriculation'];
$num_fv = $_SESSION['num_verb'];
$montant = number_format($_SESSION['montant_a_paye'],0,'','.')." ".$devise;;
$societe = $_SESSION['nom_client'];
$produit = $_SESSION['produit_transporte'];
$exportateur = $_SESSION['exportateur'];
$transport = $_SESSION['transport'];
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