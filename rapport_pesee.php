<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
//echo session_id()
    $nom_site = $_SESSION['site'];
    $user_id = $_SESSION['userid'];
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';

if (isset($_POST['search'])) {
    if (isset($_POST['dates'])) {
        $date_entry = $_POST['dates'];
        $req = $conn->query("SELECT * FROM [Afriquepesage].[dbo].[VERBALISATION] where [DATE_VERB] ='$date_entry' AND [NOM_STE] = '$nom_site' AND [ID_USER]='$user_id'");
        $req->execute();
        $result = $req->fetchAll();
    } else {
        
    }
    //echo $_POST['dates2'] . ' ' . $_POST['dates3'];
} else if (isset($_POST['research'])) {
    if (isset($_POST['dates2']) && isset($_POST['dates3'])) {
        $id = $_SESSION['userid'];
        $date_entry2 = $_POST['dates2'];
        $date_entry3 = $_POST['dates3'];
        //echo $date_entry2 . '' . $date_entry3;
        $req = $conn->query("SELECT * FROM [Afriquepesage].[dbo].[VERBALISATION] where [ID_USER] ='$id' AND [NOM_STE] = '$nom_site' AND [DATE_VERB] BETWEEN '$date_entry2' and '$date_entry3'");
        $req->execute();
        $result = $req->fetchAll();
    } else {
        
    }
} else {
    ////DAILY VERBALISATION
	$id = $_SESSION['userid'];
    $dte = date('d-m-Y');
    $req = $conn->query("SELECT [ID_VERB],[NUMERO_PESE],[DATE_PESEE_WIM],[NOM_CLIENT],[PROV_DEST],[POIDS_TOTAL],[TRANSIT],[EXPORTATEUR],[IMMAT_VEHICULE],[CLASSE_VEHICULE],[NATIONALITE],[SILHOUETTE_VEHICULE],[PRODUIT_TRANSPORTE],[NUM_PESEE_WIM] FROM [Afriquepesage].[dbo].[VERBALISATION] WHERE [DATE_VERB]='$dte' AND [NOM_STE]= '$nom_site'");
    
//$req = $conn->query("SELECT [ID_VERB],[NUMERO_PESE],[DATE_PESEE_WIM],[NOM_CLIENT],[PROV_DEST],[POIDS_TOTAL],[TRANSIT],[EXPORTATEUR],[IMMAT_VEHICULE],[CLASSE_VEHICULE],[NATIONALITE],[SILHOUETTE_VEHICULE],[PRODUIT_TRANSPORTE],[NUM_PESEE_WIM] FROM [Afriquepesage].[dbo].[VERBALISATION] WHERE [DATE_VERB]='$dte' AND [ID_USER]='$id'");
    $req->execute();
    $result = $req->fetchAll();
}


