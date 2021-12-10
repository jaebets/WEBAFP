<?php
include 'connections/AfriquepesageConnection.php';
/*
 * Author: c.nguessan@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
//echo session_id()
if (empty($_SESSION['login_utilisateur'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header("Location:index.php");
    exit();
}
//Modification

if (isset($_POST['modifier'])) {
    if ($_POST['mtpourvu'] < 0 || $_POST['mtenleve'] < 0) {

        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Les champs montant pourvu et montant enlevement nont pas été correctement renseignés lor des modifications sur la caisse (ID CAISSE = ".$_SESSION['c'].") par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('Les champs montant pourvu et montant enlevement nont pas été correctement renseignés');
                    window.location.href='maj_affectation.php?id_user=" . $_SESSION['ut'] . "&id_session=" . $_SESSION['s'] . "&id_caisse=" . $_SESSION['c'] . "';
                </script>";
    } else {
        if ($_SESSION['mencaisse'] < $_POST['mtenleve']) {
            /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Tentative de retrait d'un montant supérieur au total des encaissements pendant l'opération d'enlevement sur la caisse (ID CAISSE = ".$_SESSION['c'].")par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
            echo "<script>
                    alert('Le montant retiré ne peut être supérieur au total des encaissements');
                    window.location.href='maj_affectation.php?id_user=" . $_SESSION['ut'] . "&id_session=" . $_SESSION['s'] . "&id_caisse=" . $_SESSION['c'] . "';
                </script>";
        } else {
            $rqup = "UPDATE [Afriquepesage].[dbo].[AFFECTER] SET [MONTANT_POURVU]=?,[MONTANT_POURVU_RESTANT]=? WHERE [ID_SESSION]='" . $_SESSION['s'] . "' AND [ID_USER]='" . $_SESSION['ut'] . "' AND [ID_CAISSE]='" . $_SESSION['c'] . "'";
            $requpdef = $conn->prepare($rqup);
            $requpdef->execute(array($_POST['mtpourvu'], $_POST['mtenleve']));
            /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .":Modification du contenu de la caisse (ID CAISSE = ".$_SESSION['c'].") par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n"
                . "*MONTANT ORIGINAL POURVU = ".$_SESSION['montant_pourvu'] ." *MONTANT ORIGINAL AVANT ENLEVEMENT = ".$_SESSION['montant_pourvu_restant']."\n"
                . "*MONTANT A NOUVEAU POURVU = ".$_POST['mtpourvu']." *MONTANT ENLEVEMENT = ".$_POST['mtenleve']."\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        $sex=$_SESSION['s'];
        $util=$_SESSION['ut'];
        $cai=$_SESSION['c'];
            echo "<script>
                    alert('modification effectuée avec succès');
                    window.location.href='billet_maj_affectation.php?id_user=$util&id_session=$sex&id_caisse=$cai';
                </script>";
        }
    }
}
//recuperation variables
$_SESSION['s'] = $_GET['id_session'];
$_SESSION['ut'] = $_GET['id_user'];
$_SESSION['c'] = $_GET['id_caisse'];
//USER
$requete = $conn->query("SELECT [NOM_UT],[PRENOM_UT]FROM [Afriquepesage].[dbo].[UTILISATEUR] WHERE [ID_USER]='" . $_SESSION['ut'] . "'");
$result = $requete->fetch();

//CAISSE
$reqc = $conn->query("SELECT [LIBELLE_CAISSE],[STATUT_CAISSE] FROM [Afriquepesage].[dbo].[CAISSE] WHERE [ID_CAISSE]='" . $_SESSION['c'] . "'");
$resultc = $reqc->fetch();

//AFFECTER
$reqa = $conn->query("SELECT * FROM [Afriquepesage].[dbo].[AFFECTER] WHERE [ID_SESSION]='" . $_SESSION['s'] . "' AND [ID_USER]='" . $_SESSION['ut'] . "' AND [ID_CAISSE]='" . $_SESSION['c'] . "'");
$resulta = $reqa->fetch();
$_SESSION['mencaisse'] = $resulta['MONTANT_ENCAISSE'];
$_SESSION['montant_pourvu'] = $resulta['MONTANT_POURVU'];
$_SESSION['montant_pourvu_restant'] = $resulta['MONTANT_POURVU_RESTANT'];
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
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                ?></a></li>
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
                                    Mise à jour <small>Responsable caisse </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- end: PAGE HEADER -->
                    <div class="col-sm-12">
                        <strong><span style="color: red"> Modification</span></strong>
                        <form method="POST" action="maj_affectation.php">
                            <table border="0" class="table table-striped table-bordered table-hover table-full-width">
                                <tr style="background-color:#E8B0C2;">
                                    <th style="padding-left: 5px;padding-right: 5px;"> NOM OPERATEUR CAISSE</th>
                                    <th style="padding-left: 5px;padding-right: 5px;">CAISSE</th>
                                    <th style="padding-left: 5px;padding-right: 5px;">MONTANT POURVU</th>
                                    <th style="padding-left: 5px;padding-right: 5px;">MONTANT ENCAISSE</th>
                                    <th style="padding-left: 5px;padding-right: 5px;">MONTANT ENLEVEMENT</th>
                                    <th style="padding-left: 5px;padding-right: 5px;">SOLDE EN CAISSE</th>

                                </tr>  
                                <?php
                                    if($resultc['STATUT_CAISSE']==True) {
                                        ?>
                                <tr>
                                    
                                    <td><?php echo $result['NOM_UT'] . "" . $result['PRENOM_UT']; ?></td>
                                    <td><?php echo $resultc['LIBELLE_CAISSE']; ?></td>
                                    <td><input type="text" name="mtpourvu" value="<?php echo $resulta['MONTANT_POURVU']; ?>" onkeyup="valid(this)" required="true"/></td>
                                    <td><?php echo $resulta['MONTANT_ENCAISSE']; ?></td>
                                    <td><input type="text" name="mtenleve" value="<?php echo $resulta['MONTANT_POURVU_RESTANT']; ?>" onkeyup="valid(this)" required="true" readonly/></td>
                                    <td><?php echo $resulta['MONTANT_ENCAISSE'] + $resulta['MONTANT_POURVU'] - $resulta['MONTANT_POURVU_RESTANT']; ?></td>
                                </tr>
                                <tr>
                                    <td><a class="btn btn-red btn-lg" href="ouverture_caisse.php">RETOUR<i class="fa fa-times fa fa-white"></i></a></td>
                                    <td><input type="submit" value="Modifier" name="modifier" class="btn btn-green btn-lg"/></td>
                                </tr>
                                 <?php
                                    }else{
                                        ?>
                               <tr>
                                    
                                    <td><?php echo $result['NOM_UT'] . "" . $result['PRENOM_UT']; ?></td>
                                    <td><?php echo $resultc['LIBELLE_CAISSE']; ?></td>
                                    <td><input type="text" name="mtpourvu" value="<?php echo $resulta['MONTANT_POURVU']; ?>" readonly="true"/></td>
                                    <td><?php echo $resulta['MONTANT_ENCAISSE']; ?></td>
                                    <td><input type="text" name="mtenleve" value="<?php echo $resulta['MONTANT_POURVU_RESTANT']; ?>" readonly="true"/></td>
                                    <td><?php echo $resulta['MONTANT_ENCAISSE'] + $resulta['MONTANT_POURVU'] - $resulta['MONTANT_POURVU_RESTANT']; ?></td>
                                </tr>
                                    
                                <tr>
                                    <td><a class="btn btn-red btn-lg" href="ouverture_caisse.php">RETOUR<i class="fa fa-times fa fa-white"></i></a></td>
                                    <td><strong>CAISSE CLOSE</strong></td>
                                </tr>
                                <?php }?>
                            </table>
                            <br/>


                        </form>
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
<script type="text/JavaScript" language="JavaScript">
function valid(f) {
!(/^[0-9#209;#241;]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209;#241;]/ig,''):null;
} 
function valid2(f) {
!(/^[A-z]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z]/ig,''):null;
} 
</script>
    </body>
    <!-- end: BODY -->
</html>