<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
//echo session_id()
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
if ($_SESSION['first_connect'] != 1) {
    $id_u = preg_replace('/\s+/', '', $_SESSION['userid']);
    echo "<script>alert('C\'EST VOTRE PREMIERE CONNEXION, VEUILLEZ MODIFIER LE MOT DE PASSE AVANT DE CONTINUER'); window.location.href='first_connect.php?id=$id_u';</script>";
} else {

    //LISTE VERBALISATION PAR STATION DE PESAGE
    $reqs = $conn->query("SELECT COUNT(*) as TOTAL FROM [Afriquepesage].[dbo].[VERBALISATION]");
    $reqs->execute();
    $result_count = $reqs->fetch();
    
    //LISTE VERBALISATION PAR STATION DE PESAGE
    $per_month = date('m-Y');
    $req = $conn->query("SELECT b.[nom_S] as NOM_SITE, COUNT(a.[ID_VERB]) as COUNTER FROM [Afriquepesage].[dbo].[VERBALISATION] a, [Afriquepesage].[dbo].[Site] b 
                        where a.NOM_STE = b.nom_S AND a.DATE_VERB like '%$per_month%' group by a.NOM_STE,b.nom_S");
    $req->execute();
    $result = $req->fetchAll();
    
    //LISTE VERBALISATION NON PAYE PAR STATION DE PESAGE
    $req_np = $conn->query("SELECT b.[nom_S] as NOM_SITE, COUNT(a.[ID_VERB]) as COUNTER FROM [Afriquepesage].[dbo].[VERBALISATION] a, [Afriquepesage].[dbo].[Site] b 
                        where a.NOM_STE = b.nom_S AND a.DATE_VERB like '%$per_month%' AND a.TRAITE='0' group by a.NOM_STE,b.nom_S");
    $req_np->execute();
    $result_np = $req_np->fetchAll();
    
     //LISTE VERBALISATION  PAYE PAR STATION DE PESAGE
    $req_p = $conn->query("SELECT b.[nom_S] as NOM_SITE, COUNT(a.[ID_VERB]) as COUNTER FROM [Afriquepesage].[dbo].[VERBALISATION] a, [Afriquepesage].[dbo].[Site] b 
                        where a.NOM_STE = b.nom_S AND a.DATE_VERB like '%$per_month%' AND a.TRAITE='1' group by a.NOM_STE,b.nom_S");
    $req_p->execute();
    $result_p = $req_p->fetchAll();
    
    //LISTE VERBALISATION  PAR PAYS PAR STATION DE PESAGE
    $req_ppN = $conn->query("SELECT b.[nom_S] as NOM_SITE, COUNT(a.[ID_VERB]) as COUNTER FROM [Afriquepesage].[dbo].[VERBALISATION] a, [Afriquepesage].[dbo].[Site] b 
                        where a.NOM_STE = b.nom_S AND a.DATE_VERB like '%$per_month%' AND a.[TRANSIT]='NATIONAL' group by a.NOM_STE,b.nom_S");
    $req_ppN->execute();
    $result_ppN = $req_ppN->fetchAll();
    
    //LISTE VERBALISATION  PAR PAYS PAR STATION DE PESAGE
    $req_ppINT = $conn->query("SELECT b.[nom_S] as NOM_SITE, COUNT(a.[ID_VERB]) as COUNTER FROM [Afriquepesage].[dbo].[VERBALISATION] a, [Afriquepesage].[dbo].[Site] b 
                        where a.NOM_STE = b.nom_S AND a.DATE_VERB like '%$per_month%' AND a.[TRANSIT]='INTERNATIONAL' group by a.NOM_STE,b.nom_S");
    $req_ppINT->execute();
    $result_ppINT = $req_ppINT->fetchAll();


//DATE REQUEST
    $dte = $conn->prepare('SELECT DISTINCT [DATE_VERB] FROM [Afriquepesage].[dbo].[VERBALISATION]');
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
                                                        &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                     ?></a></li>
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
                                        STATISTIQUES <small>Afrique Pesage </small></h1>
                                    <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                                </div>
                                <!-- end: PAGE TITLE & BREADCRUMB -->
                            </div>
                        </div>
                        <div class="row" style="margin-top:1%;">
                            <div class="col-sm-6">
                                <!-- start: DYNAMIC TABLE PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        REPARTITION DES V&Eacute;HICULES PES&Eacute;S <strong><span style="color:red; te">PAY&Eacute;S</span></strong> PAR STATION DE PESAGE
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                            <thead>
                                                <tr>
                                                    <th>SITE</th>
                                                    <!--<th class="hidden-xs">Nº PES&Eacute;E</th>-->
                                                    <th class="hidden-xs">NBRE DE V&Eacute;HICULES PES&Eacute;S</th>
                                                    <th>% DE V&Eacute;HICULES PES&Eacute;S</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($result_p as $value) {
                                                    ?>

                                                    <tr>
                                                        <td><?php echo $value['NOM_SITE'] ?></td>
                                                        <td class="hidden-xs"><?php echo $value['COUNTER']; ?></td>
                                                        <td><?php echo (($value['COUNTER']/$result_count['TOTAL'])*100)."%"; ?></td>
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
                            <div class="col-sm-6">
                                <!-- start: DYNAMIC TABLE PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        REPARTITION DES V&Eacute;HICULES VERBALIS&Eacute;S PAR STATION DE PESAGE  <strong><span style="color:red; te">AU NATIONAL</span></strong>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                            <thead>
                                                <tr>
                                                    <th>SITE</th>
                                                    <!--<th class="hidden-xs">Nº PES&Eacute;E</th>-->
                                                    <th class="hidden-xs">NBRE DE V&Eacute;HICULES PES&Eacute;S</th>
                                                    <th>% DE V&Eacute;HICULES PES&Eacute;S</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($result_ppN as $value) {
                                                    ?>

                                                    <tr>                                                    
                                                        <td><?php echo $value['NOM_SITE'] ?></td>
                                                        <td class="hidden-xs"><?php echo $value['COUNTER']; ?></td>
                                                        <td><?php echo (($value['COUNTER']/$result_count['TOTAL'])*100)."%"; ?></td>
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
                        
                        <div class="row" style="margin-top:1%;">
                            <div class="col-sm-6">
                                <!-- start: DYNAMIC TABLE PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        REPARTITION DES V&Eacute;HICULES PES&Eacute;S <strong><span style="color:red; te">NON PAY&Eacute;S</span></strong> PAR STATION DE PESAGE
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                            <thead>
                                                <tr>
                                                    <th>SITE</th>
                                                    <!--<th class="hidden-xs">Nº PES&Eacute;E</th>-->
                                                    <th class="hidden-xs">NBRE DE V&Eacute;HICULES PES&Eacute;S</th>
                                                    <th>% DE V&Eacute;HICULES PES&Eacute;S</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($result_np as $value) {
                                                    ?>

                                                    <tr>
                                                        <td><?php echo $value['NOM_SITE'] ?></td>
                                                        <td class="hidden-xs"><?php echo $value['COUNTER']; ?></td>
                                                        <td><?php echo (($value['COUNTER']/$result_count['TOTAL'])*100)."%"; ?></td>
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
                            <div class="col-sm-6">
                                <!-- start: DYNAMIC TABLE PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        REPARTITION DES V&Eacute;HICULES VERBALIS&Eacute;S PAR STATION DE PESAGE  <strong><span style="color:red; te">A L'INTERNATIONAL</span></strong>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                            <thead>
                                                <tr>
                                                    <th>SITE</th>
                                                    <!--<th class="hidden-xs">Nº PES&Eacute;E</th>-->
                                                    <th class="hidden-xs">NBRE DE V&Eacute;HICULES PES&Eacute;S</th>
                                                    <th>% DE V&Eacute;HICULES PES&Eacute;S</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($result_ppINT as $value) {
                                                    ?>

                                                    <tr>                                                    
                                                        <td><?php echo $value['NOM_SITE'] ?></td>
                                                        <td class="hidden-xs"><?php echo $value['COUNTER']; ?></td>
                                                        <td><?php echo (($value['COUNTER']/$result_count['TOTAL'])*100)."%"; ?></td>
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
                        <!-- <div style="width:100px; margin: 0 auto;">
                             <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                 ANNULER
                                 <i class="fa fa-times fa fa-white"></i>
                             </a>
                         </div>-->
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
            <!--<script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>-->
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

    <?php
}
?>
<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 *
session_start();
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
include 'penalite_config.php';

/*
 * ****************************START REQUEST FROM WIM DB*********************
 *
/** get weighing informations
 * recuperer les infos de pesee
 *
$num_pesee_wim = preg_replace('/\s+/', '', $_GET['np']);
$sth = $dbh->prepare('SELECT a."Numero_Pesee", a."Id_VP", a."Date_Pesee", a."Heure_Pesee", a."Unite_Mesure_Pesee", a."Vitesse_Moyenne_Pesee", a."Acceleration_Moyenne_Pesee", a."Selectionne_Pesee", a."Photo_Pesee", a."Commentaire_Pesee", a."Utilisateur_Pesee", a."poids_total_vehicule_Pesee", a."surcharge_Vehicule_Pesee", a."Vitesse_Min_Pesee", a."Vitesse_Max_Pesee", a."Erreur_Pesee", a."Type_Pesee", a."position_virgule", a.RDB$DB_KEY FROM "Pesee" a where a."Id_VP" =' . $_GET['np']);
$sth->execute();
$result = $sth->fetch();

/** get vehicule informations
 * recuperer les infos du vehicule
 *
$sth_VP = $dbh->prepare('SELECT a."id_VP", a."nom_VP", a."poidsMax_VP", a."distFinMin_VP", a."distFinMax_VP", a."distFin_VP", a."longueurMax_VP", a."longueurMesure_VP", a."baseLongMesure_VP", a."hauteurMax_VP", a."hauteurMesure_VP", a."nbrMobiles_VP", a."image_VP", a."distancedebutMesuree_VP", a."distancedebutMin_VP", a."distancedebutMax_VP", a."erreur_VP", a.RDB$DB_KEY FROM "Vehicule_Pese" a where a."id_VP" =' . $result["Id_VP"]);
$sth_VP->execute();
$result_VP = $sth_VP->fetch();
$class_vehicule_uemoa = $result_VP['nom_VP'];
/*
 * ***************************END REQUEST FROM WIM DB**********************
 *

/*
 * **************************REQUEST FROM MSSQL DB***********************
 *
$nv = preg_replace('/\s+/', '', $_GET['nv']);
$_SESSION['verb'] = $nv;
$dtes = $_GET['dte'];
$check_pesee = preg_replace('/\s+/', '', $_GET['np']);
$date_wim_p = date("d-m-Y", strtotime($dtes));
$date_wim_pesee = str_replace("-", ".", $date_wim_p);
//GET THE  VERBALIZATION INFO FROM MSSQL
$request = "SELECT * FROM [dbo].[VERBALISATION] WHERE [ID_VERB]='$nv'";
$status_info = $conn->prepare($request);
$status_info->execute();
$status = $status_info->fetch();

//GET THE  INFRACTION VERBALIZATION INFO FROM MSSQL
$req = "SELECT * FROM [dbo].[VERBALISATION_INFRACTION] WHERE [ID_VERB]='$nv'";
$stat_info = $conn->prepare($req);
$stat_info->execute();
$stat = $stat_info->fetchAll();

/** get vehicule UEMOA informations
 * recuperer les infos UEMOA du vehicule
 *
$uemoa_info = $conn->query("SELECT [ptac_uemoa], [seuil_surch], [seuil_ext_surc]  FROM [Afriquepesage].[dbo].[PARAM_SURCH] WHERE [Type_vehicule] ='$class_vehicule_uemoa'");
$uemoa_info->execute();
$uemoa = $uemoa_info->fetch();

//GET DEVISE
$dev = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
$dev->execute();
$devs = $dev->fetch();
$devise = $devs['devisePARAM'];
/*
 * ****************************END REQUEST FROM MSSQL DB*********************
 *

function switchColor($rowValue) {
    if ($rowValue > 0) {
        $color1 = '#FF0000';
    } else {
        $color1 = '#000000';
    }
    echo $color1;
}

function switchFont($rowValue) {
    if ($rowValue > 0) {
        $color1 = '130%';
    } else {
        $color1 = '100%';
    }
    echo $color1;
}

function color($rowValue) {
    if ($rowValue > 0) {
        $color1 = '#FF0000';
    } else {
        $color1 = '#000000';
    }
    echo $color1;
}

function font($rowValue) {
    if ($rowValue > 0) {
        $color1 = '130%';
    } else {
        $color1 = '100%';
    }
    echo $color1;
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
        <!-- --><style>

            html,body {
                margin: 0;
                padding: 0;
                /*  overflow: hidden;*
            }
            label,h6  {
                color:  #8C001A;
                font-weight: bold;
                /* border-style: solid;*
                /*border-bottom: thick solid #861D20;*
            }
            .third label {
                color:  #0000A0;
                font-weight: bold;
                /* border-style: solid;*
                /*border-bottom: thick solid #861D20;*
            }
            .second label {
                color:  #FF0000;
                font-weight: bold;
                /* border-style: solid;*
                /*border-bottom: thick solid #861D20;*
            }
            .page-header {
                padding-bottom: 1px;
                margin: 1px 0;
            }
            .panel-body {
                padding: 2px;
            }
        </style><!---->
        <script language="JavaScript" type="text/javascript">
            function change(code, ch)
            {
                var champ = document.getElementById(ch);
                var valeur = champ.value;
                if (valeur.search(code) != -1)
                {
                    valeur = valeur.replace(' ' + code + ' ', '');
                    champ.value = valeur;
                    return false;
                } else
                {
                    champ.value += ' ' + code + ' ';
                    return true;
                }
            }
        </script>
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="page-full-width">  
        <?php
        if (!isset($_SESSION['num_pesee'])) {
            
        } else {

            /*
             * Get immatriculation-product-destination-/company infos
             * Recuperer les infos d'immtriculation-produit-destination/provenance-societe/proprietaire
             *
              $immatriculation_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=1 and a."Numero_Pesee" =' . $check_pesee);
              $immatriculation_info->execute();
              $immatriculation = $immatriculation_info->fetch();

              $produit_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=2 and a."Numero_Pesee" =' . $check_pesee);
              $produit_info->execute();
              $produit = $produit_info->fetch();

              $provenance_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=3 and a."Numero_Pesee" =' . $check_pesee);
              $provenance_info->execute();
              $provenance = $provenance_info->fetch();

              $societe_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=4 and a."Numero_Pesee" =' . $check_pesee);
              $societe_info->execute();
              $societe = $societe_info->fetch();
             *


            //liste des infractions
            $nbreInf = "SELECT [CODE_TYPE_INF],[LIBELLE_TYPE_INF],[MONTANT_INF_INT],[MONTANT_INF_NAT] FROM [dbo].[TYPE_INFRACTION]";
            $nbreinfra = $conn->query($nbreInf);
            $totinf = $nbreinfra->fetchAll();
        }
        $num_verbalisation = 'V' . $check_pesee . date('my') . $_SESSION['num_site'];
        $num_pesee = $check_pesee . date('my') . $_SESSION['num_site'];
        $_SESSION['num_verb'] = 'V' . $check_pesee . date('my') . $_SESSION['num_site'];
        $_SESSION['num_pesee_webafp'] = $num_pesee;
        $_SESSION['num_pesee_wim'] = $check_pesee;
        ?>
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <form method="post" action="">
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
                                    <img src="assets/images/signature-big-logo3.png" alt="log AFP"/>
                                </div>
                                <!-- end: PAGE TITLE & BREADCRUMB -->
                            </div>
                        </div>
                        <!-- end: PAGE HEADER -->
                        <!-- start: PAGE CONTENT -->
                        <div class="row second" style="margin-top: 0.5%;padding-left: 1%;padding-right: 1%; border-bottom: 2px solid #8C001A;">
                            <?php
                            if (preg_replace('/\s+/', '', $status['SEUIL_EXTREME_SURCHARGE']) != 'NONE') {
                                ?>
                                <table class="table table-hover table-bordered" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th>NOM CLASSE</th>
                                            <th>PDS MAX VEHICULE (Kg)</th>
                                            <th>PDS ENREGISTR&Eacute; (Kg)</th>
                                            <th>EXC&Eacute;DENT ENREGISTR&Eacute; (Kg)</th>
                                            <th>SEUIL  EXTR&Egrave;ME SURCHARGE (Kg)</th>
                                            <th>EXTR&Egrave;ME SURCHARGE (Kg)</th>
                                            <th>SURCHARGE (Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody style=" text-align: center;">
                                        <tr>
                                            <td>
                                                <?php echo $status['CLASSE_VEHICULE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $status['POIDS_MAX_VEHICULE']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $status['POIDS_TOTAL'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $status['EXCEDENT_ENREGISTRE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $status['SEUIL_EXTREME_SURCHARGE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $status['EXTREME_SURCHARGE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $status['SURCHARGE']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <table class="table table-hover table-bordered" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th>NOM CLASSE</th>
                                            <th>PDS MAX VEHICULE (Kg)</th>
                                            <th>PDS ENREGISTR&Eacute; (Kg)</th>
                                            <th>SURCHARGE (Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody style=" text-align: center;">
                                        <tr>
                                            <td>
                                                <?php echo $status['CLASSE_VEHICULE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $status['POIDS_MAX_VEHICULE']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $status['POIDS_TOTAL'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $status['SURCHARGE']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                        <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                            <div class="col-sm-5" >
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table width="100%" border="0">
                                            <tr >
                                                <td style="width:15% !important;"><label class="col-sm-8 control-label" for="form-field-5">
                                                        Nº VERB
                                                    </label></td>
                                                <td style="width:22% !important;">
                                                    <input id="form-field-9" class="form-control" value="<?php
                                                    $_SESSION['d_verb'] = $status['ID_VERB'];
                                                    echo $status['ID_VERB'];
                                                    ?>"type="text" placeholder="" readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        Nº PESEE
                                                    </label></td>
                                                <td>
                                                    <input id="form-field-1" class="form-control" value="<?php echo $status['NUMERO_PESE']; ?>" type="text" placeholder="" readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        TYPE VEHICULE
                                                    </label></td>
                                                <td id="type">
                                                    <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo substr($status['CLASSE_VEHICULE'], 7); ?>" type="text" placeholder="" readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        SOCI&Eacute;T&Eacute;/PROPRI&Eacute;TAIRE
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $status['NOM_CLIENT']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        IMMATRICULATION
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['IMMAT_VEHICULE']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        PROVENANCE-DESTINATION
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['PROV_DEST']; ?>"  type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        PRODUIT
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['PRODUIT_TRANSPORTE']; ?>"  type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        NATIONALIT&Eacute;
                                                    </label></td>
                                                <td>
                                                    <input id="form-field-1" class="form-control" name="nationalite" type="text" value="<?php echo $status['NATIONALITE']; ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        EXPORTATEUR
                                                    </label></td>
                                                <td>                                                        
                                                    <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $status['EXPORTATEUR']; ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        TRANSPORT
                                                    </label></td>
                                                <td>                                                        
                                                    <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php echo $status['TRANSIT']; ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        OP&Eacute;RATEUR
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['LOGIN_OP']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        UTILISATEUR PESEE WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $result['Utilisateur_Pesee']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table width="100%" border="0">
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                       DATE PESEE WIM
                                                    </label></td>
                                                <td id="type">
                                                    <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo $result['Date_Pesee']; ?>" type="text" placeholder="" readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        HEURE PESEE WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $result['Heure_Pesee']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        VITESSE MOYENNE PESEE WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $result['Vitesse_Moyenne_Pesee']; ?>"  type="text" placeholder="" readonly ></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                       ACCELº MOYENNE PESEE WIM
                                                    </label></td>
                                                <td id="type">
                                                    <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo $result['Acceleration_Moyenne_Pesee']; ?>" type="text" placeholder="" readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        VITESSE MIN PESEE WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $result['Vitesse_Min_Pesee']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        VITESSE MAX PESEE WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $result['Vitesse_Max_Pesee']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        ERREUR PESEE WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $result['Erreur_Pesee']; ?>"  type="text" placeholder="" readonly ></td>
                                            </tr>
                                            
                                            
                                            
                                            
                                            
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        LONGUEUR DE BASE VP WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $result_VP['baseLongMesure_VP']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        LONGUEUR MESUREE VP WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $result_VP['longueurMesure_VP']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        HAUTEUR MAX VP WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $result_VP['hauteurMax_VP']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        HAUTEUR MESUREE VP WIM
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $result_VP['hauteurMesure_VP']; ?>"  type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        SILHOUETTE VEHICULE
                                                    </label></td>
                                                <td id="silhouette"><img src="<?php echo $status['SILHOUETTE_VEHICULE']; ?>"/></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="panel-body" >
                                    <div class="form-group">
                                        <p>
                                        <h6>INFRACTION(S)</h6>                            
                                        </p>
                                        <table width="100%" border="0">
                                            
                                            <?php
                                            if (sizeof($stat) != 0) {
                                                foreach ($stat as $key) {
                                                    ?>
                                                    <tr>
                                                        <td valign="top">
                                                            <label class="checkbox-inline">
        <?php echo $key['LIBELLE_TYPE_INF']; ?>
                                                            </label>
                                                        </td>
                                                        <td valign="top">
                                                            <h6> <?php echo number_format($key['MONTANT_AMENDE'], 0, '', '.') . " " . $devise; ?> </h6>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td valign="top">
                                                        <label class="checkbox-inline">
                                                            <h6>AUCUNE INFRACTION </h6>
                                                        </label>
                                                    </td>
                                                </tr>
<?php } ?>
                                        </table>
                                    </div>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="row" style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                            <div class="col-md-6">
                                <p>
                                <h6>GROUPE ESSIEUX</h6>                            
                                </p>
                                <table class="table table-hover table-bordered" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th>NOM GROUPE</th>
                                            <th>POIDS (Kg)</th>
                                            <th>POIDS MAX (Kg)</th>
                                            <th>SURCHARGE (Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /*
                                         * Get Groupe Essieux infos
                                         * Recuperer les infos Groupe Essieux
                                         *
                                        $grpe_ess_info = $dbh->query('SELECT a."id_GP", a."id_MP", a."nom_GP", a."poidsMax_GP", a."nbrEssieux_GP", a."image_GP", a."poids_GP", a."distMinGroupe_GP", a."distMaxGroupe_GP", a."distGroupeMesure_GP", a."position_GP", a."erreur_GP", a.RDB$DB_KEY FROM "Group_Pese" a where a."id_MP"=' . $check_pesee);
                                        $grpe_ess_info->execute();
                                        $grpe_ess = $grpe_ess_info->fetchAll();
                                        /*
                                         * Get Mx WEIGHT ON ESSIEUX GROUP
                                         * RECUPERER LE POID DU GROUPE ESSIEUX LE PLUS ELEVE
                                         *
                                        $grpe_ess_PDS = $dbh->query('SELECT  MAX (a."poids_GP") as "gp_max" FROM "Group_Pese" a where a."id_MP"=' . $check_pesee);
                                        $grpe_ess_PDS->execute();
                                        $grpe_pds = $grpe_ess_PDS->fetch();
                                        $_SESSION['poid_total_groupe_essieux'] = $grpe_pds['gp_max'];
                                        foreach ($grpe_ess as $gp_es) {
                                            ?>
                                            <tr>
                                                <td>
    <?php echo $gp_es['nom_GP']; ?>
                                                </td>
                                                <td>
    <?php echo $gp_es['poids_GP']; ?>
                                                </td>
                                                <td>
    <?php echo $gp_es['poidsMax_GP']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $sur = $gp_es['poids_GP'] - $gp_es['poidsMax_GP'];
                                                    if ($sur < 0) {
                                                        echo 0;
                                                    } else {
                                                        echo $sur;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
<?php } ?>
                                    </tbody>
                                </table>
                                <!-- <button type="submit" name="renseigner" class="btn btn-green btn-lg" ><!--href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"--
                                ENREGISTRER
                                <i class="fa fa-check fa-white"></i>
                            </button>-->
                               <!-- <a class="btn btn-green btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                   <!-- IMPRIMER
                                    <i class="fa fa-check fa-print"></i>
                                </a>
                                <a class="btn btn-blue btn-lg" href="operateur_recap.php">
                                    ANNULER
                                    <i class="fa fa-times fa fa-white"></i>
                                </a>-->
                                <a class="btn btn-red btn-lg" href="intro_stat.php">
                                    RETOUR
                                    <i class="clip-home"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <p>
                                <h6>ESSIEUX</h6>                            
                                </p>
                                <table class="table table-hover table-bordered" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th>NOM ESSIEUX</th>
                                            <th>POIDS </th>
                                            <th>POIDS MAX</th>
                                            <th>SURCHARGE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($grpe_ess as $g_e) {
                                            /*
                                             * Get  Essieux infos
                                             * Recuperer les infos des Essieux
                                             *
                                            $ess_info = $dbh->query('SELECT a."id_EP", a."id_GP", a."nom_EP", a."poidsMax_EP", a."poidsMesure_EP", a."distMinEssieu_EP", a."distMaxEssieu_EP", a."positionEssieuMesuree_EP", a."distEssieuMesuree_EP", a."vitesse_EP", a."acceleration_EP", a."erreur_EP", a.RDB$DB_KEY FROM "Essieu_Pese" a where a."id_GP"=' . $g_e['id_GP']);
                                            $ess_info->execute();
                                            $ess = $ess_info->fetchAll();
                                            foreach ($ess as $es) {
                                                ?>
                                                <tr>
                                                    <td>
        <?php echo $es['nom_EP']; ?>
                                                    </td>
                                                    <td><?php echo $es['poidsMesure_EP']; ?></td>
                                                    <td>
        <?php echo $es['poidsMax_EP']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $val_sur = $es['poidsMesure_EP'] - $es['poidsMax_EP'];
                                                        if ($val_sur < 0) {
                                                            echo 0;
                                                        } else {
                                                            echo $val_sur;
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <table width="100%" border="0">
                                    <tr>
                                        <td style="float:right;font-size: 3em;">
                                            <h6 style="font-size: 0.5em; color: red;">
                                                <u>MONTANT &Agrave; PAYER:</u>
                                                &nbsp;&nbsp;
                                                <?php
                                                $bill = $status['AMENDE_TOTAL'];
                                                echo number_format($status['AMENDE_TOTAL'], 0, '', '.') . ' ' . $devisePARAM;
                                                ?>
                                            </h6> 
                                        </td>
                                    </tr>
                                </table>
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
                </div>
            </form>
            <!-- end: PAGE -->
            <!-- start: BOOTSTRAP EXTENDED MODALS -->
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
            $('body').on('hidden.bs.modal', '#receipt', function () {
                //alert('hidden again');
                $(this).removeData('bs.modal');
            });
        </script>

    </body>
    <!-- end: BODY -->
</html>
*/