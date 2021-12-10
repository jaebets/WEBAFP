<?php
session_start();
include 'connections/AfriquepesageConnection.php';
$id_user = $_POST['iduser'];
$id_session = $_POST['idsession'];
$id_caisse = $_POST['idcaisse'];
$montant_appro = $_POST['montantappro'];
$datetoday = date("Ymd");
$heure_affectation = date("H:i:s");
if ($montant_appro < 0) {
    /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Tentative d'affectation d'une caisse avec erreur le montant d'approvisionnement non renseigné au niveau du site " . $_SESSION['site'] . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
    echo "<script> alert('Le champ montant approvisionnement na pas été correctement renseigné');
                window.location.href='ouverture_caisse.php';
                </script>";
} else {
//ouverture de la caisse
    $reqmaj = "UPDATE [dbo].[CAISSE] SET [STATUT_CAISSE]=? WHERE [ID_CAISSE]='" . $id_caisse . "'";
    $requp = $conn->prepare($reqmaj);
    $requp->execute(array(1));
//Enregistrement de l'affectation
    $reqinsert1 = "INSERT INTO [dbo].[AFFECTER]([ID_USER],[ID_CAISSE],[ID_SESSION],[DATE_AFFECTATION],[MONTANT_POURVU],[MONTANT_ENCAISSE],[MONTANT_POURVU_RESTANT],[HEURE_AFFECTATION])VALUES(:ID_USER,:ID_CAISSE,:ID_SESSION,:DATE_AFFECTATION,:MONTANT_POURVU,:MONTANT_ENCAISSE,:MONTANT_POURVU_RESTANT,:HEURE_AFFECTATION)";
    $ins1 = $conn->prepare($reqinsert1);
    $ins1->execute(array(':ID_USER' => $id_user, ':ID_CAISSE' => $id_caisse, ':ID_SESSION' => $id_session, ':DATE_AFFECTATION' => $datetoday, ':MONTANT_POURVU' => $montant_appro, ':MONTANT_ENCAISSE' => 0, ':MONTANT_POURVU_RESTANT' => 0, ':HEURE_AFFECTATION' => $heure_affectation));

//generer etat PDF d'ouverture de caisse
//generer etat PDF d'ouverture de caisse
//require('fpdf.php');
//$pdf = new FPDF();
//$pdf->AddPage();
//$pdf->SetFont('Arial','',13);
//$pdf->Image('assets/images/signature.jpg',20,20,-200);
//$pdf->Cell(40,10,'STATION DE PESAGE ',0,1,'C');
//$pdf->Cell(40,10,'Billet douverture de caisse',0,1,'C');
//$pdf->Cell(40,10,"SESSION : ".$id_session,0,1,'C');
//$pdf->Cell(40,10,"Date :".$datetoday,0,1,'C');
//$pdf->Cell(40,10,"Montant Pourvu : ".$montant_appro." FCFA");
//$pdf->Output('D',"billetcaisse".$id_session.$id_caisse.".pdf");
//'D','billetcaisse.pdf'
//
    if ($ins1) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Affectation d'une caisse au niveau du site " . $_SESSION['site'] . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n"
                . "*ID USER = " . $id_user . " *ID CAISSE = " . $id_caisse . " *MONTANT POURVU = " . $montant_appro . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script> alert('AFFECTATION EFFECTUEE AVEC SUCCES');
                window.location.href='billet_ouverture.php?id_user=$id_user & id_caisse=$id_caisse & id_session=$id_session';
                </script>";
        

        
    }

}
?>
