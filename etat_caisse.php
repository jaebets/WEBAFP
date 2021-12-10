<?php
include 'connections/AfriquepesageConnection.php';
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
//echo session_id()
if(empty($_SESSION['login_utilisateur'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header("Location:index.php");
  exit();
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
        <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="stylesheet" href="assets/plugins/select2/select2.css">
        <link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css">
        <link rel="stylesheet" href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
        <link rel="stylesheet" href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
        <link rel="stylesheet" href="assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
        <link rel="stylesheet" href="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
        <link rel="stylesheet" href="assets/plugins/summernote/build/summernote.css">
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
       <!-- <style>

            html,body {
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
        </style>-->
        <script language="JavaScript" type="text/javascript">
        function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
   <body class="page-full-width">
        <?php //echo $INFRECAmNAT; ?>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <!-- start: PAGE -->
            <div class="main-content">
                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="navbar-tools">
                                <!-- start: TOP NAVIGATION MENU -->
                                <ul class="nav navbar-right">
                                    <li>
                                        <a >
                                            Date:
                                        </a>
                                    </li>
                                    <!-- start: NOTIFICATION DROPDOWN -->
                                    <li class="dropdown">
                                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                            <?php
                                            /* set default time zone 
                                              date_default_timezone_set('UTC');
                                              echo date('l j F Y, H:i');
                                             * 
                                             */
                                            include 'dateconfig/date.php';
                                            ?>
                                        </a>
                                    </li>
                                    <!-- end: NOTIFICATION DROPDOWN -->
                                    <li class="dropdown current-user" >
                                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">

                                            <span class="username"><?php echo $_SESSION['nom_utilisateur'];        ?></span>
                                            <i class="clip-chevron-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="width: -2px;">
                                            <li>
                                                <a href="#"><i class="clip-home-2"></i>
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                               ?></a></li>
                                            <li>
                                                <a href="#"><i class="clip-locked"></i>
                                                    &nbsp;Changer le mot <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de passe </a>
                                            </li>
                                            <li>
                                                <a href="#deconnexion" data-toggle = "modal">
                                                    <i class="clip-exit"></i>
                                                    &nbsp;D&eacute;connexion
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <!-- end: TOP NAVIGATION MENU -->
                            </div>
                            <div class="page-header">
                                <h1>
                                    Etat Caisse <small>Caissier(ère) </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- end: PAGE HEADER -->
                    <div class="col-sm-12">
                        <div class="tabbable">
                            <ul id="myTab" class="nav nav-tabs tab-bricky">
                                <li class="active">
                                    <a href="#panel_tab2_example1" data-toggle="tab">
                                       CAISSE <?php echo  $_SESSION['CAISSE_AFFECTE'];?>
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="#panel_tab2_example2" data-toggle="tab">
                                        JOURNAL DE CAISSE
                                    </a>
                                </li>-->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane in active" id="panel_tab2_example1">
                                    <p>
                                        <!-- DEBUT CONTENU-->
                                    <table border="1" width="100%" class="table table-striped table-bordered table-hover table-full-width">
                                        <tr style="background-color:#E8B0C2;">
                                        <th>SESSION</th>
                                        <th>DATE</th>
                                        <th>HEURE OUVERTURE</th>
                                        <th>TOTAL ENCAISSEMENT</th>
                                        <th>TOTAL ENLEVEMENT</th>
                                        <th>MONTANT POURVU</th>
                                        <th>SOLDE</th>
                                        <th>STATUT CAISSE</th>
                                        <th> FERMER LA CAISSE</th>
                                        </tr>
                                        <?php 
                                        $dt=date("Ymd");
                                        $r=$conn->query("SELECT [SESSION].[ID_SESSION],[DATE_AFFECTATION],[DEBUT_SESSION],[MONTANT_POURVU],[STATUT_CAISSE],[MONTANT_POURVU_RESTANT],[MONTANT_ENCAISSE] FROM [Afriquepesage].[dbo].[AFFECTER],[Afriquepesage].[dbo].[CAISSE],[Afriquepesage].[dbo].[SESSION] WHERE [Afriquepesage].[dbo].[AFFECTER].[ID_CAISSE]=[Afriquepesage].[dbo].[CAISSE].[ID_CAISSE] AND [Afriquepesage].[dbo].[AFFECTER].[ID_SESSION]=[Afriquepesage].[dbo].[SESSION].[ID_SESSION] AND [Afriquepesage].[dbo].[AFFECTER].[ID_CAISSE]='".$_SESSION['CAISSE_AFFECTE']."' AND [Afriquepesage].[dbo].[AFFECTER].[ID_SESSION]='". $_SESSION['SESSION_AFP']."'");
                                        $infsess = $r->fetchAll();
                                        foreach ($infsess as $inf){
                                        ?>
                                        <tr>
                                            <td> <?php echo $inf['ID_SESSION'] ;  ?> </td>  
                                            <td> <?php echo date_format(date_create($inf['DATE_AFFECTATION'] ), 'd/m/Y'); ?></td> 
                                            <td> <?php echo date_format(date_create($inf['DEBUT_SESSION'] ), 'H:i:s'); ?></td> 
                                            <td> <?php echo $inf['MONTANT_ENCAISSE']; ?></td> 
                                            <td> <?php echo $inf['MONTANT_POURVU_RESTANT']; ?></td>
                                            <td> <?php echo $inf['MONTANT_POURVU']; ?></td> 
                                            <td> <?php echo $inf['MONTANT_ENCAISSE']+$inf['MONTANT_POURVU']-$inf['MONTANT_POURVU_RESTANT']; ?></td>
                                            <td> Ouverte</td> 
                                            <td><a href="majcaisse.php?id=<?php echo $_SESSION['CAISSE_AFFECTE']; ?>&s=f"><img src="assets/images/OFF.jpg" width="20" height="20"/></a></td>
                                        </tr>
                                        <?php } ?>
                                    </table> 
                                    <br/>
                                    <div id="imp">
                                    <strong>LISTES DES ENCAISSEMENTS EFFECTUES A LA CAISSE <?php echo $_SESSION['CAISSE_AFFECTE']; ?></strong>
                                    <table width="100%" border="1" class="table table-striped table-bordered table-hover table-full-width">
                                        <tr style="background-color:#E8B0C2;">
                                            <th> CODE PAIEMENT</th>
                                            <th> NUMERO PESEE</th>
                                            <th> NUMERO VERBALISATION</th>
                                            <th> DATE PAIEMENT</th>
											<th> HEURE PAIEMENT</th>
                                            <th> MONTANT AMENDE</th>
                                            <th> MONTANT VERSE</th>
                                            <th> MONTANT RESTANT</th>
                                            
                                        </tr>
                                        <?php
                                        $dta=date("Ymd");
                                        //$dta=date("d")."/".date("m")."/".date("y");
                                        $lispaiement=$conn->query("SELECT [PAIEMENT].[ID_VERB],[PAIEMENT].[ID_USER],[NUMERO_PESE],[ID_CAISSE],[DATE_VERB],[AMENDE_TOTAL],[MONTANT_RESTANT],[ID_PAIEMENT],[MONTANT_PAIEMENT],[DATE_PAIEMENT],LEFT([HEURE_PAIEMENT],8) as HEURE_PAIEMENT,[ID_SESSION]FROM [Afriquepesage].[dbo].[VERBALISATION],[Afriquepesage].[dbo].[PAIEMENT] where [VERBALISATION].[ID_VERB]=[PAIEMENT].[ID_VERB] AND [PAIEMENT].[ID_USER]='".$_SESSION['userid']."' AND [ID_CAISSE]='".$_SESSION['CAISSE_AFFECTE']."' AND [ID_SESSION]='".$_SESSION['SESSION_AFP']."' order by [DATE_PAIEMENT],HEURE_PAIEMENT ");
                                        $lpaiement = $lispaiement->fetchAll();
                                        $vol=sizeof($lpaiement);
                                        if($vol==0){
                                            echo'<tr> <td colspan="7"> AUCUN ENCAISSEMENT EFFECTUE</td>  </tr>';
                                        }
                                        else{
                                            foreach($lpaiement as $lp)
                                            {
                                       
                                        ?>
                                        <tr>
                                            <td><?php echo $lp['ID_PAIEMENT']; ?> </td> 
                                            <td><?php echo $lp['NUMERO_PESE']; ?> </td>
                                            <td><?php echo $lp['ID_VERB']; ?> </td>
                                            <td><?php echo $lp['DATE_PAIEMENT']; ?> </td>
											<td><?php echo $lp['HEURE_PAIEMENT']; ?> </td>
                                            <td><?php echo $lp['AMENDE_TOTAL']; ?> </td>
                                            <td><?php echo $lp['MONTANT_PAIEMENT']; ?> </td>
                                            <td><?php echo $lp['MONTANT_RESTANT']; ?> </td>
                                        </tr>
                                        <?php 
                                         }
                                            }
                                        ?>
                                    </table>
                                    
                                    <?php
                                    $dtx=date("Ymd");
                                    $totencaiss=$conn->query("SELECT SUM([MONTANT_PAIEMENT]) as [TOTAL_PAIEMENT]FROM [Afriquepesage].[dbo].[PAIEMENT] where  [PAIEMENT].[ID_USER]='".$_SESSION['userid']."' AND [ID_CAISSE]='".$_SESSION['CAISSE_AFFECTE']."' AND [ID_SESSION]='".$_SESSION['SESSION_AFP']."'"); 
                                    $chiffaff=$totencaiss->fetch();
                                    ?>
                                    <strong>MONTANT TOTAL ENCAISSE : <?php echo $chiffaff['TOTAL_PAIEMENT']; ?> </strong> <br/><br/> 
                                    </div>
                                    <br/>
                                 <a class="btn btn-blue btn-lg" HREF="javascript:history.go(0)">
                            ACTUALISER
                            <i class="	clip-refresh "></i>
                                </a> 
                                    <a class="btn btn-red btn-lg" href="intro_caissiere.php">
                            RETOUR
                            <i class="fa fa-times fa fa-white"></i>
                        </a>
                                     <button type="button" class="btn btn-blue btn-lg" id="btnPrint" onclick="printContent('imp')" >     
        <!--             <button type="button"  name="IMPRIMER" class="btn btn-blue" id="btnPrint">-->
                       IMPRIMER
                    </button>
                                    
                                     <!-- FIN CONTENU-->
                                    </p>
                                    
                                </div>
                                <!-- DEBUT SECOND ONGLET-->
                                <div class="tab-pane" id="panel_tab2_example2">
                                    <p>
                                        <!-- DEBUT CONTENU-->
                                        <!-- FIN CONTENU-->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id = "deconnexion" class = "modal fade" tabindex = "-1" data-width = "300" style = "display: none;">
                    <div class = "modal-header">
                        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                            &times;
                        </button>
                        <h5 class = "modal-title mod">CONFIRMEZ VOTRE DECONNEXION</h5>
                    </div>
                    <form method="post" id="search_form" action="logout.php">

                        <div class = "modal-footer">
                            <button type = "button" data-dismiss = "modal" class = "btn btn-blue">
                                ANNULER
                            </button>
                            <button type = "submit" class = "btn btn-red" name="search_duplicata">
                                SE DECONNECTER
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end: PAGE -->
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <div class="footer clearfix">
            <div class="footer-inner">
                AFRIQUE PESAGE S.A c&ocirc;te d'ivoire - Abidjan - Zone 4C, Rue du docteur CALMETTE - Adresse:16
            </div>
            <div class="footer-items">
                <span class="go-top"><i class="clip-chevron-up"></i></span>
            </div>
        </div>
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
        
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
        <script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
        <script src="assets/js/ui-modals.js"></script>
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
        <script src="assets/plugins/select2/select2.min.js"></script>
        <script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
        <script src="assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
        <script src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/js/form-elements.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
                UIButtons.init();
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>