<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include 'connections/AfriquepesageConnection.php';

    $info1 = $conn->query("SELECT [ID_VERB],[ID_USER],[NUMERO_PESE],[DATE_VERB],[NATIONALITE],[TRANSIT],[PDPUIT_DANGE],[INF_GABARIT],[LOGIN_OP],[AMENDE_TOTAL],[EXPORTATEUR]
                ,[IMMAT_VEHICULE],[PRODUIT_TRANSPORTE],[PROV_DEST],[NOM_STE],[POIDS_TOTAL],[CLASSE_VEHICULE],[PAIMENT_VERBA],[MONTANT_AMENDE_PAYE],[MONTANT_RESTANT],[NOM_CLIENT]
               FROM [Afriquepesage].[dbo].[VERBALISATION] WHERE [ID_VERB] = '".$_SESSION['idverba']."'");
    $info1->execute();
    $retri = $info1->fetch();
    
        $mavar = $retri['ID_VERB'];
        $id_pai = "P".$mavar;
        $id_clt = $retri['EXPORTATEUR'];
        $id_user = $_SESSION['userid'];
        $id_verb = $mavar;
        $mtt_pai = $retri['MONTANT_AMENDE_PAYE'];
        $dat_pai = date("Ymd");
        $obs_pai = "RAS";
        $dat_ver = $retri['DATE_VERB'];
        $num_pes = $retri['NUMERO_PESE'];
        $lg_ut = $retri['LOGIN_OP'];
        $mapay = $_SESSION['MTT_PAY'];
        $mrest  = $_SESSION['MONTT_REST'] ;
        $mod_regl = $_SESSION['MODE_RGLMNT'];
        
      if ($mrest != 0 ){
            $PAIMENT_VERBA = 0;
        }else {
            $PAIMENT_VERBA = 1;
        }	
 		
    $sql = "UPDATE [Afriquepesage].[dbo].[VERBALISATION] SET [PAIMENT_VERBA] = ?, [MONTANT_AMENDE_PAYE]= ?,[MONTANT_RESTANT]= ?,[TRAITE]= 1  WHERE [NUMERO_PESE] = ?";  
    $q = $conn->prepare($sql);
//    $q->execute(array($PAIMENT_VERBA,$mapay,$mrest,$num_pes));
    $q->execute(array($PAIMENT_VERBA ,$mapay,$mrest,$num_pes));
    if ($q) {
///   insertion d'une ligne dans la table des paiements  
        $req = "INSERT INTO [dbo].[PAIEMENT] ([ID_PAIEMENT],[ID_CLIENT],[ID_USER],[ID_VERB],[MONTANT_PAIEMENT],[MODE_REGLEMENT],[DATE_PAIEMENT],[OBSERVATION_PAIEMENT],[DATE_VERBL],[NUM_PSEE],[LOGIN_UT],[ID_CAISSE],[ID_SESSION])"
                . " VALUES(:ID_PAIEMENT,:ID_CLIENT,:ID_USER,:ID_VERB,:MONTANT_PAIEMENT,:MODE_REGLEMENT,:DATE_PAIEMENT,:OBSERVATION_PAIEMENT,:DATE_VERBL,:NUM_PSEE,:LOGIN_UT,:ID_CAISSE,:ID_SESSION)";
        $rq = $conn->prepare($req);
        $rq->bindParam(':ID_PAIEMENT', $id_pai);
        $rq->bindParam(':ID_CLIENT', $id_clt);
        $rq->bindParam(':ID_USER', $id_user);
        $rq->bindParam(':ID_VERB', $id_verb);
        $rq->bindParam(':MONTANT_PAIEMENT', $mapay);
        $rq->bindParam(':MODE_REGLEMENT', $mod_regl);
        $rq->bindParam(':DATE_PAIEMENT', $dat_pai);
        $rq->bindParam(':OBSERVATION_PAIEMENT', $obs_pai);
        $rq->bindParam(':DATE_VERBL', $dat_ver);
        $rq->bindParam(':NUM_PSEE', $num_pes);
        $rq->bindParam(':LOGIN_UT', $lg_ut);
        $rq->bindParam(':ID_CAISSE', $_SESSION['CAISSE_AFFECTE']);
        $rq->bindParam(':ID_SESSION',$_SESSION['SESSION_AFP']);
        $rq->execute();  
        if ($rq) {

         ///   r??cup??ration du dernier numero d'enregistrement dans la tables des recus         
            $info = $conn->query("SELECT max([ID_RECU]) as 'ID_RECU' FROM [dbo].[RECU]");
            $info->execute();
            $ret = $info->fetch();
            // foreach ($ret as $me) {
            $id_rec = $ret['ID_RECU'] + 1;
         
            $inf =$conn->query("select a.[id_CAISSE],p.[DATE_PAIEMENT]
                    from [Afriquepesage].[dbo].[PAIEMENT] p,[Afriquepesage].[dbo].[AFFECTER] a
                    where p.ID_USER=a.ID_USER and p.[ID_PAIEMENT]  = '".$id_pai."'"); 
            $inf->execute();
            $ver = $inf->fetch();  
                 $num_cai = $ver['id_CAISSE'];
                 $dat_emi = $ver['DATE_PAIEMENT'];
                 
            ///   r??cup??ration du dernier numero d'enregistrement dans la tables des recus         
        //     $enq = $conn->query("SELECT [MONTANT_ENCAISSE] FROM [Afriquepesage].[dbo].[AFFECTER] where [ID_CAISSE]='".$num_cai."' and [ID_USER]= '".$_SESSION['id_user']."' and [DATE_AFFECTATION]= '".$dat_pai."'");
                $enq = $conn->query("SELECT SUM([MONTANT_PAIEMENT]) as [TOTAL_PAIEMENT] FROM [Afriquepesage].[dbo].[PAIEMENT] where  [PAIEMENT].[ID_USER]='".$_SESSION['userid']."' and [DATE_PAIEMENT]='".$dat_pai."' AND [ID_CAISSE]='".$_SESSION['CAISSE_AFFECTE']."'");
			$enqui = $enq->fetch();
            $mttenais= $enqui['TOTAL_PAIEMENT'];
            
            $sql = "UPDATE [Afriquepesage].[dbo].[AFFECTER] SET [MONTANT_ENCAISSE] = ? where [ID_CAISSE]= ? and [ID_USER] = ? and [DATE_AFFECTATION]=? ";
            $q = $conn->prepare($sql);            
            $q->execute(array($mttenais,$_SESSION['CAISSE_AFFECTE'],$id_user,$dat_pai));
            
            $ins = "insert into [dbo].[RECU]([ID_RECU],[ID_PAIEMENT],[NUM_CAISSE],[DATE_EMISSION]) "
                    . "VALUES(:ID_RECU,:ID_PAIEMENT,:NUM_CAISSE,:DATE_EMISSION)";
            $is = $conn->prepare($ins);
            $is->bindParam(':ID_RECU', $id_rec);
            $is->bindParam(':ID_PAIEMENT', $id_pai);
            $is->bindParam(':NUM_CAISSE', $num_cai);
            $is->bindParam(':DATE_EMISSION', $dat_emi);
            $is->execute();
            $is = $conn->prepare($ins);

            ///   insertion d'une ligne dans la table mouvements       
               $sdcpt = "select [ID_COMPTE_CLIENT],[SOLDE_COMPTE_CLIENT]  from [Afriquepesage].[dbo].[COMPTE_CLIENT]
                      where [ID_COMPTE_CLIENT] = '".$mod_regl."'";
               $reqsd = $conn->query($sdcpt);
               $sd = $reqsd->fetch();
               $idcpt = $sd['ID_COMPTE_CLIENT']; 
               $ancsld = $sd['SOLDE_COMPTE_CLIENT']; 

               $debit = $ancsld - $mapay ;
               
                if ($mod_regl !='ESPECE' ){
                   /// v??rification de la disponibilit?? de fond pour l'op??ration     
                       $leql = "UPDATE [Afriquepesage].[dbo].[COMPTE_CLIENT] SET [SOLDE_COMPTE_CLIENT] = ? WHERE [ID_COMPTE_CLIENT] = ?";
                         $lq = $conn->prepare($leql);
                         $lq->execute(array($debit,$mod_regl));     
                }else{
                  $debit =0;                    
                }

        ///  Insertion de l'op??ration dans la table des mouvementS sur compte client
                 $mouv = "insert into [dbo].[OPERATION_CPTCLI]([ID_CLIENT],[ID_USER],[ID_VERB],[ID_PAIEMENT],[ID_COMPTE_CLIENT],[MONTANT_PAIEMENT],[ANCIEN_SOLDE],[NOUVEAU_SOLDE],[ID_CAISSE],[DATE_PAIEMENT])"
                               . " values (:ID_CLIENT,:ID_USER,:ID_VERB,:ID_PAIEMENT,:ID_COMPTE_CLIENT,:MONTANT_PAIEMENT,:ANCIEN_SOLDE,:NOUVEAU_SOLDE,:ID_CAISSE,:DATE_PAIEMENT)";
                $mv = $conn->prepare($mouv);
         //     $mv->bindParam(':ID_OPCPTCLI',"OP".$id_pai); 
                $mv->bindParam(':ID_CLIENT', $id_clt);
                $mv->bindParam(':ID_USER',$id_user);
                $mv->bindParam(':ID_VERB', $id_verb);
                $mv->bindParam(':ID_PAIEMENT',$id_pai); 
                $mv->bindParam(':ID_COMPTE_CLIENT',$mod_regl);
                $mv->bindParam(':MONTANT_PAIEMENT', $mapay);
                $mv->bindParam(':ANCIEN_SOLDE',$ancsld);
                $mv->bindParam(':NOUVEAU_SOLDE',$debit);
                $mv->bindParam(':ID_CAISSE', $num_cai);
                $mv->bindParam(':DATE_PAIEMENT', $dat_pai);
                $mv->execute();
         /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/paiement/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') . ": Paiement effectu?? pour la verbalisation N?? *" . $id_verb. " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
             echo'<script >
               alert("Paiement effectu?? " )   
             </script>';
           } else {
               /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/paiement/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') . ": Paiement Echou?? pour la verbalisation N?? *" . $id_verb. " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
              echo'<script type="text/javascript" language="javascript">
               alert("Paiement Echou?? " )   
             </script>';
           }
       }else {
            /** *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/verbalisation/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') . ": Mise ?? jour echou??e de la verbalisation N?? *" . $id_verb. " lors du paiement par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
            /** *************************************************************** */
           echo'<script type="text/javascript" language="javascript">
                   alert("Mise ?? jour Echou??e des infos de verbalisation ")
                 </script>';
       }   
     
?>