//DATE REQUEST
$dte = $conn->prepare("SELECT DISTINCT [DATE_VERB] FROM [Afriquepesage].[dbo].[VERBALISATION] WHERE [NOM_STE] = '$nom_site'");
$dte->execute();
$dte_result = $dte->fetchAll();
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
        <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
        <link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
        <!-- start: CSS REQUIRED FOR MODAL PAGE ONLY -->
        <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
        <style>
            .mod  {
                color:  #8C001A;
                font-weight: bold;
                /* border-style: solid;*/
                /*border-bottom: thick solid #861D20;*/
            }
        </style>
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="page-full-width">
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <div class="main-content">
                <div class="container">
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
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                    ?></a></li>
                                            <li>
                                                <a href="#" onclick="alert('Contactez Votre Responsable Site')"><i class="clip-locked"></i>
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
                                    RECAP DE VERBALISATION <small>Op&eacute;rateur </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="row" style="margin-top:3%;">
                        <div class="col-sm-12">
                            <form method="post" action="operateur_recap.php">
                                <table width="100%" border="0">
                                    <tr>
                                       
                                        <td>
                                            <div align="center">
                                                <h5><label style="color:#8C001A;font-weight:bold;">RECHERCHE PAR P&Eacute;RIODE:</label></h5>
                                            </div>
                                        </td>
                                        <td>
                                            <select name="dates2" id="form-field-select-1" class="form-control" >
                                                <option value="">Date de d&eacute;but ...</option>
                                                <?php
                                                foreach ($dte_result as $key) {
                                                    ?>
                                                    <option value="<?php echo $key['DATE_VERB']; ?>"><?php echo $key['DATE_VERB']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><select name="dates3" id="form-field-select-1" class="form-control" >
                                                <option value="">Date de fin ...</option>
                                                <?php
                                                foreach ($dte_result as $key) {
                                                    ?>
                                                    <option value="<?php echo $key['DATE_VERB']; ?>"><?php echo $key['DATE_VERB']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <button type = "submit" class = "btn btn-blue" name="research">
                                                    RECHERCHE
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <!-- start: DYNAMIC TABLE PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    R&Eacute;CAPITULATIF JOURNALIER DE VERBALISATION
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                        <thead>
                                            <tr>
                                                <th>Nº VERBALISATION</th>
                                                <!--<th class="hidden-xs">Nº PES&Eacute;E</th>-->
                                                <th class="hidden-xs"> NOM CLIENT</th>
                                                <th>PROV/DEST</th>
                                                <th class="hidden-xs">TRANSPORT</th>
                                                <th>EXPORTATEUR</th>
                                                <th class="hidden-xs">NATIONALIT&Eacute;</th>
                                                <th>IMMATRICULATION</th>
                                                <th>CLASS VEHICULE</th>
                                                <th>SILHOUETTE</th>
                                                <th>PROD TRANSPORT&Eacute;</th>
                                                <th>POIDS TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $originalDate = "2010-03-21";
                                            $newDate = date("d-m-Y", strtotime($originalDate));
                                            foreach ($result as $value) {
                                                ?>

                                                <tr class='clickable-row' data-href='verbalisation_recap.php?np=<?php echo $value['NUM_PESEE_WIM']; ?>&nv=<?php echo $value['ID_VERB']; ?>&dte=<?php echo $value['DATE_PESEE_WIM']; ?>' style="cursor: pointer;">
                                                    <td><?php echo $value['ID_VERB'] ?></td>
                                                    <!--<td class="hidden-xs"><?php //echo $value['NUMERO_PESE'] ?></td>-->
                                                    <td><?php echo $value['NOM_CLIENT'] ?></td>
                                                    <td class="hidden-xs"><?php echo $value['PROV_DEST'] ?></td>
                                                    <td class="hidden-xs"><?php echo $value['TRANSIT'] ?></td>
                                                    <td><?php echo $value['EXPORTATEUR'] ?></td>
                                                    <td class="hidden-xs"><?php echo $value['NATIONALITE'] ?></td>
                                                    <td><?php echo $value['IMMAT_VEHICULE'] ?></td>
                                                    <td class="hidden-xs"><?php echo $value['CLASSE_VEHICULE'] ?></td>
                                                    <td><img src="<?php echo $value['SILHOUETTE_VEHICULE'] ?>"/></td>
                                                    <td class="hidden-xs"><?php echo $value['PRODUIT_TRANSPORTE'] ?></td>
                                                    <td><?php echo $value['POIDS_TOTAL'] . ' KG' ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end: DYNAMIC TABLE PANEL -->
                        </div>
                    </div>
                    <div style="width:100px; margin: 0 auto;">
                        <a class="btn btn-red btn-lg" href="intro_stat.php">
                            ANNULER
                            <i class="fa fa-times fa fa-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- end: PAGE HEADER -->
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
        <!-- end: RIGHT SIDEBAR -->
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
        <script src="assets/js/ui-buttons.js"></script>
        <script src="assets/plugins/ladda-bootstrap/dist/spin.min.js"></script>
        <script src="assets/plugins/ladda-bootstrap/dist/ladda.min.js"></script>
        <script src="assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js"></script>
        <script src="assets/js/ui-buttons.js"></script>
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script type="text/javascript" src="assets/plugins/bootbox/bootbox.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
        <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
        <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
        <script src="assets/js/table-data.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
                UIButtons.init();
            });
        </script>
        <script>
            jQuery(document).ready(function ($) {
                $(".clickable-row").click(function () {
                    window.document.location = $(this).data("href");
                });
            });
        </script>
        <script>
            jQuery(document).ready(function () {
                Main.init();
                TableData.init();
            });
        </script>
    </body>
    <!-- end: BODY -->
</html>