<?php
session_start();
include 'connections/AfriquepesageConnection.php';
$id_s = $_GET['id_session'];
$id_u = $_GET['id_caisse'];
// Affectation
$rqaf = "SELECT [DATE_AFFECTATION],[MONTANT_POURVU],[ID_CAISSE],[ID_USER],[MONTANT_ENCAISSE],[MONTANT_POURVU_RESTANT] FROM [Afriquepesage].[dbo].[AFFECTER] WHERE [ID_SESSION]='" . $id_s . "' AND [ID_CAISSE]='" . $id_u . "'";
$rqaf2 = $conn->query($rqaf);
$infossession = $rqaf2->fetch();

//utilisateur
$nbreut = "SELECT [NOM_UT],[PRENOM_UT] FROM [Afriquepesage].[dbo].[UTILISATEUR] WHERE [ID_USER]='" . $infossession['ID_USER'] . "'";
$nbrut = $conn->query($nbreut);
$totdef = $nbrut->fetch();

////caisse
$rc = "SELECT [LIBELLE_CAISSE] FROM [Afriquepesage].[dbo].[CAISSE] WHERE [ID_CAISSE]='" . $id_u . "'";
$rc1 = $conn->query($rc);
$csse = $rc1->fetch();
?>
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
            function printContent(el) {
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
        <?php //echo $INFRECAmNAT;  ?>
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

                                            <span class="username"><?php echo $_SESSION['nom_utilisateur']; ?></span>
                                            <i class="clip-chevron-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="width: -2px;">
                                            <li>
                                                <a href="#"><i class="clip-home-2"></i>
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                  ?></a></li>
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
                                    CAISSE <small>Impression Fermeture de CAISSE </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- end: PAGE HEADER -->
                    <div class="col-sm-12">
                        <div class="tabbable">

                            <div class="tab-content">
                                <div class="tab-pane in active" id="panel_tab2_example1">
                                    <p>
                                        <!-- DEBUT CONTENU-->


                                    <div id="imp">
                                        <div>
                                            <table width="700" border="1" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th colspan=2 style="text-align: center;">AFRIQUE PESAGE S.A - <?php echo $_SESSION['site']; ?></th>
                                                </tr>
                                                <tr>
                                                    <th colspan=2 style="text-align: center;">BILAN DE FERMETURE DE CAISSE - SESSION <?php echo $id_s; ?></th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>OPERATEUR CAISSE : </strong><?php echo $totdef['NOM_UT'] . '' . $totdef['PRENOM_UT']; ?> <br/><br/>
                                                        <strong>TOTAL ENCAISSEMENT : </strong><?php echo number_format($infossession['MONTANT_ENCAISSE'], 0, '', ' '); ?><br/><br/>
                                                        <strong>TOTAL ENLEVEMENT: </strong><?php echo number_format($infossession['MONTANT_POURVU_RESTANT'], 0, '', ' '); ?><br/><br/>
                                                        <strong>SOLDE D'ENCAISSEMENT: </strong><?php $solde = ($infossession['MONTANT_ENCAISSE'] - $infossession['MONTANT_POURVU_RESTANT']);
                                            echo number_format($solde, 0, '', ' '); ?><br/>
                                                    </td>
                                                    <td>
                                                        <strong>DATE SESSION : </strong><?php echo date_format(date_create($infossession['DATE_AFFECTATION']), 'd-m-Y'); ?> <br/><br/>
                                                        <strong>CAISSE:</strong><?php echo $csse['LIBELLE_CAISSE']; ?> <br/><br/>
                                                        <strong> MONTANT POURVU : </strong><?php echo number_format($infossession['MONTANT_POURVU'], 0, '', ' '); ?> <br/><br/>
                                                        <strong>SOLDE DE CAISSE: </strong><?php $solde = (($infossession['MONTANT_ENCAISSE'] + $infossession['MONTANT_POURVU']) - $infossession['MONTANT_POURVU_RESTANT']);
                                            echo number_format($solde, 0, '', ' '); ?><br/>
                                                    </td>
                                                </tr>

                                            </table>
                                            <table style="float: left;">
                                                <tr>
                                                    <td>
                                                        <strong><u>SIGNATURE RESPONSABLE CAISSE</u></strong>
                                                    </td>
                                                </tr>

                                            </table>
                                            <table style="float: right;">
                                                <tr>
                                                    <td>
                                                        <strong><u>SIGNATURE CAISSIERE</u></strong>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>                                      



                                    </div>
                                    <br/><br/><br/>
                                    <table style="margin: 0 auto;width: 400px;">
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-blue btn-lg" id="btnPrint" onclick="printContent('imp')" >     
                                                    <!--             <button type="button"  name="IMPRIMER" class="btn btn-blue" id="btnPrint">-->
                                                    IMPRIMER
                                                </button> 
                                            </td>
                                            <td>
                                                <a class="btn btn-red btn-lg" href="index.php">
                                                    QUITTER
                                                    <i class="fa fa-times fa fa-white"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>




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
