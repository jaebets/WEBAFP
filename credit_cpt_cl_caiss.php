<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
//echo session_id()
include 'connections/AfriquepesageConnection.php';
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->

<?php
if (isset($_GET['cptcli'])) {
    $_SESSION['cptcl'] = $_GET['cptcli'];
}

$detcptcli = "SELECT [ID_COMPTE_CLIENT],[ID_CLIENT],[SOLDE_COMPTE_CLIENT],[NOM_RAISON_SOCIAL],[TELEPHONE],[EMAIL],[RESPONSABLE],[SOCIETE],[ACTIVITE],[FAX],[LOCALISATION],[PREFERENTIEL]"
        . " FROM [Afriquepesage].[dbo].[COMPTE_CLIENT]  WHERE [ID_COMPTE_CLIENT]= '" . $_SESSION['cptcl'] . "'";
$dtctcl = $conn->query($detcptcli);

/// récuperation de la devise parametrée pour les affichages sur les formulaires et reçus
$reqe = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
//  $reqe->execute();
$tr = $reqe->fetch();
$devise = $tr['devisePARAM'];

/*
  if(isset($_GET['cptcli'])){

  $sql = "UPDATE [Afriquepesage].[dbo].[COMPTE_CLIENT] SET [SOLDE_COMPTE_CLIENT] = ? where [ID_COMPTE_CLIENT]= ? ";
  $q = $conn->prepare($sql);
  $q->execute(array($_SESSION['cptcl'] ));
  }
 */
