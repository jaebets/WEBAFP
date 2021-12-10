<?php
    include 'connections/AfriquepesageConnection.php';
    include 'penalite_config.php';
    session_start();
    
        $verb = $_SESSION['idverba'];
        $numpese = $_SESSION['NUMERO_PESE'];
        $datverb = $_SESSION['DATE_VERB'] ;
        $logut = $_SESSION['login_utilisateur'];
        $scte =  $_SESSION['NOM_SOCIETE'] ;
        $imat = $_SESSION['IMMAT_VEHIC'];
        $provdest = $_SESSION['PROV_DEST'] ;
        $pdttransp = $_SESSION['PRODUIT_TRANSPORTE'] ;
        $nation = $_SESSION['NATIONALITE'];
        
        $amdetot = $_SESSION['AMENDE_TOTAL'];
        $mttapaye = $_SESSION['MONTANT_A_PAYE'] ;
        $mttrest = $_POST['MONTANT_RESTANT'];
        $modregl = $_POST['MODE_REGLEMENT'];
        
      // $_SESSION['AMDE_TOT'] = $amdetot ;
         $_SESSION['MTT_PAY'] =$mttapaye;
         $_SESSION['MONTT_REST']= $mttrest ;
         $_SESSION['MODE_RGLMNT']=$modregl ;

        $numrecu =  $_SESSION['lerecu'];
        $client =  $_SESSION['NOM_CLIENT'];
        $lesite = $_SESSION['site'];
   //   $export   =   $_SESSION['EXPORTATEUR'] ;
        $devise = $_SESSION['devisePARAM'] ;
 
        if (isset($_POST['IMPRIMER'])) {
            
            $mavar = $verb;
            $id_pai = $mavar;
            $id_clt = $client;
            $id_user = $_SESSION['userid'];
            $id_verb = $verb;
            $mtt_pai = $_SESSION['AMDE_TOT'];
            $dat_pai = date("d/m/y");
            $obs_pai = "RAS";
 //           $mod_regl = $_SESSION['MODE_RGLMNT'];
    ///   insertion d'une ligne dans la table des paiements  
            $req = "INSERT INTO [dbo].[PAIEMENT] ([ID_PAIEMENT],[ID_CLIENT],[ID_USER],[ID_VERB],[MONTANT_PAIEMENT],[MODE_REGLEMENT],[DATE_PAIEMENT],[OBSERVATION_PAIEMENT],[DATE_VERBL],[NUM_PSEE],[LOGIN_UT])"
                    . " VALUES(:ID_PAIEMENT,:ID_CLIENT,:ID_USER,:ID_VERB,:MONTANT_PAIEMENT,:MODE_REGLEMENT,:DATE_PAIEMENT,:OBSERVATION_PAIEMENT,:DATE_VERBL,:NUM_PSEE,:LOGIN_UT)";

            $rq = $conn->prepare($req);
            $rq->bindParam(':ID_PAIEMENT', $id_pai);
            $rq->bindParam(':ID_CLIENT', $id_clt);
            $rq->bindParam(':ID_USER', $id_user);
            $rq->bindParam(':ID_VERB', $id_verb);
            $rq->bindParam(':MONTANT_PAIEMENT', $mttapaye);
            $rq->bindParam(':MODE_REGLEMENT', $_SESSION['MODE_RGLMNT']);
         //   $rq->bindParam(':MODE_REGLEMENT', $md_rgl);
            $rq->bindParam(':DATE_PAIEMENT', $dat_pai);
            $rq->bindParam(':OBSERVATION_PAIEMENT', $obs_pai);
            $rq->bindParam(':DATE_VERBL', $datverb);
            $rq->bindParam(':NUM_PSEE', $numpese);
            $rq->bindParam(':LOGIN_UT', $logut);
            $rq->execute();

            $rq = $conn->prepare($req);
            if ($rq) {
                // echo("L'insertion a été correctement effectuée"); 
                echo'<script type="text/javascript" language="javascript">
                alert("Insertion a été correctement effectuée")
              </script>';
            } else {
                echo'<script type="text/javascript" language="javascript">
                alert("Enregistrement Echoué")
              </script>';
            }
        
    ///   récupération du dernier numero d'enregistrement dans la tables des recus         
     ///   récupération du dernier numero d'enregistrement dans la tables des recus         
        $info = $conn->query("SELECT max([ID_RECU]) as 'ID_RECU' FROM [dbo].[RECU]");
        $info->execute();
        $ret = $info->fetch();
        // foreach ($ret as $me) {
        $id_rec = $ret['ID_RECU'] + 1;
        $inf = "select a.[id_CAISSE],p.[DATE_PAIEMENT]
                    from [Afriquepesage].[dbo].[PAIEMENT] p,[Afriquepesage].[dbo].[AFFECTER] a
                    where p.ID_USER=a.ID_USER and p.[ID_PAIEMENT]  = '$mavar'";
        $retr = $conn->query($inf);
        $ve = $retr->fetch();

        $num_cai = $ve['id_CAISSE'];
        $dat_emi = $ve['DATE_PAIEMENT'];
        $ins = "insert into [dbo].[RECU]([ID_RECU],[ID_PAIEMENT],[NUM_CAISSE],[DATE_EMISSION]) VALUES(:ID_RECU,:ID_PAIEMENT,:NUM_CAISSE,:DATE_EMISSION)";
        $is = $conn->prepare($ins);
        $is->bindParam(':ID_RECU', $id_rec);
        $is->bindParam(':ID_PAIEMENT', $id_paim);
        $is->bindParam(':NUM_CAISSE', $num_cai);
        $is->bindParam(':DATE_EMISSION', $dat_emi);
        $is->execute();
        $is = $conn->prepare($ins);       
                ///  Insertion de l'opération dans la table des mouvement sur compte client
                $mouv = "insert into [dbo].[OPERATION_CPTCLI]([ID_CLIENT],[ID_USER],[ID_VERB],[ID_PAIEMENT],[ID_COMPTE_CLIENT],[MONTANT_PAIEMENT],[ANCIEN_SOLDE],[NOUVEAU_SOLDE],[ID_CAISSE],[DATE_PAIEMENT])"
                              . " values (:ID_CLIENT,:ID_USER,:ID_VERB,:ID_PAIEMENT,:ID_COMPTE_CLIENT,:MONTANT_PAIEMENT,:ANCIEN_SOLDE,:NOUVEAU_SOLDE,:ID_CAISSE,:DATE_PAIEMENT)";

               $mv = $conn->prepare($mouv);
        //     $mv->bindParam(':ID_OPCPTCLI',"OP".$id_pai); 
               $mv->bindParam(':ID_CLIENT', $id_clt);
               $mv->bindParam(':ID_USER',$id_user);
               $mv->bindParam(':ID_VERB', $id_verb);
               $mv->bindParam(':ID_PAIEMENT',$id_pai); 
               $mv->bindParam(':ID_COMPTE_CLIENT', $_SESSION['MODE_RGLMNT']);
               $mv->bindParam(':MONTANT_PAIEMENT', $_SESSION['MTT_PAY']);
               $mv->bindParam(':ANCIEN_SOLDE',$sold);
               $mv->bindParam(':NOUVEAU_SOLDE',$ledebit);
               $mv->bindParam(':ID_CAISSE', $num_cai);
               $mv->bindParam(':DATE_PAIEMENT', $dat_pai);
               $mv->execute();
        
    }
        
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="fr" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Afrique Pesage S.A</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/style.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/main-responsive.css">
        <link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
        <link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
        <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">
        <link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/>
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- end: MAIN CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="page-full-width">
        <!-- start: HEADER -->
       
      <div align="center">
            <div class="modal-body" id ="printThis">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> 
                    &times;
                </button>
                <div class="row">
                    <section style="width:100%; margin:0  ;font-size: 18px; background-repeat:no-repeat;">
                        <div id="two" style="width:545px;">
