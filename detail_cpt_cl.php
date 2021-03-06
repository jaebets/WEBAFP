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
if (isset($_GET['cptcl'])) {
    $_SESSION['cptcl'] = $_GET['cptcl'];
}
if (isset($_POST['research'])) {
    if (isset($_POST['dates2']) && isset($_POST['dates3'])) {
        $date_entry2 = $_POST['dates2'];
        $date_entry3 = $_POST['dates3'];
        $detcptcli = "SELECT [ID_COMPTE_CLIENT],[ID_CLIENT],[SOLDE_COMPTE_CLIENT],[NOM_RAISON_SOCIAL],[TELEPHONE],[EMAIL],[RESPONSABLE],[SOCIETE],[ACTIVITE],[FAX],[LOCALISATION],[PREFERENTIEL]"
                . " FROM [Afriquepesage].[dbo].[COMPTE_CLIENT]  WHERE [ID_COMPTE_CLIENT]= '" . $_SESSION['cptcl'] . "'";
        $dtctcl = $conn->query($detcptcli);

        $dettable = "SELECT p.[ID_PAIEMENT] ,p.[ID_CLIENT],p.[ID_USER],p.[ID_VERB],p.[MONTANT_PAIEMENT],p.[MODE_REGLEMENT],p.[DATE_PAIEMENT],p.[OBSERVATION_PAIEMENT],p.[DATE_VERBL],p.[NUM_PSEE],p.[LOGIN_UT],p.[ID_CAISSE],p.[ID_SESSION],v.[IMMAT_VEHICULE],v.[ID_VERB],v.PRODUIT_TRANSPORTE,v.PROV_DEST
               FROM [Afriquepesage].[dbo].[PAIEMENT] p, [Afriquepesage].[dbo].[COMPTE_CLIENT] c, [dbo].[VERBALISATION] v WHERE c.[ID_COMPTE_CLIENT]=  p.[MODE_REGLEMENT] AND v.[ID_VERB]=p.[ID_VERB] and p.[MODE_REGLEMENT] = '" . $_SESSION['cptcl'] . "' and p.[DATE_VERBL] between '$date_entry2' and '$date_entry3'";
        $dettable = $conn->query($dettable);

        $sumpaie = "SELECT sum (p.[MONTANT_PAIEMENT]) as TOTPAIE FROM [Afriquepesage].[dbo].[PAIEMENT] p, [Afriquepesage].[dbo].[COMPTE_CLIENT] c WHERE c.[ID_COMPTE_CLIENT]=  p.[MODE_REGLEMENT] and [MODE_REGLEMENT]='" . $_SESSION['cptcl'] . "' and p.[DATE_VERBL] between '$date_entry2' and '$date_entry3'";
        $sumpaiem = $conn->query($sumpaie);

        /// r??cuperation de la devise parametr??e pour les affichages sur les formulaires et re??us
        $reqe = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
        //  $reqe->execute();
        $tr = $reqe->fetch();
        $devise = $tr['devisePARAM'];
    }
} else {
    $detcptcli = "SELECT [ID_COMPTE_CLIENT],[ID_CLIENT],[SOLDE_COMPTE_CLIENT],[NOM_RAISON_SOCIAL],[TELEPHONE],[EMAIL],[RESPONSABLE],[SOCIETE],[ACTIVITE],[FAX],[LOCALISATION],[PREFERENTIEL]"
            . " FROM [Afriquepesage].[dbo].[COMPTE_CLIENT]  WHERE [ID_COMPTE_CLIENT]= '" . $_SESSION['cptcl'] . "'";
    $dtctcl = $conn->query($detcptcli);

    $dettable = "SELECT p.[ID_PAIEMENT] ,p.[ID_CLIENT],p.[ID_USER],p.[ID_VERB],p.[MONTANT_PAIEMENT],p.[MODE_REGLEMENT],p.[DATE_PAIEMENT],p.[OBSERVATION_PAIEMENT],p.[DATE_VERBL],p.[NUM_PSEE],p.[LOGIN_UT],p.[ID_CAISSE],p.[ID_SESSION],v.[IMMAT_VEHICULE],v.[ID_VERB],v.PRODUIT_TRANSPORTE,v.PROV_DEST
               FROM [Afriquepesage].[dbo].[PAIEMENT] p, [Afriquepesage].[dbo].[COMPTE_CLIENT] c, [dbo].[VERBALISATION] v WHERE c.[ID_COMPTE_CLIENT]=  p.[MODE_REGLEMENT] AND v.[ID_VERB]=p.[ID_VERB] and p.[MODE_REGLEMENT] = '" . $_SESSION['cptcl'] . "'";
    $dettable = $conn->query($dettable);

    $sumpaie = "SELECT sum (p.[MONTANT_PAIEMENT]) as TOTPAIE FROM [Afriquepesage].[dbo].[PAIEMENT] p, [Afriquepesage].[dbo].[COMPTE_CLIENT] c WHERE c.[ID_COMPTE_CLIENT]=  p.[MODE_REGLEMENT] and [MODE_REGLEMENT]='" . $_SESSION['cptcl'] . "'";
    $sumpaiem = $conn->query($sumpaie);

/// r??cuperation de la devise parametr??e pour les affichages sur les formulaires et re??us
    $reqe = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
//  $reqe->execute();
    $tr = $reqe->fetch();
    $devise = $tr['devisePARAM'];
}
//date desc
$dte1 = $conn->prepare("SELECT  distinct [DATE_VERBL]   FROM [Afriquepesage].[dbo].[PAIEMENT] where [MODE_REGLEMENT]='" . $_SESSION['cptcl'] . "' order by DATE_VERBL desc");
$dte1->execute();
$dte_result1 = $dte1->fetchAll();

