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
$app_ext_sur = $infos['ApplicationExtSurcharge'];

$fraisEXTSURNAT = $infos['AmendeExtremeSurNat'];
$fraisEXTSURINT = $infos['AmendeExtremeSurInt'];

$app_pds_ttl = $infos['ApplicationPdsTotal'];
$RefusObtempNAT = $infos['RefusObtempNAT'];
$RefusObtempINT = $infos['RefusObtempINT'];

if (isset($_POST['frais_pesage'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [fraisPESAGENAT] = ? ,[fraisPESAGEINT] =? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['f_n'], $_POST['f_in']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification des frais de pesage par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['frais_devise'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [devisePARAM] = ? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['devise']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification de la devise par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['frais_infra_pds_total'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [INFPoidsTotalsAmNAT] = ? ,[INFPoidsTotalsAmINT] =? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['if_n'], $_POST['if_in']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification des frais d'infraction sur le poids total par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['frais_infra_recidive'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [INFRECAmNAT] = ? ,[INFRECAmINT] = ?,[INFRECPlafond] = ? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['am_rec_nat'], $_POST['am_rec_int'], $_POST['pl_rec']));
    if ($q) {
        
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification des frais des infractions recidives par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['frais_infra_essieux'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [INFESSAmNAT] = ? ,[INFESSAmINT] =? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['essieux_nat'], $_POST['essieux_int']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification des frais d'infraction sur essieux par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['frais_infra_gabarit'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [INFGABAmNAT] = ? ,[INFGABAmINT] =? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['gaba_nat'], $_POST['gaba_int']));

    //UPDATE INFRACTION TYPE GABARIT IN TYPE_INFRACIO DB
    $sql2 = "UPDATE [dbo].[TYPE_INFRACTION] SET [MONTANT_INF_INT] =?, [MONTANT_INF_NAT] = ?  WHERE [LIBELLE_CODE_INF] = 'gaba'";
    $q2 = $conn->prepare($sql2);
    $q2->execute(array($_POST['gaba_int'], $_POST['gaba_nat']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification d'infraction sur gabarit par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['app_pds_ttl'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [ApplicationPdsTotal] = ? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['pds_ttl']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification du parametrage sur le type de facturation de pesage par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['extreme_surcharge'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [ApplicationExtSurcharge] = ?,[AmendeExtremeSurNat]=?,[AmendeExtremeSurInt]=? WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['ext_sur'],$_POST['ext_sur_nat'],$_POST['ext_sur_int']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification du parametrage de l'application de l'extreme surcharge par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['refus_obtemp'])) {
    $sql = "UPDATE [dbo].[ADMIN_PARAM] SET [RefusObtempNAT] = ?,[RefusObtempINT] =?  WHERE [IDPARAM] = 1";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['ref_n'], $_POST['ref_in']));

//UPDATE INFRACTION TYPE REFUS D'OBTEMPERER IN TYPE_INFRACIO DB
    $sql2 = "UPDATE [dbo].[TYPE_INFRACTION] SET [MONTANT_INF_INT] =?, [MONTANT_INF_NAT] = ?  WHERE [LIBELLE_CODE_INF] = 'obtp'";
    $q2 = $conn->prepare($sql2);
    $q2->execute(array($_POST['ref_in'], $_POST['ref_n']));
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/parametrage/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Modification des frais d'infraction sur le refus d'obtemperé par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' .$_SESSION['libelle']. " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('PARAMETRE ENREGISTRE');
                window.location.href='intro_admin.php';
                </script>";
    }
}

if (isset($_POST['edit_dyp'])) {
    $dyp1 = md5($_POST['old']);
    $dyp2 = md5($dyp1);
    if ($dyp2 == preg_replace('/\s+/', '', $_SESSION['dyp'])) {
        if ($_POST['new1'] == $_POST['new2']) {
            $dyp = md5($_POST['new1']);
            $m_a = md5($dyp);
            $sql = "UPDATE [dbo].[UTILISATEUR] SET [MP_UT] = ? WHERE [ID_TYPE_UTILISATEUR] = 1 AND [LOGIN_UT] =?";
            $q = $conn->prepare($sql);
            $q->execute(array($m_a,$_SESSION['m_a']));
            if ($q) {
                /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') .": MOT DE PASSE MODIFIE par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . " \n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
                echo "<script>
                    alert('MOT DE PASSE MODIFIE AVEC SUCCES');
                window.location.href='logout.php';
                </script>";
            }
        } else {
            /*             * *****************************JOURAL ENTRY****************** */
            $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
            $log = "*" . date('d-m-Y H:i:s') .": Erreur dans la modification du mot de passe par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . " \n\n";
            fwrite($login_log, $log);
            fclose($login_log);
            /*             * *************************************************************** */
            echo "<script>
                    alert('LES NOUVEAUX MOTS DE PASSE NE CORRESPONDENT PAS');
                window.location.href='intro_admin.php';
                </script>";
        }
    } else {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Erreur dans la modification du mot de passe par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . " \n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('INCORRECT MOT DE PASSE');
                window.location.href='intro_admin.php';
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
        <script type="text/JavaScript">
             function valid(f) {
!(/^[0-9#209#241]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209#241]/ig,''):null;
}
            function valid2(f) {
            !(/^[A-z;]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z;]/ig,''):null;
            }
        </script>
        <!----> <style>

            html,body {
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
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
                                            <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                                            <span class="username"><?php echo $_SESSION['nom_utilisateur']; ?></span>
                                            <i class="clip-chevron-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="width: -2px;">
                                            <li>
                                                <a href="#edit" data-toggle = "modal"><i class="clip-locked"></i>
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
                                <h1>ADMINISTRATION <small>Afrique Pesage </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <!-- start: PAGE CONTENT -->
                    <div class="row" style="margin-top: 2%;">
                        <div class="col-sm-12" >
                            <!-- start: RESPONSIVE ICONS BUTTONS PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading" style="color:#8C001A;">
                                    <i class="clip-menu-3 "></i>
                                    ADMINISTRATION AFRIQUE PESAGE 
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href = "#parametrage" data-toggle = "modal" >
                                                <button class="btn btn-icon btn-block">

                                                    <i class="fa fa-gears"></i>
                                                    PARAMETRAGE <span class="badge badge-danger"> <i class="fa fa-gears"></i> </span>

                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href = "utilisateurs.php">
                                                <button class="btn btn-icon btn-block">
                                                    <i class="fa fa-group"></i>
                                                    UTILISATEURS <span class="badge badge-danger"> <i class="clip-book"></i> </span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href = "profiles.php">
                                                <button class="btn btn-icon btn-block">
                                                    <i class="clip-book"></i>
                                                    PROFILES <span class="badge badge-danger"> <i class="clip-book"></i> </span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href = "assets/log">
                                                <button class="btn btn-icon btn-block">
                                                    <i class="clip-book"></i>
                                                    JOURNAL <span class="badge badge-danger"> <i class="clip-book"></i> </span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                           <a href = "creation_caisse.php">
                                                <button class="btn btn-icon btn-block">
                                                    <i class="fa fa-book"></i>
                                                    CAISSE & SITE <span class="badge badge-danger"> <i class="fa fa-book"></i> </span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: RESPONSIVE ICONS BUTTONS PANEL -->
                        </div>
                    </div>
                    <!-- end: PAGE CONTENT-->
                </div>
            </div>
            <!-- end: PAGE -->
            <!--start: BOOTSTRAP EXTENDED MODALS -->
            <div id="parametrage" class="modal container fade" tabindex="-1" style="display: none;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">ECRAN DE PARAMETRAGE</h4>
                </div>
                <div class="modal-body">
                    <div class="tabbable">
                        <ul id="myTab" class="nav nav-tabs tab-bricky">
                            <li class="active">
                                <a href="#panel_tab2_example1" data-toggle="tab">
                                    FRAIS PESAGE
                                </a>
                            </li>
                            <li>
                                <a href="#panel_tab2_example2" data-toggle="tab">
                                    UNITE / DEVISE
                                </a>
                            </li>
                            <li>
                                <a href="#panel_tab2_example3" data-toggle="tab">
                                    INFRAº PDS TTL
                                </a>
                            </li>
                            <li>
                                <a href="#panel_tab2_example4" data-toggle="tab">
                                    INFRAº RECIDIVE
                                </a>
                            </li>
                            <li>
                                <a href="#panel_tab2_example5" data-toggle="tab">
                                    INFRAº ESSº
                                </a>
                            </li>
                            <li>
                                <a href="#panel_tab2_example6" data-toggle="tab">
                                    INFRAº GABº
                                </a>
                            </li>
                            <li>
                                <a href="#panel_tab2_example7" data-toggle="tab">
                                    REFUS OBTº
                                </a>
                            </li>
                          <!--  <li>
                                <a href="#panel_tab2_example8" data-toggle="tab">
                                    SAGES WIM
                                </a>
                            </li>-->
                            <li>
                                <a href="#panel_tab2_example9" data-toggle="tab">
                                    APP EXT SURº
                                </a>
                            </li>
                            <li>
                                <a href="#panel_tab2_example10" data-toggle="tab">
                                    TYPE PESAGE
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane in active" id="panel_tab2_example1">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS NATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="f_n" class="form-control" value="<?php echo $fraisPESAGENAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS INTERNATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="f_in" class="form-control" value="<?php echo $fraisPESAGEINT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
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

                            <div class="tab-pane" id="panel_tab2_example2">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            DEVISE :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="devise" class="form-control" value="<?php echo $devisePARAM; ?>" type="text" placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                              <!--  <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            UNITE DE MASSE (KG):
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php //echo $immatriculation['valeur_champs'];                          ?>" type="text" placeholder=""></td>
                                                </tr>-->
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="frais_devise" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="panel_tab2_example3">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE NATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="if_n" class="form-control" value="<?php echo $INFPoidsTotalsAmNAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE INTERNATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="if_in" class="form-control" value="<?php echo $INFPoidsTotalsAmINT; ?>" type="text" placeholder=""onkeyup="valid(this)" onblur="valid(this)" ></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="frais_infra_pds_total" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="panel_tab2_example4">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            PLAFOND RECIDIVE :
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="pl_rec" value="<?php echo $INFRECplafond; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE NATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="am_rec_nat" value="<?php echo $INFRECAmNAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE INTERNATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="am_rec_int" value="<?php echo $INFRECAmINT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="frais_infra_recidive" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="panel_tab2_example5">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE NATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="essieux_nat" value="<?php echo $INFESSAmNAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE INTERNATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="essieux_int" value="<?php echo $INFESSAmINT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>  
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="frais_infra_essieux" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!------------------------------------------------------------->
                            <div class="tab-pane" id="panel_tab2_example6">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE NATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="gaba_nat" value="<?php echo $INFGABAmNAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            AMENDE INTERNATIONALE :
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="gaba_int" value="<?php echo $INFGABAmINT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>  
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="frais_infra_gabarit" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="panel_tab2_example7">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS NATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="ref_n" class="form-control" value="<?php echo $RefusObtempNAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS INTERNATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="ref_in" class="form-control" value="<?php echo $RefusObtempINT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                                FERMER
                                            </button>
                                            <button type="submit" name="refus_obtemp" class="btn btn-primary">
                                                ENREGISTRER
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="panel_tab2_example8">
                                <form method="post" action="">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td>
                                                <label class="col-sm-10 control-label" for="form-field-5">
                                                    BASE DE DONN&Eacute;ES WIM :
                                                </label>
                                            </td>
                                            <td>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input">
                                                            <i class="fa fa-file fileupload-exists"></i>
                                                            <span class="fileupload-preview"></span>
                                                        </div>
                                                        <div class="input-group-btn">
                                                            <div class="btn btn-light-grey btn-file">
                                                                <span class="fileupload-new"><i class="fa fa-folder-open-o"></i> Select file</span>
                                                                <span class="fileupload-exists"><i class="fa fa-folder-open-o"></i> Change</span>
                                                                <input type="file" class="file-input">
                                                            </div>
                                                            <a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
                                                                <i class="fa fa-times"></i> Remove
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>


                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="wim" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="panel_tab2_example9">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <?php
                                                if ($app_ext_sur == 0) {
                                                    ?>
                                                    <tr>

                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                VOULEZ-VOUS APPLIQUER L'EXTR&Ecirc;ME SURCHARGE ?
                                                            </label></td>
                                                        <td>
                                                            <label style="color:#FF2E12"><b>EXTR&Ecirc;ME SURCHARGE NON APPLIQU&Eacute;E</b></label>
                                                            <select id="form-field-1" name="ext_sur" class="form-control">
                                                                <option value="0">NON</option>
                                                                <option value="1">OUI</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS NATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="ext_sur_nat" class="form-control" value="<?php echo $fraisEXTSURNAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS INTERNATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="ext_sur_int" class="form-control" value="<?php echo $fraisEXTSURINT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                VOULEZ-VOUS ANNULER L'APPLICATION DE L'EXTR&Ecirc;ME SURCHARGE ?
                                                            </label></td>
                                                        <td>
                                                            <label style="color:#FF2E12"><b>EXTR&Ecirc;ME SURCHARGE APPLIQU&Eacute;E</b></label>

                                                            <select id="form-field-1" name="ext_sur" class="form-control">
                                                                <option value="1">NON</option>
                                                                <option value="0">OUI</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                    <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS NATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="ext_sur_nat" class="form-control" value="<?php echo $fraisEXTSURNAT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            FRAIS INTERNATIONAL :
                                                        </label></td>
                                                    <td><input id="form-field-1" name="ext_sur_int" class="form-control" value="<?php echo $fraisEXTSURINT; ?>" type="text" placeholder="" onkeyup="valid(this)" onblur="valid(this)"/></td>
                                                </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="extreme_surcharge" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="panel_tab2_example10">
                                <form method="post" action="">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <?php
                                                if ($app_pds_ttl == 0) {
                                                    ?>
                                                    <tr>

                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                VOULEZ-VOUS APPLIQUER LA SURCHARGE AU POIDS TOTAL ?
                                                            </label></td>
                                                        <td>
                                                            <label style="color:#FF2E12"><b>SURCHARGE AU POIDS TOTAL NON APPLIQU&Eacute;</b></label>
                                                            <select id="form-field-1" name="pds_ttl" class="form-control">
                                                                <option value="0">NON</option>
                                                                <option value="1">OUI</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                VOULEZ-VOUS ANNULER L'APPLICATION DE LA SURCHARGE AU POIDS TOTAL ?
                                                            </label></td>
                                                        <td>
                                                            <label style="color:#FF2E12"><b>SURCHARGE AU POIDS TOTAL APPLIQU&Eacute;</b></label>

                                                            <select id="form-field-1" name="pds_ttl" class="form-control">
                                                                <option value="0">OUI</option>
                                                                <option value="1">NON</option>
                                                            </select>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-default">
                                            FERMER
                                        </button>
                                        <button type="submit" name="app_pds_ttl" class="btn btn-primary">
                                            ENREGISTRER
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!---------------------------------------------CHANGE PASSWORD---------------------------------------------------------->
            <!--start: BOOTSTRAP EXTENDED MODALS FOR VERBALISATION-->
            <div id = "edit" class = "modal fade" tabindex = "-1" data-width = "300" style = "display: none;">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                        &times;
                    </button>
                    <h6 class = "modal-title mod">MODIFICATION DE PASSWORD</h6>
                </div>
                <form method="post" id="search_form" action="">
                    <div class = "modal-body">
                        <div class = "row">
                            <div class = "col-md-12">
                                <p>
                                    <input class = "form-control" type = "password" name="old" value="" placeholder="Entrer l'ancien Mot de Passe" style="text-align:center;"/>
                                </p>
                                <p>
                                    <input class = "form-control" type = "password" name="new1" value="" placeholder="Entrer le nouveau Mot de Passe" style="text-align:center;"/>
                                </p>
                                <p>
                                    <input class = "form-control" type = "password" name="new2" value="" placeholder="Confirmer le nouveau Mot de Passe" style="text-align:center;"/>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class = "modal-footer">
                        <button type = "button" data-dismiss = "modal" class = "btn btn-light-grey">
                            ANNULER
                        </button>
                        <button type = "submit" class = "btn btn-red" name="edit_dyp">
                            MODIFIER
                        </button>
                    </div>
                </form>
            </div>
            <!-- end: BOOTSTRAP EXTENDED MODALS FOR VERBALISATION-->
            <!----------------------------------------------PARTIE UTILISATEURS----------------------------------------------------->
            <div id="utilisateurs" class="modal container fade" tabindex="-1" style="display: none;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">ECRAN DE PARAMETRAGE</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
            <!-- end: BOOTSTRAP EXTENDED MODALS -->

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
        <script src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/js/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
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
        <script>
            jQuery(document).ready(function () {
                Main.init();
                UIModals.init();
                FormElements.init();
            });
        </script>
        <script type="text/javascript">
            /*
             function form_submit() {
             document.getElementById("search_form").submit();
             }
             */
        </script>
    </body>
    <!-- end: BODY -->
</html>