<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
include 'connections/AfriquepesageConnection.php';
if (isset($_GET['cptcli'])) {
    $_SESSION['cptcl'] = $_GET['cptcli'];
}
$req1 = $conn->query("SELECT [ID_COMPTE_CLIENT],[ID_CLIENT],[SOLDE_COMPTE_CLIENT],[NOM_RAISON_SOCIAL],[TELEPHONE],[EMAIL],[RESPONSABLE],[SOCIETE],[ACTIVITE],[FAX],[LOCALISATION],[PREFERENTIEL]"
        . " FROM [Afriquepesage].[dbo].[COMPTE_CLIENT]  WHERE [ID_COMPTE_CLIENT]= '" . $_SESSION['cptcl'] . "'");
$req1->execute();
$result1 = $req1->fetch();


$req = $conn->query("SELECT TOP 3 cc.[ID_COMPTE_CLIENT],cc.[ID_CLIENT],cc.[SOLDE_COMPTE_CLIENT],cc.[NOM_RAISON_SOCIAL],cc.[TELEPHONE],
		 cc.[EMAIL],cc.[RESPONSABLE],cc.[SOCIETE],cc.[ACTIVITE],cc.[FAX],cc.[LOCALISATION],cc.[PREFERENTIEL],
		 tc.[ID_TRANSACTION],tc.[ID_COMPTE] ,tc.[ID_OPERATEUR],tc.[NOM_SOCIETE],tc.[MONTANT_CREDITE] ,tc.[DATE_DEPOT],left(tc.[HEURE_DEPOT],8) as HEURE_DEPOT
FROM [COMPTE_CLIENT] cc,[TRANSACTION_COMPTE_CLIENT] tc WHERE tc.[ID_COMPTE]=cc.[ID_COMPTE_CLIENT] AND [ID_COMPTE_CLIENT]= '" . $_SESSION['cptcl'] . "' order by [ID_MOUVEMENT] desc");
$req->execute();
$result = $req->fetchAll();

/// récuperation de la devise parametrée pour les affichages sur les formulaires et reçus
$reqe = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
//  $reqe->execute();
$tr = $reqe->fetch();
$devise = $tr['devisePARAM'];

if (isset($_GET['cptcli'])) {

    $sql = "UPDATE [Afriquepesage].[dbo].[COMPTE_CLIENT] SET [SOLDE_COMPTE_CLIENT] = ? where [ID_COMPTE_CLIENT]= ? ";
    $q = $conn->prepare($sql);
    $q->execute(array($_SESSION['cptcl']));
}
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
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
        <!----> <style>
            /*
                            html,body {
                                margin: 0;
                                padding: 0;
                                overflow: hidden;
                            }
            */
            .col-sm-4 {
                width: 33.333%;
            }
            .mod  {
                color:  #8C001A;
                font-weight: bold;
                /* border-style: solid;*/
                /*border-bottom: thick solid #861D20;*/
            }
        </style><!---->
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
                                            <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                                            <span class="username"><?php echo $_SESSION['nom_utilisateur']; ?></span>
                                            <i class="clip-chevron-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="width: -2px;">
                                            <li>
                                                <a href="#"><i class="clip-home-2"></i>
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                                ?></a></li>
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
                                <h1>RECU DE D&Eacute;P&Ocirc;T<small>COMPTE CLIENT </small></h1>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <div class="row" id="imp" style="; margin-top: 0.1%;">
                        <div class="col-sm-12">
                            <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 5%; "/>
                        </div>
                        <div class="col-sm-12" style="; margin-top: 1%;">
                            <!-- start: RESPONSIVE ICONS BUTTONS PANEL -->
                            <div class="col-sm-4">
                                <h4>CLIENT:</h4>
                                <div class="well">
                                    <address>
                                        <strong><?php echo $result1['SOCIETE']; ?></strong>
                                        <br>
                                        <?php echo $result1['ACTIVITE']; ?>
                                        <br>
                                        <?php echo $result1['LOCALISATION']; ?>
                                        <br>
                                        <abbr title="Phone">TEL:</abbr> <?php echo $result1['TELEPHONE']; ?>
                                        <br>
                                        <abbr title="Phone">RESPONSABLE:</abbr> <?php echo $result1['RESPONSABLE']; ?>
                                    </address>
                                    <address>
                                        <strong>E-mail</strong>
                                        <br>
                                        <?php echo $result1['EMAIL']; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="col-sm-4 pull-right">
                                <h4>D&Eacute;TAILS DE PAIEMENT</h4>
                                <ul class="list-unstyled invoice-details">
                                    <li>
                                        <strong>N° DE TRANSACTION #:</strong><?php echo $_SESSION['id_transaction']; ?>
                                    </li>
                                    <li>
                                        &nbsp;
                                    </li>
                                    <li>
                                        <strong>N° DE COMPTE #:</strong> <?php echo $_SESSION['cptcl']; ?>
                                    </li>
                                    <li>
                                        <h5>
                                            <label style="color:#8C001A;font-weight:bold;">
                                                <strong>MONTANT CREDITE:</strong> <?php echo number_format($_SESSION['credit'], 0, '', ' '); ?>
                                            </label>
                                        </h5>
                                    </li>
                                    <li>
                                        <strong>DATE DE D&Eacute;P&Ocirc;T:</strong> <?php echo date("d-m-Y"); ?>
                                    </li>
                                    <li>
                                        &nbsp;
                                    </li>
                                    <li>
                                        <strong>HEURE DE D&Eacute;P&Ocirc;T:</strong><?php echo $_SESSION['heure']; ?>
                                    </li>
                                    <li>
                                        &nbsp;
                                    </li>
                                    <li>
                                        <h5>
                                            <label style="color:#8C001A;font-weight:bold;">
                                                <strong>SOLDE DU COMPTE:</strong><?php echo number_format($result1['SOLDE_COMPTE_CLIENT'], 0, '', ' '); ?>
                                            </label>
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                            <!-- end: RESPONSIVE ICONS BUTTONS PANEL -->
                        </div>
                        <div class="col-sm-12">
                            <div align="center">
                                <h3>
                                    <label style="color:#8C001A;font-weight:bold;">&Eacute;TAT DES 3 DERNIERS D&Eacute;P&Ocirc;TS</label>
                                </h3>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th> N° TRANSACTION</th>
                                        <th class="hidden-480"> MONTANT CREDITE </th>
                                        <th class="hidden-480"> DATE DEPOT </th>
                                        <th class="hidden-480"> HEURE DEPOT </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $rs) {
                                        ?>
                                        <tr>
                                            <td> <?php echo $rs['ID_TRANSACTION'] ?> </td>
                                            <td class="hidden-480"><?php echo number_format($rs['MONTANT_CREDITE'], 0, '', ' ') ?> </td>
                                            <td class="hidden-480"><?php echo date_format(date_create($rs['DATE_DEPOT']), 'd-m-Y') ?> </td>
                                            <td class="hidden-480"><?php echo $rs['HEURE_DEPOT'] ?> </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
                                    <strong><u>SIGNATURE CLIENT</u></strong>
                                </td>
                            </tr>

                        </table>
                    </div><br>

                    <br>
                    <table style="float:right;">
                        <tr>
                            <td>
                                <button onclick="printContent('imp')" class="btn btn-blue btn-lg" id="btnPrint">IMPRIMER</button>  
                            </td>
                            <td>
                                &nbsp;&nbsp;&nbsp;
                            </td>
                            <td>
                                <a class="btn btn-red btn-lg" href="saisie_cptclient.php">
                                    RETOUR
                                    <i class="fa fa-times fa fa-white"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!-- end: PAGE CONTENT-->
                </div>
                <!-- end: PAGE -->
            </div>
            <!-- end: MAIN CONTAINER -->
            <!-- debut fenetre utilisateur-->
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
            <!-- fin fenetre utilisateur -->
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
            <script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
            <script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
            <script src="assets/js/ui-modals.js"></script>
            <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
            <script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
            <script src="assets/plugins/select2/select2.min.js"></script>
            <script src="assets/js/form-elements.js"></script>
            <script>
                                    jQuery(document).ready(function () {
                                        Main.init();
                                        TableData.init();
                                    });
            </script>
            <script language="JavaScript" type="text/javascript">
                function printContent(el) {
                    var restorepage = document.body.innerHTML;
                    var printcontent = document.getElementById(el).innerHTML;
                    document.body.innerHTML = printcontent;
                    window.print();
                    document.body.innerHTML = restorepage;
                }
            </script>
    </body>
    <!-- end: BODY -->
</html>
