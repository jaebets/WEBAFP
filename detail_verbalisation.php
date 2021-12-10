<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */

session_start();
include 'connections/AfriquepesageConnection.php';
if (isset($_GET['nfv'])) {
    $_SESSION['idverba'] = $_GET['nfv'];
}
$info = "SELECT [ID_VERB],[ID_USER],[NUMERO_PESE],[DATE_VERB],[NATIONALITE],[TRANSIT],[PDPUIT_DANGE],[INF_GABARIT],[LOGIN_OP],[AMENDE_TOTAL],[EXPORTATEUR],[IMMAT_VEHICULE],[PRODUIT_TRANSPORTE],[PROV_DEST],[NOM_STE],[POIDS_TOTAL],[CLASSE_VEHICULE],[PAIMENT_VERBA],[MONTANT_AMENDE_PAYE],[MONTANT_RESTANT],[NOM_CLIENT],[COMPTE_CLIENT] "
        . "FROM [Afriquepesage].[dbo].[VERBALISATION] WHERE [ID_VERB] = '" . $_SESSION['idverba'] . "'";
$inform = $conn->query($info);
$retrieve = $inform->fetch();

$_SESSION['NOM_CLIENT'] = $retrieve['NOM_CLIENT'];
$_SESSION['EXPORTATEUR'] = $retrieve['EXPORTATEUR'];
$_SESSION['NUMERO_PESE'] = $retrieve['NUMERO_PESE'];
$_SESSION['DATE_VERB'] = $retrieve['DATE_VERB'];
$_SESSION['COMPTE_CLIENT'] = $retrieve['COMPTE_CLIENT'];
$_SESSION['PROV_DEST'] = $retrieve['PROV_DEST'];
$_SESSION['IMMAT_VEHIC'] = $retrieve['IMMAT_VEHICULE'];
$_SESSION['PRODUIT_TRANSPORTE'] = $retrieve['PRODUIT_TRANSPORTE'];
$_SESSION['NATIONALITE'] = $retrieve['NATIONALITE'];
$_SESSION['AMENDE_TOTAL'] = $retrieve['AMENDE_TOTAL'];
$_SESSION['TRANSIT'] = $retrieve['TRANSIT'];
//   
//if (isset($_POST['ENREGISTRER'])) {
$info = $conn->query("SELECT max([ID_RECU]) as 'ID_RECU' FROM [dbo].[RECU]");
$info->execute();
$ret = $info->fetch();
$id_rec = $ret['ID_RECU'] + 1;
$_SESSION['lerecu'] = $id_rec;

/// récuperation de la devise parametrée pour les affichages sur les formulaires et reçus
$reqe = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
$tr = $reqe->fetch();
$devise = $tr['devisePARAM'];

$_SESSION['devisePARAM'] = $devise;
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
        <!-- --><style>

            html,body {
                margin: 0;
                padding: 0;
                /*  overflow: hidden;*/
            }
            label,h6  {
                color:  #8C001A;
                font-weight: bold;
                /* border-style: solid;*/
                /*border-bottom: thick solid #861D20;*/
            }
            .third label {
                color:  #0000A0;
                font-weight: bold;
                /* border-style: solid;*/
                /*border-bottom: thick solid #861D20;*/
            }
            .second label {
                color:  #FF0000;
                font-weight: bold;
                /* border-style: solid;*/
                /*border-bottom: thick solid #861D20;*/
            }
            .page-header {
                padding-bottom: 1px;
                margin: 1px 0;
            }
            .panel-body {
                padding: 2px;
            }
            section {
                margin: 0;
                padding: 0;
                padding-left: 4%;
                padding-right: 1%;
                width: 80%;
                /*height: 300px;*/
            }
            div#two {
                width: 100%;
                /*height: 300px;*/
                /*float: left;*/
            }
            .dyp{
                text-align: center !important;
            }
            @media screen {
                #printSection {
                    display: none;
                }
            }
            @media print {
                a[href]:after {
                    content: none !important;
                }
                a[href]:before {
                    content: none !important;
                }
                body * {
                    visibility:hidden;
                }
                #printSection, #printSection * {
                    visibility:visible;
                }
                #printSection {
                    position:absolute;
                    left:0;
                    top:0;
                }
            }
        </style><!---->
