<script>
    if (!(confirm("Voulez vous fermer votre session caisse"))) {
        window.location.href = 'etat_caisse.php';
    }
</script>
<?php
session_start();
include './connections/AfriquepesageConnection.php';
$idc = $_GET['id'];
$val = $_GET['s'];
if ($val == "o") {
    //ouvrir   
    $reqmaj = "UPDATE [dbo].[CAISSE] SET [STATUT_CAISSE]=? WHERE [ID_CAISSE]='" . $idc . "'";
    $requp = $conn->prepare($reqmaj);
    $requp->execute(array(1));
    if ($requp) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') . ": Caisse Ouverte par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('CAISSE OUVERTE');
                window.location.href='ouverture_caisse.php';
                </script>";
    }
}
if ($val == "f") {
    //fermer
    $reqmaj1 = "UPDATE [dbo].[CAISSE] SET [STATUT_CAISSE]=? WHERE [ID_CAISSE]='" . $idc . "'";
    $requp1 = $conn->prepare($reqmaj1);
    $requp1->execute(array(0));
    if ($requp1) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') . ": Caisse Fermée par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        //session_start();
        //session_destroy();
        $ses=$_SESSION['SESSION_AFP'];
        echo "<script>
                    alert('CAISSE CLOSE');
                window.location.href='billet_ferme_caisse.php?id_caisse=$idc&id_session=$ses';
                </script>";
    }
}

//$sql = "UPDATE [dbo].[ADMIN_PARAM] SET [fraisPESAGENAT] = ? ,[fraisPESAGEINT] =? WHERE [IDPARAM] = 1";
//    $q = $conn->prepare($sql);
//    $q->execute(array($_POST['f_n'], $_POST['f_in']));
?>