<?php //echo date("d/m/y")."<br>".$dat_pai."<br>".$datverb; ?>
                            <table width="100%" border="0">
                                <tr>
								<div align="center" style="font-size: 12px;" ><b>
                                                R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUCTURES ECONOMIQUES - FONDS D'ENTRETIEN ROUTIER 
                                            </b></div></tr>
								<tr>
                                    <td> <img src="assets/images/afriquePesage_logo.png"/> </td> 
                                    <td colspan="1">
                                        <div align="center"  style="font-size: 11px;"> </div>
                                    </td>
                                    <td><img src="assets/images/logo_fernew.jpg"/></td>
                                </tr><tr></tr>
                                <tr>
                                    <td colspan="5"><b><u><div align="left">REÇU DE CAISSE : </u></b><?php echo "N°00" . $numrecu; ?></div></td>
                                </tr>
                                    
                                    <tr>
                                    <td><div align="left"><b>
                                                SITE :  
                                            </b></div></td>
                                    <td><div align="left"><?php echo substr($lesite,0,17); ?>  </div>
                                    </td></tr>      
                                      <tr>  <td><div align="left"><b>
                                                    VERBALISATION : 
                                                </b></div></td>
                                        <td><div align="left"><?php $_SESSION['verbs2'] = $verb; echo $verb; ?></div></td></tr>
                                       <tr> <td><div align="left"><b>
                                                    DATE : 
                                                </b></div></td>
                                        <td><div align="left"> <?php echo date("d/m/Y") ?></div></td>
                                    </tr>
                                   <tr>
                                        <td><div align="left"><b> TRAFIC : </b></div></td>
                                        <td><div align="left"> <?php echo substr($provdest,0,17); ?></div></td>   </tr>
                                        <tr><td><div align="left"><b>
                                                    Nº PES&Eacute;E :
                                                </b></div></td>
                                        <td><div align="left"><?php echo $numpese; ?> </div></td>
                                    </tr>
                                    <tr>
                                          <td><div align="left"><b>
                                                   CLIENT : 
                                                  </b></div></td>
                                     <td><div align="left" ><?php echo $client ?></div></td></tr>
                                   <tr> <td><div align="left"><b>
                                                IMMATRICULATION: 
                                            </b></div></td>
                                    <td><div align="left"><?php echo $imat ?></div></td>
                                    </tr>
                                   
                                    <tr>
                                        <td><div align="left"><b>
                                                    PRODUIT : 
                                                </b></div></td>
                                        <td><div align="left"><?php echo $pdttransp ?></div></td>
                                    </tr>
                                </table>
                                
                                <table width="100%" border="1" style=" margin-top:0.5%">
                                    <tr>
                                        <th scope="col">TYPE D'INFRACTION(S)</th>
                                        <th scope="col"><div align="center">AMENDE(S)</div></th>
                                    </tr>
                                    <tr>
                                        <?php
                                //       $info = $conn->query("select [LIBELLE_TYPE_INF],[MONTANT_AMENDE] from [dbo].[VERBALISATION_INFRACTION] where [ID_VERB] = '" . $verb . "'");
                                       $info = $conn->query("select [LIBELLE_TYPE_INF], [OVERLOAD_NAME],[MONTANT_AMENDE],[OVERLOAD_FINE] "
                                                            . "from [Afriquepesage].[dbo].[VERBALISATION_INFRACTION] i,[Afriquepesage].[dbo].[VERBALISATION] v where v.[ID_VERB] = i.[ID_VERB] and v.[ID_VERB] = '" .$verb. "'");
                                        $info->execute();
                                        $reteve = $info->fetchAll();
                                        ?>
                                        <?php
                                        foreach ($reteve as $te) {
                                            ?>
                                        <tr>
                                            <td style="padding-left:5px;"><?php echo $te['LIBELLE_TYPE_INF']; ?></td>
                                            <td style="padding-right:5px; "><div align="right"><?php echo number_format($te['MONTANT_AMENDE'], 0, '', '.') . " " .$devise; ?></div></td>
                                        </tr>			
                                        <?php
                                    }
                                    
                                    ?>
                                    </tr>
                                    <?php
                                        $intr = $conn->query("SELECT [OVERLOAD_NAME]  ,[OVERLOAD_FINE] FROM [Afriquepesage].[dbo].[VERBALISATION] where [ID_VERB] = '" .$verb. "'");
                                        $intr->execute();
                                        $retor = $intr->fetch();
                                    ?>
                                        <tr>
                                            <td style="padding-left:5px;"><?php echo $retor['OVERLOAD_NAME']; ?></td>
                                            <td style="padding-right:5px; "><div align="right"><?php echo number_format($retor['OVERLOAD_FINE'], 0, '', '.') . " " .$devise; ?></div></td>
                                        </tr>
                                    
					<tr>
                                            <td style="padding-left:5px;">FRAIS DE PESAGE</td>
                                            <td style="padding-right:5px; ">
                                                <div align="right">
                                          <?php 
						if ($_SESSION['TRANSIT'] == "INTERNATIONAL") {
                                                    echo number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                } else {
                                                echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;}
                                          ?>
                                                </div></td>
                                        </tr>
                                </table>
                                <table  width="100%" border="0"  >
                                <tr>
								 <tr>  <td><b align="left">AMENDE :</b></td>
                                    <td align="left"><?php echo number_format($amdetot, 0, '', '.') . " " . $devise; ?></td>  </tr>
                                  <tr>  <td><b><div align="left">MODE DE PAIEMENT :</div></b></td>
                                    <td align="left"><?php echo $_SESSION['MODE_RGLMNT']; ?></td></tr>
                                 
                                
								<tr><td><b><div align="left">MONTANT VERSE :</div></b></td>
                            <td align="left"><?php echo number_format($mttapaye, 0, '', '.') . " " . $devise; ?></td>   </tr> 
                           <tr> <td><b><div align="left">RESTE A PAYER :</div></b></td>
                            <td><div align="left"><?php echo number_format($_SESSION['MONTT_REST'], 0, '', '.') . " " . $devise; ?></div></td>   
                        </tr>
                    </table>
                    <table width="100%" border="0" style="margin-top:5%"> 
                        <tr>
                            <td><u><b><div align="left"><strong>SIGNATURE</strong>:</div></u></b></td>
                            <td><div align="right"><strong>Imprim&eacute; le : <?php echo date('d-m-Y H:i:s') ?></strong></div></td>
                        </tr>
                    </table>

                    <table width="100%" border="1" style="margin-top:5%">
                        <tr>
                            <td><div align="center"><strong>AFRIQUE PESAGE SA | Site web : www.afriquepesage.com | Email : info@af-pe.com</strong> </div></td>
							
							 
                        </tr>
                    </table>
					 <tr>
					<td><div align="center"> Tel : +225 21 35 35 20/+225 21 35 64 47 </div></td></tr>
					<td><div align="center">  Fax : +225 21 35 64 41 </div></td></tr>
                </div>
                            <div id="one" style="width:146px; margin: 0 auto;">
                                <?php
                                ?>
                            </div>
                        </section>
                    </div>
                </div>
                
            </div>  
        <br /> 
        <br />
       
        <div class="modal-footer">
                  <button type="submit" name="IMPRIMER" class="btn btn-blue" id="btnPrint"  >    
               <!--       <button type="button"  name="IMPRIMER" class="btn btn-blue" id="btnPrint">   -->
                       IMPRIMER
                    </button>
                    <a class="btn btn-red " href="intro_caissiere.php">
                        ANNULER
                    </a>
                </div>
        
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        
        <!-- end: MAIN CONTAINER -->
        <!-- debut fenetre utilisateur-->
        
        <!-- fin fenetre utilisateur -->
        <!-- start: FOOTER -->

        <!-- end: FOOTER -->
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
        <!--<![endif]-->
        <script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
        <script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
        <script src="assets/plugins/less/less-1.5.0.min.js"></script>
        <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
        <script src="assets/js/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="assets/plugins/ladda-bootstrap/dist/spin.min.js"></script>
        <script src="assets/plugins/ladda-bootstrap/dist/ladda.min.js"></script>
        <script src="assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js"></script>
        <script src="assets/js/ui-buttons.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        
        <script>
                document.getElementById("btnPrint").onclick = function () {
                printElement(document.getElementById("printThis"));
                /* printElement(document.getElementById("printThisToo"), true, "<hr />");*/
                window.print();
             $.ajax({
  //               var verbaid = document.getElementById($_SESSION['idverba'])
                 type: 'POST',
                    data: "",
                    url: 'paiement_dupl.php',
                    success: function(data){
                      if(data != 'Error'){
                        alert('IMPRESSION EFFECTUEE');
                        window.location.href='intro_caissiere.php';
                      }
                      else{
                        alert('ERREUR! RECOMMENCER');
                      }
                    },
                    error: function(){
                      console.log(data);
                      alert('ERREUR! RECOMMENCER');
                    }
                });   
                
                function printElement(elem, append, delimiter) {
                var domClone = elem.cloneNode(true);
                var $printSection = document.getElementById("printSection");
                if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
                }
                if (append !== true) {
                  $printSection.innerHTML = "";
                } else if (append === true) {
                if (typeof (delimiter) === "string") {
                  $printSection.innerHTML += delimiter;
                    } else if (typeof (delimiter) === "object") {
                      $printSection.appendChlid(delimiter);
                    }
                }
          //      $printSection.appendChild(domClone);
                }
              }  
            </script>
            <script>
                $('body').on('hidden.bs.modal', '#receipt', function () {
                //alert('hidden again');
                $(this).removeData('bs.modal');
                });
                /*
                 * 
                 * $('#receipt').on('hidden', function () {
                 alert('hidden');//$(this).removeData('modal');
                 });
                 */
            </script>
    </body>
    <!-- end: BODY -->
</html>