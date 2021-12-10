<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */

session_start();
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
include 'penalite_config.php';

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

//GET DEVISE
$dev = $conn->query("SELECT [devisePARAM]  FROM [Afriquepesage].[dbo].[ADMIN_PARAM]");
$dev->execute();
$devs = $dev->fetch();
$devise = $devs['devisePARAM'];

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
                /*overflow: hidden;*/
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
                padding-left: 6%;
                padding-right: 2%;
                width: 70%;
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
            #overlay{
                width:100%;
                position: absolute;
                left: 0;
                top: 0;
                z-index: 999
            }
            .mod  {
                color:  #8C001A;
                font-weight: bold;
                /* border-style: solid;*/
                /*border-bottom: thick solid #861D20;*/
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
                            <div class="col-sm-3" >
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table width="100%" border="0">
                                            <tr>
                                                <td id="silhouette">
                                                    <img src="<?php echo $status['SILHOUETTE_VEHICULE']; ?>"/>
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
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        Nº PESEE
                                                    </label></td>
                                                <td>
                                                    <input id="form-field-1" class="form-control" value="<?php echo $status['NUMERO_PESE']; ?>" type="text" placeholder="" readonly >
                                                </td>
                                            </tr>
                                             <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        DATE VERB
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['DATE_VERB']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        OP&Eacute;RATEUR
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['LOGIN_OP']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table width="100%" border="0">
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        NOM CLIENT
                                                    </label></td>
                                                <td id="type">
                                                    <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo $status['COMPTE_CLIENT']; ?>" type="text" placeholder="" readonly >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        EXPORTATEUR
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $status['EXPORTATEUR']; ?>" type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        IMMATRICULATION
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['IMMAT_VEHICULE']; ?>" type="text" placeholder="" readonly ></td>
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
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        PROV/DEST
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['PROV_DEST']; ?>"  type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-10 control-label" for="form-field-5">
                                                        TRANSPORT
                                                    </label></td>
                                                <td>                                                        
                                                    <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php if(preg_replace('/\s+/', '', $status['TRANSIT']) !="PREFERENTIEL") {echo preg_replace('/\s+/', '', $status['TRANSIT']);}else{echo "INTERNATIONAL";} ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table width="100%" border="0">
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        PRODUIT
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['PRODUIT_TRANSPORTE']; ?>"  type="text" placeholder="" readonly ></td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        POIDS TOTAL
                                                    </label></td>
                                                <td>                                                        
                                                    <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php echo $status['POIDS_TOTAL']; ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        SURCHARGE SUR
                                                    </label></td>
                                                <td>                                                        
                                                    <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $status['OVERLOAD_NAME']; ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        PESEE FACTUREE SUR
                                                    </label></td>
                                                <td>                                                        
                                                    <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $status['OVERLOAD_MASS']; ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        MONTANT FACTURE
                                                    </label></td>
                                                <td>                                                        
                                                    <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $status['OVERLOAD_FINE']; ?>" placeholder=""  readonly />
                                                </td>
                                            </tr>
                                             <tr>
                                                <td><label class="col-sm-12 control-label" for="form-field-5">
                                                        SITE
                                                    </label></td>
                                                <td><input id="form-field-1" class="form-control" value="<?php echo $status['NOM_STE']; ?>"  type="text" placeholder="" readonly ></td>
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
                                                           <!-- <h6>AUCUNE INFRACTION </h6>-->
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
                        <div class="row" style="margin-top:10%;">
                        <div class="col-md-6">
                            <a class="btn btn-blue btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                IMPRIMER
                                <i class="fa fa-check fa-print"></i>
                            </a>
                            <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                ACCUEIL
                                <i class="clip-home"></i>
                            </a>
                        </div>
                        <div class="col-md-6">
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
            </form>
            <!-- end: PAGE -->
            <!-- start: BOOTSTRAP EXTENDED MODALS -->
            <div id="receipt" class="modal fade" tabindex="-1" data-width="700">
                <form method="post" action="">
                    <div class="modal-body" id ="printThis">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <div class="row" >
                            <section   style="width:100%; margin:0 auto;font-size: 11.336px; background-image:url(assets/images/duplicata.png); background-repeat:no-repeat;">
                                <img src="assets/images/modalhead.png" id="overlay">
                                <div id="two">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td colspan="5">
                                                <div align="center">
                                                    R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUTURES ECONOMIQUES
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <div align="center">
                                                    FONDS D'ENTRETIEN ROUTIER
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <div align="center">
                                                    STATION DE PESAGE FIXE <?php echo substr($status['NOM_STE'],7); ?>
                                                </div>
                                            </td>
                                        </tr>
                                         <tr>
                                        <td>
                                            <div align="left" >
                                                <b>
                                                    Nº VERBALISATION : 
                                                </b>
                                                    <?php echo $status['ID_VERB']; ?>
                                                 <br><br>
                                                <b>
                                                    Nº PES&Eacute;E : 
                                                </b>
                                                        <?php echo $status['NUM_PESEE_WIM']; ?> 
                                                 <br><br>
                                                <b>
                                                    SOCI&Eacute;T&Eacute;/PROP :
                                                </b>
                                                <?php echo $status['NOM_CLIENT']; ?>
                                                <br><br>
                                                <b>
                                                    IMMATRICULATION : 
                                                 </b>
                                                 <?php
                                                $status['IMMAT_VEHICULE']
                                                ?>
                                                <br><br>
                                                <b>
                                                    PRODUIT :   
                                                </b>
                                                <?php echo $status['PRODUIT_TRANSPORTE']; ?>
                                                
                                               
                                            </div>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <div align="left" >
                                                <b>DATE DE VERBALISATION:</b> <?php echo $status['DATE_VERB']; ?> 
                                                <br><br>
                                                <b>
                                                    PROV/DEST:</b> <?php echo $status['PROV_DEST']; ?>
                                                <br><br>
                                                <b>EXPORTATEUR:</b> <?php echo $status['EXPORTATEUR']; ?><br><br>
                                                 <b>
                                                    NATIONALIT&Eacute; :
                                                 </b>
                                                     <?php echo $status['NATIONALITE']; ?>
                                                
                                                <br><br>
                                                 <b>
                                                    TRANSPORT : 
                                                </b>
                                                <?php if(preg_replace('/\s+/', '', $status['TRANSIT']) !="PREFERENTIEL") {echo preg_replace('/\s+/', '', $status['TRANSIT']);}else{echo "INTERNATIONAL";} ?>
                                                
                                            </div>
                                        </td>
                                        <td>
                                            &nbsp;</td>
                                        <td>
                                            <div align="center">
                                               <div align="center">
                                                    <?php
                                                    $_SESSION['duplicata_immatriculation'] = $status['IMMAT_VEHICULE'];
                                                    $_SESSION['duplicata_num_verb'] = $status['ID_VERB'];
                                                    $_SESSION['duplicata_montant_a_paye'] = $status['AMENDE_TOTAL'];
                                                    $_SESSION['duplicata_nom_client'] = $status['NOM_CLIENT'];
                                                    $_SESSION['duplicata_produit_transporte'] = $status['PRODUIT_TRANSPORTE'];
                                                    $_SESSION['duplicata_exportateur'] = $status['EXPORTATEUR'];
                                                    $_SESSION['duplicata_transport'] = $status['TRANSIT'];
                                                    echo '<img src="qr_duplicata.php" style="width:100px;"/>';
                                                    ?>
                                                </div>
                                                <br>
												<div align="center" id="modal-silhouette">
                                                    <img src="<?php echo $status['SILHOUETTE_VEHICULE']; ?>"/>
													<br>
                                                    <?php echo $status['CLASSE_VEHICULE']; ?>
                                                </div>
											
                                            </div>
                                        </td>
                                    </tr>
                                    </table>
                                    <?php
                                    if (preg_replace('/\s+/', '', $status['SEUIL_EXTREME_SURCHARGE']) != 'NONE') {
                                        ?>
                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                            <tr>
                                                <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                <th scope="col">POIDS (KG)</th>
                                                <th scope="col">POIDS MAX (KG)</th>
                                                <th scope="col">SURCHARGE (KG)</th>
                                                <th scope="col">EXTREME SURCHARGE (KG)</th>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left"><?php echo $status['CLASSE_VEHICULE']; ?></td>
                                                <td style="text-align:center"><?php echo $status['POIDS_TOTAL']; ?></td>
                                                <td style="text-align:center"><?php echo $status['POIDS_MAX_VEHICULE']; ?></td>
                                                <td style="text-align:center">
                                                    <?php
                                                    echo $status['SURCHARGE'];
                                                    ?>
                                                </td>
                                                <td style="text-align:center">
    <?php echo $status['EXTREME_SURCHARGE']; ?>
                                                </td>
                                            </tr>
                                        </table>
<?php } else { ?>
                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                            <tr>
                                                <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                <th scope="col">POIDS (KG)</th>
                                                <th scope="col">POIDS MAX (KG)</th>
                                                <th scope="col">SURCHARGE (KG)</th>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left"><?php echo $status['CLASSE_VEHICULE']; ?></td>
                                                <td style="text-align:center"><?php echo $status['POIDS_TOTAL']; ?></td>
                                                <td style="text-align:center"><?php echo $status['POIDS_MAX_VEHICULE']; ?></td>
                                                <td style="text-align:center">
                                                    <?php
                                                    echo $status['SURCHARGE'];
                                                    ?>
                                                </td>
                                                <td style="text-align:center">
    <?php echo $status['EXTREME_SURCHARGE']; ?>
                                                </td>
                                            </tr>
                                        </table>
<?php } ?>
                                    <table width="100%" border="1" style=" margin-top:0.5%">
                                        <tr>
                                            <th scope="col">TYPE D'INFRACTION(S)</th>
                                            <th scope="col">AMENDE(S)</th>
                                        </tr>

                                        <?php
                                        if (sizeof($stat) != 0) {
                                            foreach ($stat as $key) {
                                                ?>
                                                <tr>
                                                    <td>
        <?php echo $key['LIBELLE_TYPE_INF']; ?>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <div align="right">
        <?php echo number_format($key['MONTANT_AMENDE'], 0, '', '.') . " " . $devise; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                    <label >
                                                       <!-- <h6>AUCUNE INFRACTION </h6>-->
                                                    </label>
                                                </td>
                                            </tr>
<?php } ?>
                                        <tr>
                                            <td>
                                                 <?php
                                        if ($status['OVERLOAD_MASS'] == 0) {
                                            ?>
                                                PAS DE SURCHARGE
                                            </td>
                                            <?php
                                        } else {
                                            ?>
                                            <td>
                                                FACTURATION FAITE SUR "<?php echo $status['OVERLOAD_NAME']; ?>"
                                            </td>
                                            <?php
                                        }
                                        ?>
                                            </td>
                                            <td>
                                                <div align="right">
<?php echo  number_format($status['OVERLOAD_FINE'], 0, '', '.') . " " . $devise; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                             <td>&nbsp;</td>
                                            <td>FRAIS DE PESAGE</td>
                                            <td><div align="right">
                                                    <?php
                                                    if (preg_replace('/\s+/', '', $status['TRANSIT']) == "INTERNATIONAL") {
                                                        echo  number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                    } else {
                                                        echo   number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                    }
                                                    ?>
                                                </div></td>
                                        </tr>
                                    </table>

                                    <table width="100%" border="0" style=" margin-top:2%">
                                        <tr>
                                            <td>
                                                <u>Copie:</u>Duplicata
                                            </td>
                                            <td><div align="right">TOTAL &Agrave; PAYER :</div></td>
                                            <td style=" font-size: large"><div align="right"><strong><?php echo number_format($status['AMENDE_TOTAL'], 0, '', '.') . ' ' . $devisePARAM; ?></strong></div></td>
                                        </tr>
                                        <tr>
                                        <td>Op&eacute;rateur de pesage: <?php echo $status['LOGIN_OP'] ?></td>
                                         </tr>
                                    </table>
                                    <table align="right" style="margin-top:1%">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><div align="right">Imprim&eacute; le : </div></td>
                                        <td><div align="right"><?php echo date('d-m-Y H:i:s'); ?></div></td>
                                    </tr>
                                </table>
                                <table width="100%" border="1" style="margin-top:1%">
                                    <tr>
                                        <td><div align="center"><strong>AFRIQUE PESAGE SA | Site web : www.afriquepesage.com | TEL: +225 21 35 35 20/+225 21 35 64 47</strong></div></td>
                                    </tr>
                                </table>
                                </div>


                                <div id="one" style="width:146px; margin: 0 auto;">
                                    <?php
// outputs image directly into browser, as PNG stream
// echo '<img src="duplicata.php" style="width:100px;"/>';
                                    ?>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="renseigner" class="btn btn-blue" id="btnPrint"><!-- onClick="window.print()"-->
                            VALIDER
                        </button>
                    </div>
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
<div class="footer clearfix">
                            <div class="footer-inner">
                                AFRIQUE PESAGE S.A c&ocirc;te d'ivoire - Abidjan - Zone 4C, Rue du docteur CALMETTE - Adresse:16
                            </div>
                            <div class="footer-items">
                                <span class="go-top"><i class="clip-chevron-up"></i></span>
                            </div>
                        </div>
                        <!-- end: FOOTER -->
                        <!-- end: PAGE CONTENT-->
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
                                                        document.getElementById("btnPrint").onclick = function () {
                                                            printElement(document.getElementById("printThis"));
                                                            window.print();
                                                            $.ajax({
                                                                type: 'POST',
                                                                data: "",
                                                                url: 'duplicata_log.php',
                                                                success: function (data) {
                                                                    if (data != 'Error') {
                                                                        alert(data);
                                                                        window.location.href = 'intro_operateur.php';
                                                                    } else {
                                                                    }
                                                                },
                                                                error: function () {
                                                                    /*console.log(data);*/
                                                                    alert('ERREUR! RECOMMENCER');
                                                                }
                                                            });
                                                        }

                                                        function printElement(elem, append, delimiter) {
                                                            var domClone = elem.cloneNode(true);
                                                            var $printSection = document.getElementById("printSection");
                                                            if (!$printSection) {
                                                                var $printSection = document.createElement("div");
                                                                $printSection.id = "printSection";
                                                                document.body.appendChild($printSection);
                                                            }

                                                            if (append !== true) {
                                                                $printSection.innerHTML = "";
                                                            } else if (append === true) {
                                                                if (typeof (delimiter) === "string") {
                                                                    $printSection.innerHTML += delimiter;
                                                                } else if (typeof (delimiter) === "object") {
                                                                    $printSection.appendChlid(delimiter);
                                                                }
                                                            }

                                                            $printSection.appendChild(domClone);
                                                        }
        </script>
        <script>
            $('body').on('hidden.bs.modal', '#receipt', function () {
                //alert('hidden again');
                $(this).removeData('bs.modal');
            });
            /*
             * 
             * $('#receipt').on('hidden', function () {
             alert('hidden');//$(this).removeData('modal');
             });
             */
        </script>

    </body>
    <!-- end: BODY -->
</html>