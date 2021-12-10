<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
//echo session_id()
if ($_SESSION['first_connect'] != 1) {
    $id_u = preg_replace('/\s+/', '', $_SESSION['userid']);
    echo "<script>alert('C\'EST VOTRE PREMIERE CONNEXION, VEUILLEZ MODIFIER LE MOT DE PASSE AVANT DE CONTINUER'); window.location.href='first_connect.php?id=$id_u';</script>";
} else {
    if (isset($_GET['dyp'])) {
        $IDV = $_GET['dyp'];
        ////NUMBER PLATE LIST
        $req = $conn->query("SELECT B.ID_CLIENT,B.NOM_RAISON_SOCIAL,A.ID_VEHICULE,A.IMMATRICULATION FROM TRANSPORTEUR A,CLIENT B WHERE A.ID_VEHICULE=B.ID_CLIENT AND B.ID_CLIENT = '$IDV' ORDER BY A.IMMATRICULATION");
        $req->execute();
        $result = $req->fetchAll();
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
                <?php //echo $INFRECAmNAT;   ?>
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
                                                            &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];?></a></li>
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
                                            DETAIL IMMATRICULATION <small>Responsable Site </small></h1>
                                        <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                                    </div>
                                    <!-- end: PAGE TITLE & BREADCRUMB -->
                                </div>
                            </div>
                            <!-- end: PAGE HEADER -->
                            <!-- start: PAGE CONTENT -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- start: DYNAMIC TABLE PANEL -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-external-link-square"></i>
                                            LISTE DES IMMATRICULATIONS ENREGISTREE
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="btn-group pull-right">
                                                        <li class="btn btn-red dropdown-toggle" >
                                                            <a href="#" class="export-excel" data-table="#sample-table-1" style="text-decoration:none;color: #ffffff;">
                                                                <span >Exporter vers Excell</span>
                                                            </a>
                                                        </li>
                                                        <!-- <li>
                                                             <form method="post" action="export.php">
                                                                 <button type="submit" name="export">Exporter vers Excell</button>
                                                             </form>
                                                         </li>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="sample-table-1">
                                                    <thead>
                                                        <tr>
                                                            <th>PROPRIETAIRE</th>
                                                            <th>IMMATRICULATION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($result as $value) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $value['NOM_RAISON_SOCIAL']; ?></td>
                                                                <td><?php echo $value['IMMATRICULATION']; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: DYNAMIC TABLE PANEL -->
                                </div>
                            </div>
                            <div style="width:100px; margin: 0 auto;">
                                <a class="btn btn-red btn-lg" href="transporteurs.php">
                                    RETOUR
                                    <i class="fa fa-times fa fa-white"></i>
                                </a>
                            </div>

                            <!-- end: PAGE CONTENT-->
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

                <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>

                <script src="assets/plugins/bootbox/bootbox.min.js"></script>
                <script type="text/javascript" src="assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
                <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>

                <script src="assets/plugins/tableExport/tableExport.js"></script>
                <script src="assets/plugins/tableExport/jquery.base64.js"></script>
                <script src="assets/plugins/tableExport/html2canvas.js"></script>
                <script src="assets/plugins/tableExport/jquery.base64.js"></script>
                <script src="assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>
                <script src="assets/plugins/tableExport/jspdf/jspdf.js"></script>
                <script src="assets/plugins/tableExport/jspdf/libs/base64.js"></script>
                <script src="assets/js/table-export.js"></script>

                <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
                <script>
                                                            jQuery(document).ready(function () {
                                                                Main.init();
                                                                TableExport.init();
                                                            });
                </script>
            </body>
            <!-- end: BODY -->
        </html>
        <?php
    } else {
        
    }
}
?>