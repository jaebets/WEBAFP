<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();

//echo session_id
include 'connections/AfriquepesageConnection.php';
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
        <script type="text/JavaScript">
            function valid(f) {
!(/^[0-9#209#241]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209#241]/ig,''):null;
}
            function valid2(f) {
            !(/^[A-z0-9&#209;&#241; ]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241; ]/ig,''):null;
            }
            function valid3(f) {
            !(/^[A-z0-9&#209;&#241;@;.;]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241;@;.;]/ig,''):null;
            }
            
            function valid3(f) {
            !(/^[A-z0-9&#209;&#241;.; ]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241;.; ]/ig,''):null;
            }
        </script>
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
                                    Tableau de Bord <small>Caissi&egrave;re </small></h1>

                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
						    $nomsite = $_SESSION['site'];
                            $info = $conn->query("SELECT [ID_VERB],[ID_USER],[NUMERO_PESE],[DATE_VERB],LEFT([HEURE_VERBALISATION],8) AS HEURE_VERBALISATION,[NATIONALITE],[TRANSIT],[PDPUIT_DANGE],[INF_GABARIT],[LOGIN_OP],[AMENDE_TOTAL],[EXPORTATEUR]
                                                        ,[IMMAT_VEHICULE],[PRODUIT_TRANSPORTE],[NUM_PESEE_WIM],[PROV_DEST],[NOM_STE],[POIDS_TOTAL],[CLASSE_VEHICULE],[PAIMENT_VERBA],[MONTANT_AMENDE_PAYE],[MONTANT_RESTANT]
                                                  FROM [Afriquepesage].[dbo].[VERBALISATION]  WHERE [TRAITE] = 0  order by [Afriquepesage].[dbo].[VERBALISATION].[NUM_PESEE_WIM] desc");
                                        //          FROM [Afriquepesage].[dbo].[VERBALISATION]  WHERE [PAIMENT_VERBA] = 0 and [NOM_STE] = '$nomsite'");
			     $info->execute();
                            $retrieve = $info->fetchAll();   
                        ?>
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                            <thead>
                                <tr > 
                                    <th style="text-align: center;">DATE VERBALISATION</th>
									<th style="text-align: center;">HEURE VERBALISATION</th>
                                    <th class="hidden-xs"style="text-align: center;">NUMERO FICHE DE VERBALISATION</th>
                                    <th style="text-align: center;">NUMERO PESEE</th>
                                    <th class="hidden-xs" style="text-align: center;">IMMATRICULATION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($retrieve as $re) {
                                    ?>
                            <!--     <tr class='clickable-row' data-href='operateur_verbalisaion33.php? nfv=<?php // echo $re['ID_VERB']; ?>' style="cursor: pointer;">  -->
                                <tr class='clickable-row' data-href='detail_verbalisation_all.php?nfv=<?php echo $re['ID_VERB']; ?>' style="cursor: pointer;">  
                                    <td><?php echo $re['DATE_VERB']; ?></td>
									<td><?php echo $re['HEURE_VERBALISATION']; ?></td>
                                    <td class="hidden-xs"><?php echo $re['ID_VERB']; ?></td>
                                    <td><?php echo $re['NUM_PESEE_WIM']; ?></td>
                                    <td class="hidden-xs"><?php echo $re['IMMAT_VEHICULE']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--</div>-->
                    <!-- end: DYNAMIC TABLE PANEL -->
					
                    <div style="width: 30%;margin: 0 auto;"><!--width: 40% avec vlidation button-->
                        <table>
					<tr>
					<td>
					<a class="btn btn-blue btn-lg" HREF="javascript:history.go(0)">
                            ACTUALISER
                            <i class="	clip-refresh "></i>
                        </a>
					</td>
					<td>
					&nbsp;
					</td>
					<td>
					<a class="btn btn-red btn-lg" href="intro_responsable_caisse.php">
                            RETOUR
                            <i class="fa fa-times fa fa-white"></i>
                        </a>
					</td>
					</tr>
					</table>
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
                <!-- </div>-->
                <!-- end: PAGE CONTENT-->
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
    <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.users.min.js"></script>
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
