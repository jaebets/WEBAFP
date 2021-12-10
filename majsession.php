<script>
if (!(confirm("Voulez vous clore la session"))) { 
   window.location.href='ouverture_caisse.php';
}
</script>
<?php
session_start();
include './connections/AfriquepesageConnection.php';
$idsess=$_POST['sess'];
$temps=date("H:i:s");
$date_fin_session = date("Ymd");
//Verifier que toutes les caisses de la sessions sont fermées
 $nbreut = "SELECT [STATUT_CAISSE] FROM [Afriquepesage].[dbo].[CAISSE],[Afriquepesage].[dbo].[AFFECTER] WHERE [Afriquepesage].[dbo].[AFFECTER].[ID_CAISSE]=[Afriquepesage].[dbo].[CAISSE].[ID_CAISSE] AND [Afriquepesage].[dbo].[AFFECTER].[ID_SESSION]='".$idsess."'";
            $nbrsess = $conn->query($nbreut);
            $listesess = $nbrsess->fetchAll();
            $volume= sizeof($listesess);
            //si aucune caisse n'est ouverte dans cette session, celle ci ne peut être close
 if($volume==0)  {  
     /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Erreur dans la tentative de fermeture de la session caisse par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n"
                . "CAUSE: FERMETURE DE SESSION SANS ATTRIBUTION PREALABLE DE CAISSE \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
     echo "<script>
                    alert('VOUS NE POUVEZ PAS CLORE CETTE SESSION, AUCUNE CAISSE ATTRIBUEE');
                window.location.href='ouverture_caisse.php';
                </script>";
 }   
 else 
 {
     //Pour les caisses  attribuées, verifier que celle ci sont toutes fermées
     foreach($listesess as $listeses){
         if($listeses['STATUT_CAISSE']==True){
             /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Erreur dans la tentative de fermeture de la session caisse par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n"
                . "CAUSE: FERMETURE DE SESSION SANS FERMETURE PREALABLE DES CAISSES \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
             echo "<script>
                    alert('IMPOSSIBLE DE CLORE LA SESSION. TOUTES LES CAISSES OUVERTES DANS CETTE SESSION NE SONT PAS FERMEES');
                window.location.href='ouverture_caisse.php';
                </script>"; 
             break;
             
         }
         else{
//Fermeture Session
$reqmaj2="UPDATE [dbo].[SESSION] SET [STATUT_SESSION]=?,[FIN_SESSION]=?, [DATE_FIN_SESSION]=? WHERE [ID_SESSION]='".$idsess."'";
    $requp2=$conn->prepare($reqmaj2);
    $requp2->execute(array(0,$temps,$date_fin_session));
    if($requp2){
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Fermeture de la session caisse par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('SESSION CLOSE');
                window.location.href='billet_fermeture.php?id_session=$idsess';
                </script>"; 
    }
 
         }
     }
 }

?>