if (isset($_POST['enregistrer'])){
    
    $id_transaction = mt_rand(1000000000, 9999999999) .preg_replace('/\s+/', '',$_SESSION['userid']).preg_replace('/\s+/', '',$_SESSION['num_site']);
    $_SESSION['heure'] = date("H:i:s");
     $_SESSION['id_transaction']=$id_transaction;
    $sql = "UPDATE [Afriquepesage].[dbo].[COMPTE_CLIENT] SET [SOLDE_COMPTE_CLIENT] = ? where [ID_COMPTE_CLIENT]= ? ";
    $q = $conn->prepare($sql);
    $q->execute(array($_POST['new_solde'], $_SESSION['cptcl']));
    
    $req = "INSERT INTO [dbo].[TRANSACTION_COMPTE_CLIENT] ([ID_TRANSACTION],[ID_COMPTE],[ID_OPERATEUR],[NOM_SOCIETE],[MONTANT_CREDITE],[DATE_DEPOT],[HEURE_DEPOT])
		 VALUES (:ID_TRANSACTION,:ID_COMPTE,:ID_OPERATEUR,:NOM_SOCIETE,:MONTANT_CREDITE,:DATE_DEPOT,:HEURE_DEPOT)";
    $q = $conn->prepare($req);
    $q->execute(array(':ID_TRANSACTION' => $id_transaction,
        ':ID_COMPTE' => $_SESSION['cptcl'],
        ':ID_OPERATEUR' =>  $_SESSION['userid'],
        ':NOM_SOCIETE' => $_SESSION['NOM_SOCIETE'],
        ':MONTANT_CREDITE' => $_POST['credit'],
        ':DATE_DEPOT' => date("Ymd"),
        ':HEURE_DEPOT' => $_SESSION['heure']));   
    $_SESSION['credit']=$_POST['credit'];
   
    if ($q) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') . ": Compte Client Nº " . $_SESSION['cptcl'] . " Crédité de *" . $_POST['new_solde'] . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>alert('COMPTE CLIENT CREDITE'); window.location.href='credit_cptclient_validate.php';</script>";
    }
}
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
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
        <script type="text/JavaScript">
             function valid(f) {
           !(/^[0-9#209;#241;]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209;#241;]/ig,''):null;
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
                                <h1>
                                    Détails du compt <small>Clients</small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->

                            <form method="POST" action="">
                    <div id="imp" class="row " style="margin-top: 2.5%; border-bottom: 2px solid #8C001A;">
                        <div class="col-md-5">
                            <div class="panel-body" style="margin-top: 2%;">
                                <div class="form-group">  
                                    <table  width="100%" border="2" id="sample-table-1">


                                        <?php
                                        foreach ($dtctcl as $de) {
                                            ?>  
                                            <tr align="center">
                                                <td><label class="col-md-5  control-label" for="form-field-5">
                                                        COMPTE
                                                    </label>
                                                </td>
                                                <td><input id="idverba" input readonly="readonly" class="form-control" value="<?php
                                        if (!isset($de['ID_COMPTE_CLIENT'])) {
                                            
                                        } else {
                                            echo $de['ID_COMPTE_CLIENT'];
                                        }
                                            ?> "placeholder="">
                                                </td>
                                            </tr>
                                            <tr align="center">
                                                <td> <label class="col-md-5" for="form-field-5">    
                                                        SOCI&Eacute;T&Eacute; 
                                                    </label>
                                                </td>
                                                <td><input name="societe" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php $_SESSION['NOM_SOCIETE'] = $de['SOCIETE']; echo $de['SOCIETE']; ?>'></td>
                                            </tr>  
                                            <tr align="center">
                                                <td> <label class="col-md-5 control-label" for="form-field-5">
                                                        LOCALISATION
                                                    </label>
                                                </td>
                                                <td><input name="loca" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $de['LOCALISATION']; ?>'></td>
                                            </tr>  
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel-body" style="margin-top: 2%;">
                                    <div class="form-group">  
                                        <table width="100%" border="2" id="sample-table-1">
                                            <tr align="center">
                                                <td> <label class="col-md-5 control-label" for="form-field-5">
                                                        ACTIVITE
                                                    </label>
                                                </td>
                                                <td><input name="activ" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $de['ACTIVITE']; ?>'></td>
                                            </tr>                                                   
                                            <tr align="center">
                                                <td> <label class="col-md-5 control-label" for="form-field-5">
                                                        TELEPHONE
                                                    </label>
                                                </td>
                                                <td><input name="tel" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $de['TELEPHONE']; ?>'></td>
                                            </tr> 
                                            <tr align="center">
                                                <td> <label class="col-md-5 control-label" for="form-field-5">
                                                        EMAIL
                                                    </label>
                                                </td>
                                                <td><input name="email" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $de['EMAIL']; ?>'></td>
                                            </tr>                                                
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel-body" style="margin-top: 2%;">
                                    <div class="form-group">  
                                        <table width="100%" border="2" id="sample-table-1">                                                 
                                            <tr align="center">
                                                <td> <label class="col-md-5 control-label" for="form-field-5">
                                                        FAX
                                                    </label>
                                                </td>
                                                <td><input  name="fax" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $de['FAX']; ?>'></td>
                                            </tr>                                                 
                                            <tr align="center">
                                                <td> <label class="col-md-5 control-label" for="form-field-5">
                                                        RESPONSABLE
                                                    </label>
                                                </td>
                                                <td><input name="respons" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $de['RESPONSABLE']; ?>'></td>
                                            </tr> 
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel-body" style="margin-top: 3%;">
                                    <div class="form-group">  
                                        <table width="100%" border="2" id="sample-table-1">
                                        </table>
                                    </div>
                                </div>
                            </div> 
                                <div class="col-md-4">
                                    <div class="panel-body" style="margin-top: 5%;">
                                        <div class="form-group">  

                                            <table width="100%" border="2" id="sample-table-1">
                                                <tr align="center">
                                                    <td> <label class=" clip-banknote " for="form-field-5">
                                                            SOLDE ACTUEL
                                                        </label>
                                                    </td>
                                                    <td><input  name="solde" id="sld" placeholder="" readonly="readonly" class="form-control" value='<?php $_SESSION['solde_an'] = $de['SOLDE_COMPTE_CLIENT'];echo $de['SOLDE_COMPTE_CLIENT']; ?>'></td>
                                                </tr> 
                                            </table>
                                        </div>
                                    </div>
                                </div>   
                                <div class="col-md-4">
                                    <div class="panel-body" style="margin-top: 5%;">
                                        <div class="form-group">  
                                            <table width="100%" border="2" id="sample-table-1">
                                                <tr align="center">
                                                    <td> <label class=" clip-banknote " for="form-field-5">
                                                            CREDITER
                                                        </label>
                                                    </td>
                                                    <td><input  name="credit" id="crd" placeholder=""  onchange="restfunc('sld', 'tot', 'crd');" class="form-control" value="" onkeyup="valid(this)" onblur="valid(this)"></td>
                                                </tr> 
                                            </table>
                                        </div>
                                    </div>
                                </div>                                                 
                                <div class="col-md-4">
                                    <div class="panel-body" style="margin-top: 5%;">
                                        <div class="form-group">  
                                            <table width="100%" border="2" id="sample-table-1">
                                                <tr align="center">
                                                    <td> <label class=" clip-banknote " for="form-field-5">
                                                            NOUVEAU SOLDE 
                                                        </label>
                                                    </td>
                                                    <td><input  name="new_solde" id="tot" placeholder="" readonly="readonly" class="form-control" value=""></td>
                                                </tr> 
                                            </table>
                                        </div>
                                    </div>
                                </div> 
                            <?php
                        }
                        ?>

                    </div>
                    <button type="submit" class="btn btn-blue btn-lg" name="enregistrer"id="btnPrint">ENREGISTRER</button>   
                    <a class="btn btn-red btn-lg" href="saisie_cptclient.php">
                        ANNULER
                        <i class="fa fa-times fa fa-white"></i>
                    </a>
                    </form>
                </div>
            </div>
        </div>
        <!-- end: BOOTSTRAP EXTENDED MODALS FOR VERBALISATION-->
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
        <!-- end: PAGE -->
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
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
        <script src="assets/plugins/select2/select2.min.js"></script>
        <script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
        <script src="assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
        <script src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
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
        <script language="JavaScript" type="text/javascript">
            function restfunc(sld, tot, crd)
            {
                var lsld = document.getElementById(sld);
                var ltot = document.getElementById(tot);
                var lcrd = document.getElementById(crd);
                var valeurlsld = lsld.value;
                var valeurlcrd = lcrd.value;
                ltot.value = (valeurlsld) - (-valeurlcrd);
            }
        </script>
    </body>
    <!-- end: BODY -->
</html>