<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */

session_start();
include 'connections/AfriquepesageConnection.php';
$info = $conn->query("SELECT * FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
$info->execute();
$infos = $info->fetch();
$fraisPESAGENAT = $infos['fraisPESAGENAT'];
$fraisPESAGEINT = $infos['fraisPESAGEINT'];
$devisePARAM = $infos['devisePARAM'];
$INFPoidsTotalsAmNAT = $infos['INFPoidsTotalsAmNAT'];
$INFPoidsTotalsAmINT = $infos['INFPoidsTotalsAmINT'];
$INFRECplafond = $infos['INFRECPlafond'];
$INFRECAmNAT = $infos['INFRECAmNAT'];
$INFRECAmINT = $infos['INFRECAmINT'];
$INFESSAmNAT = $infos['INFESSAmNAT'];
$INFESSAmINT = $infos['INFESSAmINT'];
$INFGABAmNAT = $infos['INFGABAmNAT'];
$INFGABAmINT = $infos['INFGABAmINT'];
$BDWIM = $infos['BDWIM'];

if (isset($_POST['frais_pesage'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [fraisPESAGENAT] = ? ,[fraisPESAGEINT] =? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['f_n'], $_POST['f_in']));
    if ($q) {
        echo "<script>
                    alert('VERBALISATION ENREGISTREE');
                /*window.location.href='intro_admin.php';*/
                </script>";
    }
}

if (isset($_POST['frais_devise'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [devisePARAM] = ? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['devise']));
    if ($q) {
        echo "<script>
                    alert('VERBALISATION ENREGISTREE');
                /*window.location.href='intro_admin.php';*/
                </script>";
    }
}

if (isset($_POST['frais_infra_pds_total'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [INFPoidsTotalsAmNAT] = ? ,[INFPoidsTotalsAmINT] =? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['if_n'], $_POST['if_in']));
    if ($q) {
        echo "<script>
                    alert('VERBALISATION ENREGISTREE');
                /*window.location.href='intro_admin.php';*/
                </script>";
    }
}

if (isset($_POST['frais_infra_recidive'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [INFRECAmNAT] = ? ,[INFRECAmINT] = ?,['INFRECPlafond'] = ? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['am_rec_nat'], $_POST['am_rec_int'], $_POST['pl_rec']));
    if ($q) {
        echo "<script>
                    alert('VERBALISATION ENREGISTREE');
                /*window.location.href='intro_admin.php';*/
                </script>";
    }
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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
        <style>

            label,h6  {
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
        <?php
        ?>
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
                                                    &nbsp;Site: <?php echo $_SESSION['site']; ?></a></li>
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
                                <img src="assets/images/signature-big-logo3.png" alt="log AFP"/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                        <div class="col-sm-4" >
                            <p>
                            <h5>CONFIGURATION DE FRAIS DE PESAGE</h5>                            
                            </p>
                            <div class="panel-body">
                                <div class="form-group">
                                    <form method="post" action="">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                FRAIS NATIONAL:
                                                            </label></td>
                                                        <td><input id="form-field-1" name="f_n" class="form-control" value="<?php echo $fraisPESAGENAT; ?>" type="text" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                FRAIS INTERNATIONAL :
                                                            </label></td>
                                                        <td><input id="form-field-1" name="f_in" class="form-control" value="<?php echo $fraisPESAGEINT; ?>" type="text" placeholder=""></td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn btn-default">
                                                    FERMER
                                                </button>
                                                <button type="submit" name="frais_pesage" class="btn btn-primary">
                                                    ENREGISTRER
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" >
                            <p>
                            <h5>INFRACTION POIDS TOTAL</h5>                            
                            </p>
                            <div class="panel-body">
                                <div class="form-group">
                                    <form method="post" action="">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                FRAIS NATIONAL:
                                                            </label></td>
                                                        <td><input id="form-field-1" name="f_n" class="form-control" value="<?php echo $fraisPESAGENAT; ?>" type="text" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                FRAIS INTERNATIONAL :
                                                            </label></td>
                                                        <td><input id="form-field-1" name="f_in" class="form-control" value="<?php echo $fraisPESAGEINT; ?>" type="text" placeholder=""></td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn btn-default">
                                                    FERMER
                                                </button>
                                                <button type="submit" name="frais_pesage" class="btn btn-primary">
                                                    ENREGISTRER
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" >
                            <p>
                            <h5>CONFIGURATION DE FRAIS DE PESAGE</h5>                            
                            </p>
                            <div class="panel-body">
                                <div class="form-group">
                                    <form method="post" action="">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                FRAIS NATIONAL:
                                                            </label></td>
                                                        <td><input id="form-field-1" name="f_n" class="form-control" value="<?php echo $fraisPESAGENAT; ?>" type="text" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                FRAIS INTERNATIONAL :
                                                            </label></td>
                                                        <td><input id="form-field-1" name="f_in" class="form-control" value="<?php echo $fraisPESAGEINT; ?>" type="text" placeholder=""></td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn btn-default">
                                                    FERMER
                                                </button>
                                                <button type="submit" name="frais_pesage" class="btn btn-primary">
                                                    ENREGISTRER
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align:center;width: 50%; margin: 0 auto;">
                        <div class="footer-inner">
                            AFRIQUE PESAGE S.A c&ocirc;te d'ivoire - Abidjan - Zone 4C, Rue du docteur CALMETTE - Adresse:16
                        </div>
                    </div>
                    <!-- end: FOOTER -->
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
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
            window.document.location = $(this).data("href");
            }
            }
        </script>
    </body>
    <!-- end: BODY -->
</html>