<!--        <script language="JavaScript" type="text/javascript">
            function change(code, ch)
            {
            var champ = document.getElementById(ch);
            var valeur=champ.value;
            var etat = champ.readonly;
            var check=document.getElementById(code);
            var isCh= check.value;
            if (isCh != - 1)
            {
            champ.readonly =!champ.readonly;
            return false;
            } else
            {
            champ.readonly =champ.readonly;
            return true;
            }
            }
        </script>-->
        <script type="text/JavaScript" language="JavaScript">

            function valid(f) {
            !(/^[0-9#209;#241;]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209;#241;]/ig,''):null;
            }
            function valid2(f) {
            !(/^[A-z]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z]/ig,''):null;
            } 
        </script>-
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="page-full-width">              
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
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                            ?></a></li>
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
                                    Tableau de Bord <small>Caissi&egrave;re </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <div class="row " style="margin-top: 2.5%; border-bottom: 2px solid #8C001A;">
                        <form name="fiche_verb" method="POST" action="recu_caisse.php"> 
                            <div class="col-sm-3" >
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table width="100%" border="0">  
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        Nº VERB
                                                    </label>
                                                </td>
                                                <td><input id="idverba" input readonly="readonly" class="form-control" value="<?php
                                            if (!isset($_GET['nfv'])) {
                                                
                                            } else {
                                                echo $_GET['nfv'];
                                            }
?>"type="text" placeholder="">
                                                </td>
                                            </tr>

<?php
//     foreach ($retrieve as $re) {
?>
                                            <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">    
                                                        NUMERO_PESE
                                                    </label>
                                                </td>
                                                <td><input type="text" name="NUMERO_PESE" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value=<?php echo $retrieve['NUMERO_PESE']; ?>></td>
                                            </tr>  
                                            <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">
                                                        DATE_PESEE
                                                    </label>
                                                </td>
                                                <td><input type="text" name="DATE_VERB" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value=<?php echo $retrieve['DATE_VERB']; ?>></td>
                                            </tr>  
                                            <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">
                                                        OP&Eacute;RATEUR
                                                    </label>
                                                </td>
                                                <td><input type="text" name="LOGIN_OP" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value=<?php echo $retrieve['LOGIN_OP']; ?>></td>
                                            </tr> <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">
                                                        EXPORTATEUR
                                                    </label>
                                                </td>
                                                <td><input type="text" name="LOGIN_OP" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $retrieve['NOM_CLIENT']; ?>'></td>
                                            </tr> 
<?php
//       }
?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table width="100%" border="0">
                                            <tr align="center">
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        CLIENT
                                                    </label>
                                                </td>
                                                <td><input type="text" name="NOM_SCTE" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $retrieve['COMPTE_CLIENT']; ?>'></td>   
                                     <!--           <td><input type="text" name="NOM_SCTE" id="form-field-1"  required placeholder="" class="form-control" value=''></td>     --->
                                            </tr>
                                            <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">
                                                        IMMATRICULATION
                                                    </label>
                                                </td>
                                                <td><input type='text' name="IMMAT_VEHICULE" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $retrieve['IMMAT_VEHICULE']; ?>'></td>
                                            </tr>
                                            <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">
                                                        PROV/DEST
                                                    </label>
                                                </td>
                                                <td><input type="text" name="PROV_DEST" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $retrieve['PROV_DEST']; ?>'></td>
                                            </tr>  
                                            <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">
                                                        PRODUIT
                                                    </label>
                                                </td>
                                                <td><input type="text" name="PRODUIT_TRANSPORTE" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $retrieve['PRODUIT_TRANSPORTE']; ?>'></td>
                                            </tr> 
                                            <tr align="center">
                                                <td> <label class="col-sm-10 control-label" for="form-field-5">
                                                        NATIONALIT&Eacute;
                                                    </label>
                                                </td>
                                                <td><input type="text" name="NATIONALITE" id="form-field-1" placeholder="" readonly="readonly" class="form-control" value='<?php echo $retrieve['NATIONALITE']; ?>'></td>
                                            </tr>  
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <p>
                                <h4>Infraction(s)</h4>                            
                                </p>
<?php
$info = $conn->query("select [LIBELLE_TYPE_INF],[MONTANT_AMENDE]
                                                                from [dbo].[VERBALISATION_INFRACTION] 
                                                                where [ID_VERB] = '" . $_SESSION['idverba'] . "'");
$info->execute();
$retieve = $info->fetchAll();
?>
                                <!--      <form name="fiche_verbalisation.php" method="POST">  --->
                                <table class="table table-hover table-bordered" width="100%" border="0" id="sample-table-1">
                                    <tbody>
                                        <tr>
                                            <th>Type Infraction</th>
                                            <th>Amende(s)</th>
                                        </tr>
<?php
foreach ($retieve as $se) {
    ?>
                                            <tr>
                                                <td><?php echo $se['LIBELLE_TYPE_INF']; ?></td>
                                                <td><?php echo number_format($se['MONTANT_AMENDE'], 0, '', '.') . " " . $devise; ?></td>
                                            </tr>
    <?php
}
?>
                                    </tbody>
                                </table>
                                <!--    </form>  -->
                            </div>

                            <div class="col-md-4">
                                <div class="panel-body" style="margin-top: 5%;">
                                    <div class="form-group">
                                        <table width="100%" border="0">
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        TOTAL &Agrave; PAYER:
                                                    </label></td>
                                                <td>
                                                    <input type="text" name="AMENDE_TOTAL" id="mt" placeholder="" readonly="readonly" class="form-control" value="<?php echo $retrieve['AMENDE_TOTAL']; ?>"/>
                                                </td>
                                            </tr>
                             <!--               <tr class='clickable-row' data-href='detail_verbalisation.php? nfv=<?php //echo $re['ID_VERB'];  ?>' style="cursor: pointer;">      -->
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        MONTANT VERS&Eacute;:
                                                    </label></td>
                                                <td>
                                                    <input type="text" name="MONTANT_A_PAYE" id="mp" onchange="restfunc('mt', 'mp', 'mr', 'apt');" required placeholder="" class="form-control" onkeyup="valid(this)" onblur="valid(this)" value="<?php echo $retrieve['AMENDE_TOTAL']; ?>" <?php echo $_SESSION['lien'];?> />                                                       
                                                </td>
                                            </tr>                                                
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        RESTE &Agrave; PAYER:
                                                    </label></td>

                                                <td>
                                                    <input style="width: 100%" type="text" name="MONTANT_RESTANT"  id="mr" placeholder="" readonly="True" class="form-control" value="0"/>
                                                </td>
                                            </tr>
<?php
/// gestion du compte du compte dont client  

$bills = $_SESSION['AMENDE_TOTAL'];

$resolde = $conn->query("SELECT [ID_COMPTE_CLIENT],[SOLDE_COMPTE_CLIENT],[SOCIETE] FROM [Afriquepesage].[dbo].[COMPTE_CLIENT] WHERE [SOCIETE]= '" . $retrieve['COMPTE_CLIENT'] . "'");
$trslde = $resolde->fetch();

$exportateur = $conn->prepare("SELECT * FROM [Afriquepesage].[dbo].[COMPTE_CLIENT] WHERE [SOCIETE]= '" . $retrieve['COMPTE_CLIENT'] . "' AND [SOLDE_COMPTE_CLIENT] > '" . $bills . "'");
$exportateur->execute();
$exportateur_result = $exportateur->fetchAll();
?>
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td colspan="1">
                                                        <div align="left">
                                                            <label class="checkbox-inline" for="form-field-5">
                                                                <input type="checkbox" name="typepaie" class="flat-red" checked="true" id="ch" onClick="changes('cpt', 'ch');"/>
                                                                <td>
                                                                    <label class="control-label" for="form-field-5" id="espece" style="width: 50%;">
                                                                        Type Paiement(Espèce/Compte)
                                                                    </label>
                                                                </td>                                                             
                                                                <td>
    <!--                                                               <input style="width: 100%" type="text" name="MODE_REGLEMENT" class="flat-red" id="cpt" readonly="true" value="ESPECE"/>        -->                                                           
                                                                    <input type="text" list="categoryname" autocomplete="off" id="cpt" name="MODE_REGLEMENT" readonly="true" class="form-control" placeholder="ESPECE" required>
                                                                    <datalist id="categoryname">
                                                                        <option value="<?php echo rtrim($trslde['ID_COMPTE_CLIENT']); ?>"><?php echo "Nº " . rtrim($trslde['ID_COMPTE_CLIENT']) . "=>" . number_format(rtrim($trslde['SOLDE_COMPTE_CLIENT']), 0, '', '.') . " " . $devise; ?></option>                                                                                                                                                                                                   
                                                                    </datalist>
                                                                </td>
                                                            </label>                                                                                                                  
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="col-md-4"></div>
                                            <!--         <form action = "debit_cptclient.php" method="post">
                                                         <button class="btn btn-grey btn-lg" data-href='debit_cptclient.php? md_rgl=<?php // echo $_POST['MODE_REGLEMENT'];  ?>'>   -->
                                            <!--                                                      <button class="btn btn-grey btn-lg" type="submit" name="DEBITCPT" >
                                                                                                       Débiter
                                                                                                  </button>-->                                                   
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-green btn-lg" value="ENREGISTRER" name="enregistrer"/>
                            <a class="btn btn-red btn-lg" href="fiche_verbalisation.php">
                                ANNULER
                                <i class="fa fa-times fa fa-white"></i>
                            </a>
                        </form>
                    </div>
  <!--             <a class="btn btn-green btn-lg" href="#receipt?MONTANT_A_PAYE=<script>document.forms['idformul'].elements['MONTANT_A_PAYE'].value;</script>" data-toggle = "modal"> <!--onClick="window.print()"--> 
                    <!--                        <a class="btn btn-green btn-lg"  href="#receipt" data-toggle = "modal"> 
                                                ENREGISTRER
                                              <i class="fa fa-check fa-white"></i>
                                           </a>
                                            <a class="btn btn-red btn-lg" href="fiche_verbalisation.php">
                                                ANNULER
                                                <i class="fa fa-times fa fa-white"></i>
                                            </a>-->
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
    <!-- script pour la checkbox =========================== -->
    <script language="JavaScript" type="text/javascript">
                                                                    function changes(code, ch)
                                                                    {
                                                                        var champ = document.getElementById(code);
                                                                        var check = document.getElementById(ch);
                                                                        if (check.checked == true)
                                                                        {
                                                                            champ.readOnly = true;
                                                                            champ.value = "ESPECE";
                                                                        }
                                                                        if (check.checked == "")
                                                                        {
                                                                            champ.value = "ESPECE";
                                                                        }
                                                                        if (check.checked == false)
                                                                        {
                                                                            alert("Entré le numéro de COMPTE du client dans le champ de saisi s'il vous plait");
                                                                            champ.value = "";
                                                                            champ.readOnly = false;
                                                                        }

                                                                    }
    </script>
    <script language="JavaScript" type="text/javascript">
        function restfunc(mt, mp, mr, apt)
        {
            var lemt = document.getElementById(mt);
            var lemp = document.getElementById(mp);
            var lemr = document.getElementById(mr);
            var lapt = document.getElementById(apt);
            var valeurlemt = lemt.value;
            var valeurlemp = lemp.value;
            lemr.value = valeurlemt - valeurlemp;
            lapt.value = valeurlemt - valeurlemp;
        }
    </script>

</body>
<!-- end: BODY -->
</html>