//date asc
$dte2 = $conn->prepare("SELECT  distinct [DATE_VERBL]   FROM [Afriquepesage].[dbo].[PAIEMENT] where [MODE_REGLEMENT]='" . $_SESSION['cptcl'] . "' order by DATE_VERBL asc");
$dte2->execute();
$dte_result2 = $dte2->fetchAll();
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
                                    D??tails du compt <small>Clients</small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
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
                                                <td><input name="societe" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $de['SOCIETE']; ?>'></td>
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
                            <?php
                        }
                        ?>
                        <table width="100%" border="0">
                            <tr>
                            <form method="post" action="detail_cpt_cl.php">
                                <td>
                                    <div align="center">
                                        <h5><label style="color:#8C001A;font-weight:bold;">RECHERCHE PAR P&Eacute;RIODE:</label></h5>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="dates2" class="form-control" placeholder="jj/mm/AAAA">
                                    <datalist id="categoryname">
                                        <?php foreach ($dte_result1 as $key) { ?>
                                            <option value="<?php echo $key['DATE_VERBL']; ?>"><?php echo date_format(date_create($key['DATE_VERBL']), 'd/m/Y'); ?></option>
                                        <?php } ?>
                                    </datalist>
                                </td>

                                <td>&nbsp;</td>
                                <td>
                                    <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="dates3" class="form-control" placeholder="jj/mm/AAAA">
                                    <datalist id="categoryname">
                                        <?php foreach ($dte_result2 as $key) { ?>
                                            <option value="<?php echo $key['DATE_VERBL']; ?>"><?php echo date_format(date_create($key['DATE_VERBL']), 'd/m/Y'); ?></option>
                                        <?php } ?>
                                    </datalist>
                                </td>

                                <td>&nbsp;</td>
                                <td>
                                    <div align="center">
                                        <button type = "submit" class = "btn btn-blue" name="research">
                                            RECHERCHE
                                        </button>
                                    </div>
                                </td>
                            </form>
                            </tr>
                        </table>
                        <?php
                        if (isset($_POST['dates2']) && isset($_POST['dates3'])) {
                            ?>
                            <table width="100%" border="0">
                                <tr>
                                    <td>
                                        <div align="center">
                                            <h4><label style="color:#8C001A;font-weight:bold;">ETAT <?php echo $de['SOCIETE']; ?> DU <?php echo date_format(date_create($_POST['dates2']), 'd/m/Y'); ?> AU <?php echo date_format(date_create($_POST['dates3']), 'd/m/Y'); ?></label></h4>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <?php
                        } else {
                            ?>
                            <table width="100%" border="0">
                                <tr>
                                    <td>
                                        <div align="center">
                                            <h4><label style="color:#8C001A;font-weight:bold;">ETAT <?php echo $de['SOCIETE']; ?></label></h4>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <?php
                        }
                        ?>
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                            <thead>
                                <tr > 
                                    <th style="text-align: center">N?? PAIEMENT</th>
                                 <!--   <th style="text-align: center">ID_USER</th>    -->                                                
                                    <th style="text-align: center">N?? PESEE</th>
                                    <th style="text-align: center">N?? VERBALISATION</th>
                                    <th style="text-align: center">IMMATRICULATION</th>
                                    <th style="text-align: center">DATE VERBALISATION</th>
                                    <th style="text-align: center">MONTANT</th>
                                    <th style="text-align: center">DATE PAIEMENT</th>
                                    <th style="text-align: center">PROV/DEST</th>
                                    <th style="text-align: center">PRODUIT TRANSPORTE</th>
                                  <!--  <th style="text-align: center">SESSION</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dettable as $te) {
                                    ?>
                                    <tr>  
                                        <td><?php echo $te['ID_PAIEMENT']; ?></td>
                                     <!--   <td><?php //echo $te['ID_USER'];    ?></td> -->
                                        <td><?php echo $te['NUM_PSEE']; ?></td>
                                        <td><?php echo $te['ID_VERB']; ?></td>
                                        <td><?php echo $te['IMMAT_VEHICULE']; ?></td>
                                        <td><?php echo date_format(date_create($te['DATE_VERBL']), 'd/m/Y'); ?></td>
                                        <td><?php echo $te['MONTANT_PAIEMENT']; ?></td>
                                        <td><?php echo date_format(date_create($te['DATE_PAIEMENT']), 'd/m/Y'); ?></td>
                                        <td><?php echo $te['PROV_DEST']; ?></td>
                                        <td><?php echo $te['PRODUIT_TRANSPORTE']; ?></td>
                                        <!--<td><?php //echo $te['ID_SESSION'];    ?></td> -->
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="col-md-4">
                            <div class="panel-body" style="margin-top: 3%;">
                                <div class="form-group">  
                                    <table width="100%" border="2" id="sample-table-1">
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="panel-body" style="margin-top: 5%;">
                                <div class="form-group">  
                                    <table width="100%" border="2" id="sample-table-1">
                                        <?php
                                        foreach ($sumpaiem as $pe) {
                                            ?> 
                                        <tr align="center" style="width:2%">
                                                <?php
                                                if (isset($_POST['dates2']) && isset($_POST['dates3'])) {
                                                    ?>
                                                    <td> <label class=" clip-banknote " for="form-field-3">
                                                            TOTAL ENCAISSEMENTS DU <?php echo date_format(date_create($_POST['dates2']), 'd/m/Y'); ?> AU <?php echo date_format(date_create($_POST['dates3']), 'd/m/Y'); ?></label>
                                                    </td>
                                                    <td ><input name="totmouv" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo number_format($pe['TOTPAIE'], 0, '', '.') . " " . $devise; ?>'></td>                              

                                                    <?php
                                                } else {
                                                    ?>
                                                    <td> <label class=" clip-banknote " for="form-field-3">
                                                            TOTAL ENCAISSEMENTS </label>
                                                    </td>
                                                    <td ><input name="totmouv" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo number_format($pe['TOTPAIE'], 0, '', '.') . " " . $devise; ?>'></td>                              
                                                </tr> 
                                                <?php
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="panel-body" style="margin-top: 5%;">
                                <div class="form-group">  
                                    <table width="100%" border="2" id="sample-table-1">
                                        <tr align="center">
                                            <td> <label class=" clip-banknote " for="form-field-5">
                                                    SOLDE ACTUEL
                                                </label>
                                            </td>
                                            <td><input  name="solde" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo number_format($de['SOLDE_COMPTE_CLIENT'], 0, '', '.') . " " . $devise; ?>'></td>
                                        </tr> 
                                    </table>
                                </div>
                            </div>
                        </div>
  <!--                 <input type="submit" class="btn btn-green btn-lg" value="IMPRIMER"/>    
                    </form>-->
                    </div>
                    <button onclick="printContent('imp')" class="btn btn-blue btn-lg" id="btnPrint">IMPRIMER</button>   
                    <a class="btn btn-red btn-lg" href="saisie_cptclient.php">
                        RETOUR
                        <i class="fa fa-times fa fa-white"></i>
                    </a>
                </div>
            </div>
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
    </body>
    <!-- end: BODY -->
</html>