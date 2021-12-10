<?php
/*
 * Author: y.dago@afriquepesage.com
 * Maintain by: r.koua@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */

session_start();
if(empty($_SESSION['nom_utilisateur'])){
    header("location: index.php");
}
else{
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
include 'penalite_config.php';

$check_pesee = $_SESSION['num_pesee'];
$date_wim_pesee = $_SESSION['date_wim_pesee'];
$paiment_verba = "SELECT [PAIMENT_VERBA] FROM [dbo].[VERBALISATION] WHERE [NUMERO_PESE]='$check_pesee' AND [DATE_PESEE_WIM]='$date_wim_pesee'";
$status_info = $conn->prepare($check_pesee);
$status_info->execute();
$status = $status_info->fetch();
$_SESSION['overload_mass'] = 0;
$pds = 0;
$pds01 = 0;
if ($status['PAIMENT_VERBA'] != 1) {

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
                #receipt{
                    margin-left: -410px !important;
                    width:800px !important;
                    /* height: 610px;*/
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
                /** get weighing informations
                 * recuperer les infos de pesee
                 */
                $sth_P = $dbh->prepare('SELECT a."Numero_Pesee", a."Id_VP", a."Date_Pesee", a."Heure_Pesee", a."Unite_Mesure_Pesee", a."Vitesse_Moyenne_Pesee", a."Acceleration_Moyenne_Pesee", a."Selectionne_Pesee", a."Photo_Pesee", a."Commentaire_Pesee", a."Utilisateur_Pesee", a."poids_total_vehicule_Pesee", a."surcharge_Vehicule_Pesee", a."Vitesse_Min_Pesee", a."Vitesse_Max_Pesee", a."Erreur_Pesee", a."Type_Pesee", a."position_virgule", a.RDB$DB_KEY FROM "Pesee" a where a."Id_VP" =' . $_SESSION['num_pesee']);
                $sth_P->execute();
                $result_P = $sth_P->fetch();

                /** get vehicule informations
                 * recuperer les infos du vehicule
                 */
                $sth_VP = $dbh->prepare('SELECT a."id_VP", a."nom_VP", a."poidsMax_VP", a."distFinMin_VP", a."distFinMax_VP", a."distFin_VP", a."longueurMax_VP", a."longueurMesure_VP", a."baseLongMesure_VP", a."hauteurMax_VP", a."hauteurMesure_VP", a."nbrMobiles_VP", a."image_VP", a."distancedebutMesuree_VP", a."distancedebutMin_VP", a."distancedebutMax_VP", a."erreur_VP", a.RDB$DB_KEY FROM "Vehicule_Pese" a where a."id_VP" =' . $result_P["Id_VP"]);
                $sth_VP->execute();
                $result_VP = $sth_VP->fetch();
                $class_vehicule_uemoa = $result_VP['nom_VP'];

                /** get vehicule photo from above $result_VP information
                 * recuperer la photo du vehicule des infos de $result_VP
                 */
                if (strpos($result_P["Photo_Pesee"], "c") || strpos($result_P["Photo_Pesee"], "C")) {
                    $photo_vehicule_link = $result_VP['nom_VP'];
                } else {
                    if ($_SESSION['citern'] != 'oui') {
                        $photo_vehicule_link = $result_VP['nom_VP'];
                    } else {
                        $photo_vehicule_link = $result_VP['nom_VP'] . 'C';
                    }
                }

                /*
                  if ($_SESSION['citern'] != 'oui') {
                  $photo_vehicule_link = $result_VP['nom_VP'];
                  } else {
                  $photo_vehicule_link = $result_VP['nom_VP'] . 'C';
                  }
                 */
                $photo_vehicule_info = $conn->query("SELECT [silhouette]  FROM [dbo].[PARAM_SURCH] WHERE [Type_vehicule]='$photo_vehicule_link'");
                $photo_vehicule_info->execute();
                $photo_vehicule = $photo_vehicule_info->fetch();
                $_SESSION['vehicule_link'] = $photo_vehicule_link;

                //GET DEVISE
                $dev = $conn->query("SELECT [devisePARAM]  FROM [dbo].[ADMIN_PARAM]");
                $dev->execute();
                $devs = $dev->fetch();
                $devise = $devs['devisePARAM'];


                /** get vehicule UEMOA informations
                 * recuperer les infos UEMOA du vehicule
                 */
                $uemoa_info = $conn->query("SELECT [ptac_uemoa], [seuil_surch], [seuil_ext_surc]  FROM [dbo].[PARAM_SURCH] WHERE [Type_vehicule] ='$class_vehicule_uemoa'");
                $uemoa_info->execute();
                $uemoa = $uemoa_info->fetch();

                /*
                 * Get immatriculation-product-destination-/company infos
                 * Recuperer les infos d'immtriculation-produit-destination/provenance-societe/proprietaire
                 */
                $immatriculation_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=1 and a."Numero_Pesee" =' . $_SESSION['num_pesee']);
                $immatriculation_info->execute();
                $immatriculation = $immatriculation_info->fetch();

                $produit_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=2 and a."Numero_Pesee" =' . $_SESSION['num_pesee']);
                $produit_info->execute();
                $produit = $produit_info->fetch();

                $provenance_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=3 and a."Numero_Pesee" =' . $_SESSION['num_pesee']);
                $provenance_info->execute();
                $provenance = $provenance_info->fetch();

                $societe_info = $dbh->query('SELECT DISTINCT  a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a, "Champs" b where b."num_Champs"= a."num_Champs"  and a."num_Champs"=4 and a."Numero_Pesee" =' . $_SESSION['num_pesee']);
                $societe_info->execute();
                $societe = $societe_info->fetch();

                /*
                 * Get Groupe Essieux infos
                 * Recuperer les infos Groupe Essieux
                 * ORIGINAL
                  $grpe_ess_info = $dbh->query('SELECT a."id_GP", a."id_MP", a."nom_GP", a."poidsMax_GP", a."nbrEssieux_GP", a."image_GP", a."poids_GP", a."distMinGroupe_GP", a."distMaxGroupe_GP", a."distGroupeMesure_GP", a."position_GP", a."erreur_GP", a.RDB$DB_KEY FROM "Group_Pese" a where a."id_MP"=' . $_SESSION['num_pesee']);
                  $grpe_ess_info->execute();
                  $grpe_ess = $grpe_ess_info->fetchAll();
                 */
                $grpe_ess_info = $dbh->query('SELECT a."id_GP", a."id_MP", a."nom_GP", a."poidsMax_GP", a."nbrEssieux_GP", a."image_GP", '
                        . 'a."poids_GP", a."distMinGroupe_GP", a."distMaxGroupe_GP", a."distGroupeMesure_GP", a."position_GP", a."erreur_GP", '
                        . 'a.RDB$DB_KEY '
                        . 'FROM "Group_Pese" a,'
                        . '"Mobile_Pese" b, "Vehicule_Pese" c, "Pesee" d '
                        . 'where c."id_VP"=d."Id_VP" and c."id_VP"=b."id_VP" and b."id_MP"=a."id_MP" and d."Numero_Pesee"=' . $_SESSION['num_pesee']);
                $grpe_ess_info->execute();
                $grpe_ess = $grpe_ess_info->fetchAll();
                /*
                 * Get Mx WEIGHT ON ESSIEUX GROUP
                 * RECUPERER LE POID DU GROUPE ESSIEUX LE PLUS ELEVE
                 */
                $grpe_ess_PDS = $dbh->query('SELECT  MAX (a."poids_GP") as "gp_max" FROM "Group_Pese" a where a."id_MP"=' . $_SESSION['num_pesee']);
                $grpe_ess_PDS->execute();
                $grpe_pds = $grpe_ess_PDS->fetch();
                $_SESSION['poid_total_groupe_essieux'] = $grpe_pds['gp_max'];

                //liste des infractions
                $nbreInf = "SELECT [CODE_TYPE_INF],[LIBELLE_TYPE_INF],[MONTANT_INF_INT],[MONTANT_INF_NAT] FROM [dbo].[TYPE_INFRACTION]";
                $nbreinfra = $conn->query($nbreInf);
                $totinf = $nbreinfra->fetchAll();
            }
            ?>
            <!-- start: MAIN CONTAINER -->
            <div class="main-container">
                <!-- start: CONTAINER -->
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
                                                    &nbsp;Site: <?php echo $_SESSION['site']; ?></a>
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

                    <?php
                    //QUERY THE DATABASE TO GET THE TYPE OF OVERLOAD PENAITY TO TAKE INTO ACCOUNT  
                    $info = $conn->query("SELECT * FROM [dbo].[ADMIN_PARAM]");
                    $info->execute();
                    $infos = $info->fetch();
                    $app_ext_sur = $infos['ApplicationExtSurcharge'];
                    $app_pds_ttl = $infos['ApplicationPdsTotal'];
                    $_SESSION['ApplicationExtSurcharge'] = $app_ext_sur;
                    $num_verbalisation = 'V' . $result_P['Numero_Pesee'] . date('my') . $_SESSION['num_site'];
                    $num_pesee = $result_P['Numero_Pesee'] . date('my') . $_SESSION['num_site'];
                    $_SESSION['num_verb'] = $num_verbalisation;
                    $_SESSION['num_pesee_webafp'] = $num_pesee;
                    $_SESSION['num_pesee_wim'] = $result_P['Numero_Pesee'];
                    $_SESSION['immatriculation'] = $immatriculation['valeur_champs'];
                    $_SESSION['prov_dest'] = $provenance['valeur_champs'];
                    $_SESSION['photo_vehicule_link'] = $photo_vehicule_link;
                    $_SESSION['nom_client'] = $societe['valeur_champs'];
                    $_SESSION['produit_transporte'] = $produit['valeur_champs'];
                    $_SESSION['class_vehicule'] = $photo_vehicule_link;
                    $_SESSION['photo'] = $photo_vehicule['silhouette'];
                    $_SESSION['poidsMax_VP'] = $result_VP['poidsMax_VP'];
                   
                    $_SESSION['poid_total'] = round($result_P['poids_total_vehicule_Pesee']);
					 $result_P['surcharge_Vehicule_Pesee'] = ($result_P['poids_total_vehicule_Pesee'] - ($result_P['poids_total_vehicule_Pesee'] * $tolerance / 100) ) - $result_VP['poidsMax_VP'];
                   // $result_P['surcharge_Vehicule_Pesee'] = $result_P['poids_total_vehicule_Pesee'] - $result_VP['poidsMax_VP'];
                   // $result_P['surcharge_Vehicule_Pesee'] = $result_P['poids_total_vehicule_Pesee'] - $uemoa['seuil_surch'];
                    if ($result_P['surcharge_Vehicule_Pesee'] < 0) {
                        $result_P['surcharge_Vehicule_Pesee'] = 0;
                    }
                    $_SESSION['poids_total_vehicule'] = $result_P['poids_total_vehicule_Pesee'];
                   // $_SESSION['value_surcharge'] = $result_P['surcharge_Vehicule_Pesee'];
				   $_SESSION['value_surcharge'] = $result_P['surcharge_Vehicule_Pesee'];
                    $_SESSION['surcharge_Vehicule_Pesee'] = $result_P['surcharge_Vehicule_Pesee'];
                    $_SESSION['seuil_ext_surc'] = $uemoa['seuil_ext_surc'];
                    $_SESSION['surcharge_essieux'] = 0;
                    $_SESSION['ptac'] = $uemoa['ptac_uemoa'];

                    //TOLERANCE OVERLOAD IS TAKEN INTO ACCOUNT
                    if ($app_tol != 0) {
                        if ($type_tolerance != 0) {
                            if ($app_ext_sur == 1) {
                                $surcharge = 0;
                                $surcharge_ext = 0;
                                $confimation = 0;
                                $hydrocabure_ext = 0;
                                $frais_ext_NAT = $AmendeExtremeSurNat;
                                $frais_ext_INT = $AmendeExtremeSurInt;
                                $frais_ext_NAT01 = $INFPoidsTotalsAmNAT;
                                $frais_ext_INT01 = $INFPoidsTotalsAmINT;
                                if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                    $surcharge = 0;
                                    $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                } else
                                 if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
									  $confimation = $_SESSION['poid_total'] - ($_SESSION['poid_total'] * $tolerance / 100);
                                        if (($confimation - $uemoa['seuil_surch']) >= 0) { 

                                            $surcharge = $confimation - ($_SESSION['ptac'] * 120 / 100);
                                            $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
											//$_SESSION['value_surcharge'] = $surcharge;
                                        } else   
                                        if (($confimation - $uemoa['seuil_surch']) < 0) { 
                                            //$surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
											$surcharge = 0;
                                            $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
											//$_SESSION['value_surcharge'] = $surcharge;
                                        }          
									 
                                } else 
                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                    
                                        $confimation = $_SESSION['poid_total'] - ($_SESSION['poid_total'] * $tolerance / 100);
                                        if (($confimation - $uemoa['seuil_ext_surc']) >= 0) { 
										    $surcharge = $confimation - ($_SESSION['ptac'] * 120 / 100);
                                            $surcharge_ext = $confimation - ($_SESSION['ptac']);
                                            $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
											//$_SESSION['value_surcharge'] = $surcharge;
                                        } else   
                                        if (($confimation - $uemoa['seuil_ext_surc']) < 0) { 
                                            $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
											$surcharge_ext = 0;
											$_SESSION['value_surcharge']= $surcharge;
                                            $_SESSION['value_extreme_surcharge'] = $surcharge_ext ;
											//$_SESSION['value_surcharge'] = $surcharge;
                                        }                                       
                                }
                                ?>
								
                               
								

                                <div class="row second" style="margin-top: 0.5%;padding-left: 1%;padding-right: 1%; border-bottom: 2px solid #8C001A;">
                                    <table class="table table-hover table-bordered" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th>NOM CLASSE</th>
                                                <th>PTAC UEMOA (Kg)</th>
                                                <th>PTAC UEMOA 20% (Kg)</th>
												<th>PTAC UEMOA 40%(Kg)</th>
                                                <th>PDS DU VEHICULE (Kg)</th>
												 <th>PDS TOLERE DU VEHICULE (Kg)</th>
												 <th>EXTR&Egrave;ME SURCHARGE (Kg)</th>
                                                <th>SURCHARGE (Kg)</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody style=" text-align: center;">
                                            <tr>
                                                <td>
                                                    <?php echo substr($photo_vehicule_link, 7); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo round($_SESSION['ptac']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $result_VP['poidsMax_VP'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo round($uemoa['seuil_ext_surc']); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    //$_SESSION['poids_total_vehicule'] = $result_P['poids_total_vehicule_Pesee'];
                                                   // echo round($result_P['poids_total_vehicule_Pesee']*0.95);
													echo round($result_P['poids_total_vehicule_Pesee']);
                                                    ?>
                                                </td>
                                                   <td>
                                                    <?php
                                                    //$_SESSION['poids_total_vehicule'] = $result_P['poids_total_vehicule_Pesee'];
                                                    echo round($result_P['poids_total_vehicule_Pesee'] * (1 - $tolerance /100));
													//echo round($result_P['poids_total_vehicule_Pesee']);
                                                    ?>
                                                </td>                                            
                                                 <td style="color:<?php switchColor($surcharge_ext) ?>; font-size:<?php switchFont($surcharge_ext) ?>">
                                                    <?php
                                                    echo round($surcharge_ext);
                                                    ?>
                                                </td>
                                                <td style="color:<?php color($surcharge) ?>; font-size:<?php font($surcharge) ?>">
                                                    <?php
                                                    echo round($surcharge);
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                                    <div class="col-sm-3" >
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td id="silhouette">
                                                            <?php
                                                            if ($_SESSION['photo'] != '') {
                                                                ?>
                                                                <img src="<?php echo $_SESSION['photo']; ?>"/>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td style="width:15% !important;"><label class="col-sm-8 control-label" for="form-field-5">
                                                                Nº VERB 
                                                            </label></td>
                                                        <td style="width:22% !important;"><input id="form-field-9" class="form-control" value="<?php echo $_SESSION['num_verb']; ?>"type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                Nº PESEE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $_SESSION['num_pesee_webafp']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                OP&Eacute;RATEUR
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php
                                                            if (!isset($_SESSION['login_utilisateur'])) {
                                                                
                                                            } else {
                                                                echo $_SESSION['login_utilisateur'];
                                                            }
                                                            ?>" type="text" placeholder="" readonly ></td>
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
                                                                TYPE VEHICULE
                                                            </label></td>
                                                        <td id="type">
                                                            <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo substr($photo_vehicule_link, 7); ?>" type="text" placeholder="" readonly >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                SOCI&Eacute;T&Eacute;/PROPRI&Eacute;TAIRE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $societe['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                IMMATRICULATION
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $immatriculation['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PROV/DEST
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $provenance['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
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
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PRODUIT
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $produit['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                NATIONALIT&Eacute;
                                                            </label></td>
                                                        <td>
                                                            <input id="form-field-1" class="form-control" name="nationalite" type="text" value="<?php echo $_SESSION['nationalite'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                EXPORTATEUR
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $_SESSION['exportateur'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                TRANSPORT
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php
                                                            if ($_SESSION['preferentiel'] != 1) {
                                                                echo $_SESSION['transport'];
                                                            } else {
                                                                echo $_SESSION['transport_affichage'];
                                                            }
                                                            ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="produit_dangeureux" value=" <?php echo $_SESSION['produit_dangereux']; ?>" style="border-style:none;color: #8C001A;"/>
                                        <div class="panel-body" >
                                            <div class="form-group">
                                                <p>
                                                <h6>INFRACTION(S)</h6>                            
                                                </p>
                                                <table width="100%" border="0">
                                                    <?php
                                                    if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                        for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                            ?>
                                                            <tr>
                                                                <td valign="top">
                                                                    <label class="checkbox-inline">
                                                                        <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                    </label>
                                                                </td>
                                                                <td valign="top">
                                                                    <h6> <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?> </h6>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td valign="top">
                                                                <label class="checkbox-inline">
                                                                    <!--<h6>PAS DE FRAUDE </h6>-->
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
                                                foreach ($grpe_ess as $gp_es) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $gp_es['nom_GP']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo ($gp_es['poids_GP']* (1 - $tolerance /100));
															//echo ($gp_es['poids_GP']);
                                                            ?>
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
														        $confimationGP = $gp_es['poids_GP'] - ($gp_es['poids_GP'] * $tolerance / 100);		
														        if (($confimationGP - $gp_es['poidsMax_GP']) >= 0) { 
                                                                 $sur = $confimationGP - $gp_es['poidsMax_GP'] ;
																  echo $sur;
                                                                } else   
                                                               if (($confimationGP - $gp_es['poidsMax_GP']) < 0) { 
                                                               $sur= 0;
                                                                   echo $sur;
                                                                 }                                       
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
                                        <a class="btn btn-green btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                            ENREGISTRER
                                            <i class="fa fa-check fa-white"></i>
                                        </a>
                                        <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                            ANNULER
                                            <i class="fa fa-times fa fa-white"></i>
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
                                                     */
                                                    $ess_info = $dbh->query('SELECT a."id_EP", a."id_GP", a."nom_EP", a."poidsMax_EP", a."poidsMesure_EP", a."distMinEssieu_EP", a."distMaxEssieu_EP", a."positionEssieuMesuree_EP", a."distEssieuMesuree_EP", a."vitesse_EP", a."acceleration_EP", a."erreur_EP", a.RDB$DB_KEY FROM "Essieu_Pese" a where a."id_GP"=' . $g_e['id_GP']);
                                                    $ess_info->execute();
                                                    $ess = $ess_info->fetchAll();
                                                    foreach ($ess as $es) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $es['nom_EP']; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                echo ($es['poidsMesure_EP']* (1 - $tolerance /100));
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $es['poidsMax_EP']; ?>
                                                            </td>
                                                          <td>
                                                                <?php
                                                                $val_sur = $es['poidsMesure_EP'] - $es['poidsMax_EP'];
                                                                if ($val_sur < 0) {
                                                                    echo 0;
                                                                } else {
														        $confimationEP = $es['poidsMesure_EP'] - ($es['poidsMesure_EP'] * $tolerance / 100)	 ;	
														        if (($confimationEP - $es['poidsMax_EP']) >= 0) { 
                                                                 $val_sur = $confimationEP - $es['poidsMax_EP'] ;
																  echo $val_sur;
                                                                } else   
                                                               if (($confimationEP - $es['poidsMax_EP']) < 0) { 
                                                               $val_sur= 0;
                                                                   echo $val_sur;
                                                                 }                                       
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
                                        <?php
                                        $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                        $info->execute();
                                        $essieux = $info->fetch();
                                        //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql = $dbh->query('select max((e."poidsMesure_EP"*(0.97))-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                        $sql->execute();
                                        $result = $sql->fetch();
                                        $overload_axle = $result["bigest_overload_ep"];
                                        //CALCUL
                                       /* if ($result['high'] < 0) {
                                            $_SESSION['surcharge_essieux'] = 0;
                                         } else {
                                            $_SESSION['surcharge_essieux'] = $result['high'];
                                        }
 */
									 if ($result['high'] < 0) {
                                            $_SESSION['surcharge_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_essieux'] = $result['high'];
                                        }
                                        //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",     g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');

                                        $sql_gp->execute();
                                        $result_gp = $sql_gp->fetch();
                                        $overload_gp_axle = $result_gp["bigest_overload_gp"];
										
										//
										$sql_gp2 = $dbh->query('select  max((g."poids_GP"*(0.97))-g."poidsMax_GP") as "high_gpT",    g."nom_GP" as "bigest_overload_gp2"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gpT" desc rows 1');
										 $sql_gp2->execute();
                                        $result_gp2 = $sql_gp2->fetch();
                                        $overload_gp_axle = $result_gp2["bigest_overload_gp2"];
										
										
                                        //CALCUL
                                        /* if ($result_gp['high_gp'] < 0) {
                                            $_SESSION['surcharge_gp_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                        } */
										 if ($result_gp['high_gp'] < 0) {
                                            $_SESSION['surcharge_gp_essieux'] = 0;
											//$overload_gp_axle = $result_gp["bigest_overload_gp"];
                                        } else 
											
											if ($result_gp2['high_gpT'] > 0) {
                                            $_SESSION['surcharge_gp_essieux'] = $result_gp2['high_gpT'];
											//$overload_gp_axle = $result_gp2["bigest_overload_gp2"];
											//echo $_SESSION['surcharge_gp_essieux'];
                                        }
										 else {
											
											 $_SESSION['surcharge_gp_essieux'] = 0;;
                                        }
										
                                        // I-CHECK IF TRANSPORT IS HYDROCARBURE
                                     // if ($_SESSION['produit_transporte'] == "HYDROCARBURE" || $_SESSION['produit_transporte'] == "GAZ BUTANE" || $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                        if ($_SESSION['produit_transporte'] == "HYDROCARBURE") {
                                            //if ($_SESSION['produit_transporte'] == "HYDROCARBURE"){
                                            $_SESSION['overload_name'] = "HYDROCARBURE";
                                            //$_SESSION['overload_mass'] =
                                            
                                                    
                                                     if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            } else {
                                                $_SESSION['overload_mass'] = $_SESSION['value_extreme_surcharge'];
                                                $_SESSION['value_surcharge'] = $_SESSION['value_extreme_surcharge'];
                                            }
                                            /* } else if ($_SESSION['produit_transporte'] == "GAZ BUTANE"){
                                              $_SESSION['overload_name'] = "GAZ BUTANE";
                                              }else if ($_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ"){
                                              $_SESSION['overload_name'] = "BOUTEILLE DE GAZ";
                                              }else{}
                                             */

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL 
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT;
                                                $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                } else {
                                                    $fine = $fine + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                }
                                            }
                                              
                                            //I-2-CHECK IF THE CONVOY IS NATIONAL
                                            else if ($_SESSION['transport'] == "NATIONAL") {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT;
                                                $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                           
                                            //I-3-THE CONVOY IS THEN PREFERENTIAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT ;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                        }
                    
                                        //II-CHECK IF TRANSPORT IS GRUME OR GAZ BUTANE OR BOUTEIL DE GAZ
                                        else if ($_SESSION['produit_transporte'] == "GRUME" || $_SESSION['produit_transporte'] == "GAZ BUTANE" || $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                           
                                            if ( $_SESSION['produit_transporte'] == "GRUME") {
                                            $_SESSION['overload_name'] = "GRUME";
                                            
                                            }
                                            
                   
                                          else if ( $_SESSION['produit_transporte'] == "GAZ BUTANE") {
                                           $_SESSION['overload_name'] = "GAZ BUTANE";
                                           }
                                                
                                                else if  ( $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                                    
                                                    $_SESSION['overload_name'] = "BOUTEILLE DE GAZ";
                                                }
                                           // $_SESSION['overload_name'] = "GRUME";
                                            if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            } else {
                                                $_SESSION['overload_mass'] = $_SESSION['value_extreme_surcharge'];
                                                $_SESSION['value_surcharge'] = $_SESSION['value_extreme_surcharge'];
                                            }

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {

                                                if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                    $fine = $_SESSION['value_surcharge'] * $frais_ext_INT + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                } else {
                                                    $fine = $_SESSION['value_surcharge'] * $frais_ext_INT + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                }
                                            }
                                            //I-2-CHECK IF THE CONVOY IS NATIONAL
                                            else if ($_SESSION['transport'] == "NATIONAL") {
                                                if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                    $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT  + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                } else {
                                                    $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                }
                                            }
                                            //I-3-THE CONVOY IS THEN PREFERENTIAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT + $fraisPESAGENAT;
                                            }
                                        }
                                        //III-THE TRANSPORT IS SET TO GLOBAL WEIGHT
                                        else if ($app_pds_ttl == 1) {
                                            $_SESSION['overload_name'] = "POIDS TOTAL";
                                            $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            $pds = $_SESSION['value_surcharge'];
                                            //III-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                //III-2-a CHECK IF TOTAL WEIGHT IS LESSER THAN (PTAC * 1.2)
                                                if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                                    $fine = $fraisPESAGEINT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.2) AND LESSER THAN (PTAC * 1.4)
                                                else
                                                if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                    $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                    $_SESSION['value_surcharge'] = $surcharge;
                                                    $fine = ($surcharge * $frais_ext_INT01) + $fraisPESAGEINT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                                else
                                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                    $confimation = $_SESSION['poid_total'] - ($_SESSION['poid_total'] * $tolerance / 100);
                                                    if (($confimation - $uemoa['seuil_ext_surc']) >= 0) { 
                                                        $surcharge_ext = $confimation - $_SESSION['ptac'] ;
                                                        $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                                        $fine = ($surcharge_ext * $frais_ext_INT) + $fraisPESAGEINT;
                                                    } else   
                                                    if (($confimation - $uemoa['seuil_ext_surc']) < 0) {                                                                                                      
                                                        $surcharge_ext = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                        $_SESSION['value_surcharge'] = $surcharge_ext;
                                                        $fine = ($surcharge_ext * $frais_ext_INT01) + $fraisPESAGEINT;
                                                    }
                                                }
                                            }
                                            //III-3 CHECK IF TRANSPORT IS NATIONAL
                                            else if ($_SESSION['transport'] == "NATIONAL") {
                                                //III-3-a CHECK IF TOTAL WEIGHT IS LESSER THAN (PTAC * 1.2)
                                                if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                                    $fine = $fraisPESAGENAT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.2) AND LESSER THAN (PTAC * 1.4)
                                                else
                                                if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                    $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                    $_SESSION['value_surcharge'] = $surcharge;
                                                    $fine = ($surcharge * $frais_ext_NAT01) + $fraisPESAGENAT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                                else
                                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                    $confimation = $_SESSION['poid_total'] - ($_SESSION['poid_total'] * $tolerance / 100);
                                                    if (($confimation - $uemoa['seuil_ext_surc']) >= 0) { 
                                                        $surcharge_ext = $confimation - $_SESSION['ptac'] ;
                                                        $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                                        $fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;
                                                    } else   
                                                    if (($confimation - $uemoa['seuil_ext_surc']) < 0) {
                                                      //  $surcharge_ext = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                       // $_SESSION['value_surcharge'] = $surcharge_ext;
                                                       // $fine = ($surcharge_ext * $frais_ext_NAT01) + $fraisPESAGENAT;
                                                      $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                    $_SESSION['value_surcharge'] = $surcharge;
                                                    $fine = ($surcharge * $frais_ext_NAT01) + $fraisPESAGENAT;
                                                    
                                                    }
                                                    //$fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;
                                                }
                                            }
                                            //III-4 THE TRANSPORT IS THEN PREFERENTIAL
                                            else {
                                                if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                    $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                    $_SESSION['value_surcharge'] = $surcharge;
                                                    $fine = ($surcharge * $frais_ext_NAT01) + $fraisPESAGENAT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                                else
                                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                    $confimation = $_SESSION['poid_total'] - ($_SESSION['poid_total'] * $tolerance / 100);
                                                    if (($confimation - $uemoa['seuil_ext_surc']) >= 0) { 
                                                        $surcharge_ext = $confimation - $_SESSION['ptac'] ;
                                                        $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                                        $fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;
                                                    } else   
                                                    if (($confimation - $uemoa['seuil_ext_surc']) < 0) {
                                                        $surcharge_ext = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                        $_SESSION['value_surcharge'] = $surcharge_ext;
                                                        $_SESSION['value_extreme_surcharge'] = 0;
                                                        $fine = ($surcharge_ext * $frais_ext_NAT01) + $fraisPESAGENAT;
                                                /*    
                                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                    $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                    $_SESSION['value_surcharge'] = $surcharge_ext;
                                                    $fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;*/
                                                 }
                                                }
                                            }
                                        } //partie
                                        //IV-THE TRANSPORT IS NEITHER HYDROCARBURE OR GRUME NOR SET TO GLOBAL WEIGHT SO LOGIC GOES AS NORMAL AS USUAL
                                        else {
                                            //IV-1 CHECK WHICH IS BIGGER AMONG ESSIEUX GROUP ESSIEUX AND POIDS VEHICULE
                                            if ($_SESSION['surcharge_gp_essieux'] == $_SESSION['surcharge_essieux']) {
													if ($_SESSION['transport'] == "INTERNATIONAL") {
																$pds = $_SESSION['surcharge_essieux'] * $frais_ext_INT;
													}
													else if ($_SESSION['transport'] == "NATIONAL") {
																$pds = $_SESSION['surcharge_essieux'] * $frais_ext_NAT;
													}
													else  {
																$pds = $_SESSION['surcharge_essieux'] * $frais_ext_NAT;
													}
													
												$pdssurch = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_mass'] = $_SESSION['surcharge_essieux'];
												
                                                $_SESSION['overload_name'] = $overload_axle;
												
                                            } else if ($_SESSION['surcharge_gp_essieux'] > $_SESSION['surcharge_essieux']) {
												if ($_SESSION['transport'] == "INTERNATIONAL") {
																$pds = $_SESSION['surcharge_gp_essieux'] * $frais_ext_INT;
													}
													else if ($_SESSION['transport'] == "NATIONAL") {
																$pds = $_SESSION['surcharge_gp_essieux'] * $frais_ext_NAT;
													}
													else  {
																$pds = $_SESSION['surcharge_gp_essieux'] * $frais_ext_NAT;
													}
													
											    $pdssurch = $_SESSION['surcharge_gp_essieux'];
                                                $_SESSION['overload_mass'] =$_SESSION['surcharge_gp_essieux'];
                                                $_SESSION['overload_name'] = $overload_gp_axle;
												
                                            } else {
												if ($_SESSION['transport'] == "INTERNATIONAL") {
																$pds = $_SESSION['surcharge_essieux'] * $frais_ext_INT;
													}
													else if ($_SESSION['transport'] == "NATIONAL") {
																$pds = $_SESSION['surcharge_essieux'] * $frais_ext_NAT;
													}
													else  {
																$pds = $_SESSION['surcharge_essieux'] * $frais_ext_NAT;
													}
													
													
												$pdssurch = $_SESSION['surcharge_essieux'];	
                                                $_SESSION['overload_mass'] = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_name'] = $overload_axle;
											}
												
										   if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            } else {
                                                $_SESSION['overload_mass'] = $_SESSION['value_extreme_surcharge'];
                                                $_SESSION['value_surcharge'] = $_SESSION['value_extreme_surcharge'];
                                            }
											if ($_SESSION['transport'] == "INTERNATIONAL") {
												
																$pds01 = $_SESSION['value_surcharge'] * $frais_ext_INT;
													}
													else if ($_SESSION['transport'] == "NATIONAL") {
																$pds01 = $_SESSION['value_surcharge'] * $frais_ext_NAT;
													}
													else  {
																$pds01 = $_SESSION['value_surcharge'] * $frais_ext_NAT;
													}
												
                                            if ($pds01 > $pds) {
																$_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
																$_SESSION['overload_name'] = "POIDS TOTAL";
															
															//IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
															if ($_SESSION['transport'] == "INTERNATIONAL") {
																	//III-2-b CHECK IF OVERLOAD EXISTS
																	if ($_SESSION['overload_mass'] > 0) {
																		//if ($pds > 0) {
																		$fine = $pds01 + $fraisPESAGEINT;
																	} else {
																		$fine = $fraisPESAGEINT;
																	}
															   // }
															}
															//IV-3 CHECK IF TRANSPORT IS NATIONAL
															else if ($_SESSION['transport'] == "NATIONAL") {
																//III-2-c CHECK IF OVERLOAD EXISTS
																	if ($_SESSION['overload_mass'] > 0) {
																		$fine = $pds01 + $fraisPESAGENAT;
																	} else {
																		$fine = $fraisPESAGENAT;
																	}
															}
															//IV-3 THE TRANSPORT IS THEN PREFERENTIAL
															else {
																	if ($_SESSION['overload_mass'] > 0) {
																		$fine = $pds01 + $fraisPESAGENAT;
																	} else {
																		$fine = $fraisPESAGENAT;
																	}
																}
														}
												else if (($pds01 < $pds)  && ($pds01 != 0 )) {
													           
																$_SESSION['overload_mass'] = $pdssurch;
																//$_SESSION['overload_name'] = "$overload_axle";
															
															//IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
															if ($_SESSION['transport'] == "INTERNATIONAL") {
																	//III-2-b CHECK IF OVERLOAD EXISTS
																	if ($_SESSION['overload_mass'] > 0) {
																		//if ($pds > 0) {
																		$fine = $pds + $fraisPESAGEINT;
																	} else {
																		$fine = $fraisPESAGEINT;
																	}
															   // }
															}
															//IV-3 CHECK IF TRANSPORT IS NATIONAL
															else if ($_SESSION['transport'] == "NATIONAL") {
																//III-2-c CHECK IF OVERLOAD EXISTS
																	if ($_SESSION['overload_mass'] > 0) {
																		$fine = $pds + $fraisPESAGENAT;
																	} else {
																		$fine = $fraisPESAGENAT;
																	}
															}
															//IV-3 THE TRANSPORT IS THEN PREFERENTIAL
															else {
																	if ($_SESSION['overload_mass'] > 0) {
																		$fine = $pds + $fraisPESAGENAT;
																	} else {
																		$fine = $fraisPESAGENAT;
																	}
																}
														}
														else if (($pds01 < $pds)  && ($pds01 == 0 )) {
														$_SESSION['overload_mass'] = 0;
														$_SESSION['overload_name'] = "";
												
															//IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
														if ($_SESSION['transport'] == "INTERNATIONAL") {
																if ($_SESSION['overload_mass'] > 0) {
																	$fine = ($pds01 * $frais_ext_INT01) + $fraisPESAGEINT;
																} else {
																	$fine = $fraisPESAGEINT;
																}
														}
														//IV-3 CHECK IF TRANSPORT IS NATIONAL
														else if ($_SESSION['transport'] == "NATIONAL") {
																if ($_SESSION['overload_mass'] > 0) {
																	$fine = ($pds01 * $frais_ext_NAT01) + $fraisPESAGENAT;
																} else {
																	$fine = $fraisPESAGENAT;
																}
														}
														//IV-3 THE TRANSPORT IS THEN PREFERENTIAL
														else {
																//III-2-c CHECK IF OVERLOAD EXISTS
																if ($_SESSION['overload_mass'] > 0) {
																	$fine = ($pds01 * $frais_ext_NAT01) + $fraisPESAGENAT;
																} else {
																	$fine = $fraisPESAGENAT;
																}
															}
												}
														
														
														
												else if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
														$_SESSION['overload_mass'] = 0;
														$_SESSION['overload_name'] = "";
												
															//IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
														if ($_SESSION['transport'] == "INTERNATIONAL") {
																if ($_SESSION['overload_mass'] > 0) {
																	$fine = ($pds * $frais_ext_INT01) + $fraisPESAGEINT;
																} else {
																	$fine = $fraisPESAGEINT;
																}
														}
														//IV-3 CHECK IF TRANSPORT IS NATIONAL
														else if ($_SESSION['transport'] == "NATIONAL") {
																if ($_SESSION['overload_mass'] > 0) {
																	$fine = ($pds * $frais_ext_NAT01) + $fraisPESAGENAT;
																} else {
																	$fine = $fraisPESAGENAT;
																}
														}
														//IV-3 THE TRANSPORT IS THEN PREFERENTIAL
														else {
																//III-2-c CHECK IF OVERLOAD EXISTS
																if ($_SESSION['overload_mass'] > 0) {
																	$fine = ($pds * $frais_ext_NAT01) + $fraisPESAGENAT;
																} else {
																	$fine = $fraisPESAGENAT;
																}
															}
												}
                                            }
                                        // AMOUNT CALCUL
                                        if (isset($_SESSION['infraction'])) {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine + $_SESSION['infraction'];
                                        } else {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine;
                                        }
                                        $var = substr(round($_SESSION['montant_a_paye']), -3);
                                        //echo $var;
                                        //echo '<br/>'.$_SESSION['montant_a_paye'];
                                        if ($var < 100) {
                                            $_SESSION['montant_a_paye'] = $_SESSION['montant_a_paye'] - $var;
                                        } else if ((100 <= $var) && ($var < 600)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 500;
                                        } else if ((600 <= $var) && ($var < 1000)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 1000;
                                        }
                                        ?>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td >
                                                    <input style="visibility: hidden;" type="text" list="categoryname" autocomplete="off" id="clients" name="compte_client" class="form-control" value="<?php
                                                    $_c = $_SESSION['client'];
                                                    echo $_SESSION['client'];
                                                    ?>" required>

                                                                                                                                                                                                                                                                                                                                                                   <!-- <h5 style=" color: #8C001A;"><strong>CLIENT : <?php /*
                                             $_c = $_SESSION['client'];
                                             echo $_SESSION['client']; */
                                                    ?></strong></h5>-->
                                                </td>
                                                <!--
                                                <td>
                                                <?php
                                                /* $bills = $_SESSION['montant_a_paye'];
                                                  //EXPORTATEUR REQUEST
                                                  /* $exportateur = $conn->prepare('SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [PREFERENTIEL] = 1'); *
                                                  $exportateur = $conn->prepare("SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [SOCIETE]= '$_c' AND [SOLDE_COMPTE_CLIENT] > '$bills'");
                                                  $exportateur->execute();
                                                  $exportateur_result = $exportateur->fetchAll();
                                                 * 
                                                 */
                                                ?>
                                                    <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="compte_client" class="form-control" placeholder="Choisir le Nº de Compte..." required>
                                                    <datalist id="categoryname">
                                                <?php //foreach ($exportateur_result as $key) {     ?>
                                                            <option value="<?php //echo rtrim($key['ID_COMPTE_CLIENT']);                            ?>"><?php // echo "Nº " . rtrim($key['ID_COMPTE_CLIENT']) . "=>" . number_format(rtrim($key['SOLDE_COMPTE_CLIENT']), 0, '', '.') . $devise;                            ?></option>
                                                <?php //}      ?>
                                                    </datalist>
                                                </td>
                                                -->
                                                <td style="float:right;font-size: 3em;">
                                                    <h4 style=" color: red;"><strong><u>MONTANT &Agrave; PAYER:</u>&nbsp;&nbsp;<?php
                                                            $bill = $_SESSION['montant_a_paye'];
                                                            echo number_format($_SESSION['montant_a_paye'], 0, '', '.') . " " . $devise;
                                                            ?></strong></h4> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- end: FOOTER -->
                                <!-- end: PAGE CONTENT-->
                                <!-- end: PAGE -->
                                <?php
                                //BILL FOR THE RECEIPT
                                $_SESSION['bill'] = $bill;
                                ?>
                                <!-- start: BOOTSTRAP EXTENDED MODALS -->
                                <div id="receipt" class="modal fade" tabindex="-1" data-width="700">
                                    <form method="post" action="">
                                        <div class="modal-body" id ="printThis">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <div class="row" >
                                                <section   style="width:100%; margin:0 auto;font-size: 11.336px; background-image:url(assets/images/modal.png); background-repeat:no-repeat;">
                                                    <img src="assets/images/modalhead.png" id="overlay">
                                                    <div id="two">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUCTURES ECONOMIQUES
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
                                                            <tr >
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        STATION DE PESAGE FIXE <?php echo substr($_SESSION['site'], 7); ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>
                                                                            Nº VERBALISATION : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_verb']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            Nº PES&Eacute;E : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_pesee_wim']; ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            SOCI&Eacute;T&Eacute;/PROP :
                                                                        </b>
                                                                        <?php echo $societe['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            IMMATRICULATION : 
                                                                        </b>
                                                                        <?php
                                                                        $_SESSION['immatriculation'] = $immatriculation['valeur_champs'];
                                                                        echo $immatriculation['valeur_champs']; 
                                                                        ?>
                                                                        <br><br>
                                                                        <b>
                                                                            PRODUIT :   
                                                                        </b>
                                                                        <?php echo $produit['valeur_champs']; ?>


                                                                    </div>
                                                                </td>
                                                                <td>&nbsp;</td>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>DATE :</b> <?php echo date('d-m-Y H:i:s'); ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            PROV/DEST:</b> <?php echo $provenance['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>EXPORTATEUR:</b> <?php echo $_SESSION['exportateur']; ?><br><br>
                                                                        <b>
                                                                            NATIONALIT&Eacute; :
                                                                        </b>
                                                                        <?php echo $_SESSION['nationalite']; ?>

                                                                        <br><br>
                                                                        <b>
                                                                            TRANSPORT : 
                                                                        </b>
                                                                        <?php
                                                                        if ($_SESSION['preferentiel'] != 1) {
                                                                            echo $_SESSION['transport'];
                                                                        } else {
                                                                            echo $_SESSION['transport_affichage'];
                                                                        }
                                                                        ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;</td>
                                                                <td>
                                                                    <div align="center">
                                                                        <?php
                                                                        echo '<img src="qr_code.php" style="width:100px;"/>';
                                                                        ?>
                                                                        <br>
                                                                        <div align="center" id="modal-silhouette">
                                                                            <?php
                                                                            if ($photo_vehicule['silhouette'] != '') {
                                                                                ?>
                                                                                <img src="<?php echo $photo_vehicule['silhouette']; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <br>
                                                                            <?php $_SESSION['class_vehicule']; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                                <th scope="col">POIDS (KG)</th>
                                                                <th scope="col">POIDS MAX (KG)</th>
                                                                <th scope="col">SURCHARGE (KG)</th>
																<th scope="col">EXTREME SURCHARGE (KG)</th>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $_SESSION['class_vehicule']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    echo round($result_P['poids_total_vehicule_Pesee'] * (1 - $tolerance /100));
                                                                    ?>
                                                                </td>
                                                                <td style="text-align:center"><?php echo $result_VP['poidsMax_VP']; ?></td>
                                                               <td style="text-align:center">
                                                        <?php
                                                        if ($surcharge_ext < 0) {
                                                            echo $result_P['surcharge_Vehicule_Pesee'];
                                                        } else {
															echo $surcharge;
                                                           // $val_sur = abs($surcharge_ext - $result_P['surcharge_Vehicule_Pesee']);
                                                           // echo $val_sur;
                                                        }
                                                        ?>
                                                    </td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    if ($surcharge_ext < 0) {
                                                                        $_SESSION['poids_total_extreme_surcharge'] = 0;
                                                                        echo 0;
                                                                    } else {
                                                                        $_SESSION['poids_total_extreme_surcharge'] = $surcharge_ext;
                                                                        echo round($surcharge_ext);
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															
                                                            foreach ($grpe_ess as $gp_es) {
																$confimationGP = $gp_es['poids_GP'] - ($gp_es['poids_GP'] * $tolerance / 100);	
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $gp_es['nom_GP']; ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php
																		  $_SESSION['poids_total_essieux'] = $confimationGP ; 
                                                                        $_SESSION['poids_total_essieux'] = $gp_es['poids_GP'];
                                                                        echo $confimationGP ;
																		//$gp_es(['poids_GP']* (1 - $tolerance /100)) ;
                                                                        ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php echo $gp_es['poidsMax_GP']; ?>
                                                                    </td>
																	
																	 <td class="dyp">
                                                                        <?php
                                                                        
                                                                        $sur = $gp_es['poids_GP'] - $gp_es['poidsMax_GP'];
                                                            if ($sur < 0) {
                                                                echo 0;
                                                            } else {
														        $confimationGP = $gp_es['poids_GP'] - ($gp_es['poids_GP'] * $tolerance / 100);		
														        if (($confimationGP - $gp_es['poidsMax_GP']) >= 0) { 
                                                                 $sur = $confimationGP - $gp_es['poidsMax_GP'] ;
																  echo $sur;
                                                                } else   
                                                               if (($confimationGP - $gp_es['poidsMax_GP']) < 0) { 
                                                               $sur= 0;
                                                                   echo $sur;
                                                                 }                                       
                                                            }
                                                                        ?>
                                                                    </td>
                                                                
                                                                    
                                                                </tr>
                                                                <?php
                                                            }
                                                            $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                                            $info->execute();
                                                            $essieux = $info->fetch();
                                                            //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                                            $sql->execute();
                                                            $result = $sql->fetch();
                                                            $overload_axle = $result["bigest_overload_ep"];
                                                            //CALCUL
                                                             if ($result['high'] < 0) {
                                                    $_SESSION['surcharge_essieux'] = 0;
                                                } else {
                                                    $_SESSION['surcharge_essieux'] = $result['high'];
                                                }
                                                            //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",  g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');
                                                            $sql_gp->execute();
                                                            $result_gp = $sql_gp->fetch();
                                                            $overload_gp_axle = $result_gp["bigest_overload_gp"];
															//
															$sql_gp2 = $dbh->query('select  max((g."poids_GP"*(0.97))-g."poidsMax_GP") as "high_gpT",    g."nom_GP" as "bigest_overload_gp2"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gpT" desc rows 1');
										 $sql_gp2->execute();
                                        $result_gp2 = $sql_gp2->fetch();
                                        $overload_gp_axle = $result_gp2["bigest_overload_gp2"];
															
															
                                                            //CALCUL
                                                            /* if ($result_gp['high_gp'] < 0) {
                                                                $_SESSION['surcharge_gp_essieux'] = 0;
                                                            } else {
                                                                $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                                            } */
														 if ($result_gp['high_gp'] < 0) {
                                                    $_SESSION['surcharge_gp_essieux'] = 0;
                                                } else {
                                                    $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                                }
															
                                                           /* if ($result_gp['high_gp'] < 0) {
                                                                $_SESSION['surcharge_gp_essieux'] = 0;
                                                            
															} else {
														        $confimationGP = $gp_es['poids_GP'] - ($gp_es['poids_GP'] * $tolerance / 100);		
														        if (($confimationGP - $gp_es['poidsMax_GP']) >= 0) { 
                                                                 $sur = $confimationGP - $gp_es['poidsMax_GP'] ;
																  $_SESSION['surcharge_gp_essieux'] = $sur;
																  echo $sur;
                                                                } else   
                                                               if (($confimationGP - $gp_es['poidsMax_GP']) < 0) { 
                                                               $sur= 0;
															   $_SESSION['surcharge_gp_essieux'] = 0;
                                                                   echo $sur;
                                                                 }                                       
                                                            } */
                                                            ?>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $essieux['nom_EP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
																	$confimationEP = $essieux['poidsMesure_EP'] - ($essieux['poidsMesure_EP'] * $tolerance / 100) ;	
                                                                    $result['high'] = $essieux['poidsMesure_EP'] - $essieux['poidsMax_EP'];
                                                                    echo $confimationEP;
                                                                    ?>
                                                                </td>
                                                                <td style="text-align:center"><?php echo $essieux['poidsMax_EP']; ?></td>
                                                                <td style="text-align:center">
																
																
																
																<?php
																	 //$val_sur = $essieux['poidsMesure_EP'] - $essieux['poidsMax_EP'];
                                                                if ($result['high'] < 0) {
																	$_SESSION['surcharge_essieux'] = 0;
                                                                    echo 0;
                                                                } else {
														        $confimationEP = $essieux['poidsMesure_EP'] - ($essieux['poidsMesure_EP'] * $tolerance / 100) ;	
														        if (($confimationEP - $essieux['poidsMax_EP']) >= 0) { 
                                                                 $val_sur = $confimationEP - $essieux['poidsMax_EP'] ;
																 $_SESSION['surcharge_essieux'] =  $val_sur;
																  echo $val_sur;
                                                                } else   
                                                               if (($confimationEP - $essieux['poidsMax_EP']) < 0) { 
                                                                   $val_sur= 0;
                                                                   echo $val_sur;
																   $_SESSION['surcharge_essieux'] = 0;
                                                                 }                                       
                                                            }
																
                                                                    ?>
                                                                    
                                                                </td>
                                                                
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">TYPE D'INFRACTION(S)</th>
                                                                <th scope="col" colspan="2">AMENDE(S)</th>
                                                            </tr>
                                                            <?php
                                                            if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                                for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                        </td>
                                                                        <td>
                                                                            <div align="right">
                                                                                <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="3" style="text-align: center;">
                                                                        <label >
                                                                            <!--<h6>PAS DE FRAUDE </h6>-->
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <?php
                                                                if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                                    ?>
                                                                    <td colspan='2'>
                                                                        PAS DE SURCHARGE
                                                                    </td>
                                                                    <?php
																	 } else if ($pds01 < $pds  && $pds01 == 0)  {
																	?>
																	<td colspan='2'>
                                                                        PAS DE SURCHARGE
                                                                    </td>
																
																<?php	
                                                                } else if ($_SESSION['overload_mass'] != 0) {
                                                                    ?>
                                                                    <td>
                                                                        FACTURATION SUR "<?php
                                                                        //$_SESSION['overload_name'] = $_SESSION['overload_name'];
                                                                        echo $_SESSION['overload_name'];
                                                                        ?>"
                                                                    </td>
                                                                    <td align="right">
                                                                        <?php
                                                                        //$_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                                                        echo round($_SESSION['overload_mass']) . " KG";
                                                                        ?>
                                                                    </td>
                                                                    <?php
																	
																	
																	
                                                                } else {
                                                                    ?>
                                                                    <td>
                                                                        FACTURATION SUR "<?php
                                                                        $_SESSION['overload_name'] = " SURCHARGE AU PTAC";
                                                                        echo $_SESSION['overload_name'];
                                                                        ?>"
                                                                    </td>
                                                                    <td align="right">
                                                                        <?php
                                                                        $_SESSION['overload_mass'] = $_SESSION['poids_total_extreme_surcharge'];
                                                                        echo round($_SESSION['overload_mass']) . " KG";
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td align="right">
                                                                    <?php
                                                                    if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGEINT;
                                                                        if ($var < 100) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((100 <= $var) && ($var < 600)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((600 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    } else {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGENAT;
                                                                        if ($var < 100) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((100 <= $var) && ($var < 600)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((600 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">FRAIS DE PESAGE</td>
                                                                <td><div align="right">
                                                                        <?php
                                                                        /* if ($_SESSION['produit_transporte'] == "GRUME") {
                                                                          echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                          } else */ if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                            echo number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                                        } else {
                                                                            echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                        }
                                                                        ?>
                                                                    </div></td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="0" style=" margin-top:0%">
                                                           <tr>
                                                                <td style=" font-size: 100%; text-align:left; color: red"><strong>
                                                                        <?php
                                                                        $eddyk1 = "VOUS BENEFICIEZ D'UNE TOLERANCE DE $tolerance % SUR LE PTAC";
                                                                        $eddyk2 = "VOUS BENEFICIEZ D'UNE TOLERANCE DE $tolerance % SUR LE PTAC";
																		
                                                                        /* if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 120 / 100)) {
                                                                            $confimation = $_SESSION['poid_total'] - ($_SESSION['poid_total'] * $tolerance / 100);
                                                                            if (($confimation - $uemoa['seuil_surch']) >= 0) {
                                                                            echo $eddyk1;
                                                                            } else {
                                                                            echo $eddyk2;
                                                                            }
                                                                        } */
                                                                        ?>
                                                                </strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><u>Copie:</u>ORIGINAL</td>
                                                                <td>  <?php echo $_SESSION['produit_dangereux']; ?></td>
                                                                <td><div align="right"> <strong>TOTAL &Agrave; PAYER * : </strong></div></td>
                                                                <td style=" font-size: large"><div align="right"><strong><?php echo number_format($bill, 0, '', ' ') . " " . $devise; /* number_format($_SESSION['montant_a_paye'],0,'','.').' '.$devisePARAM; */ ?></strong></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Op&eacute;rateur de pesage:<?php echo $_SESSION['login_utilisateur'] ?></td>
                                                                <td>&nbsp;</td>
                                                                <!--<td><strong>TOL&Eacute;RANCE APPLIQU&Eacute;E: <?php //echo $tolerance . '%';    ?></strong></td>-->
                                                            </tr>
                                                        </table>
                                                        <table align="right" style="margin-top:1%">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td><div align="center"><strong> *PREVOIR 100 F POUR LES FRAIS DE TIMBRE D'ETAT  </strong></div></td>
                                                                
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
                                <?php
                            } else {
                                ?>
                                <div class="row second" style="margin-top: 0.5%;padding-left: 1%;padding-right: 1%; border-bottom: 2px solid #8C001A;">
                                    <table class="table table-hover table-bordered" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th>NOM CLASSE</th>
                                                <th>PDS MAX VEHICULE (Kg)</th>
                                                <th>PDS ENREGISTR&Eacute; (Kg)</th>
                                                <th>FORTE SURCHARGE (Kg)</th>
                                            </tr>
                                        </thead>
                                        <tbody style=" text-align: center;">
                                            <tr>
                                                <td>
                                                    <?php echo substr($photo_vehicule_link, 7); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $result_VP['poidsMax_VP'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $_SESSION['poids_total_vehicule'] = $result_P['poids_total_vehicule_Pesee'];
                                                    echo $result_P['poids_total_vehicule_Pesee'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $_SESSION['value_surcharge'] = $result_P['surcharge_Vehicule_Pesee'];
                                                    echo $result_P['surcharge_Vehicule_Pesee'];
                                                    ?>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                                    <div class="col-sm-3" >
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td id="silhouette">
                                                            <?php
                                                            if ($_SESSION['photo'] != '') {
                                                                ?>
                                                                <img src="<?php echo $_SESSION['photo']; ?>"/>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td style="width:15% !important;"><label class="col-sm-8 control-label" for="form-field-5">
                                                                Nº VERB
                                                            </label></td>
                                                        <td style="width:22% !important;"><input id="form-field-9" class="form-control" value="<?php echo $_SESSION['num_verb']; ?>"type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                Nº PESEE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $_SESSION['num_pesee_webafp']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                OP&Eacute;RATEUR
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php
                                                            if (!isset($_SESSION['login_utilisateur'])) {
                                                                
                                                            } else {
                                                                echo $_SESSION['login_utilisateur'];
                                                            }
                                                            ?>" type="text" placeholder="" readonly ></td>
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
                                                                TYPE VEHICULE
                                                            </label></td>
                                                        <td id="type">
                                                            <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo substr($photo_vehicule_link, 7); ?>" type="text" placeholder="" readonly >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                SOCI&Eacute;T&Eacute;/PROPRI&Eacute;TAIRE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $societe['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                IMMATRICULATION
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $immatriculation['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PROV/DEST
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $provenance['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
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
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PRODUIT
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $produit['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                NATIONALIT&Eacute;
                                                            </label></td>
                                                        <td>
                                                            <input id="form-field-1" class="form-control" name="nationalite" type="text" value="<?php echo $_SESSION['nationalite'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                EXPORTATEUR
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $_SESSION['exportateur'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                TRANSPORT
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php
                                                            if ($_SESSION['preferentiel'] != 1) {
                                                                echo $_SESSION['transport'];
                                                            } else {
                                                                echo $_SESSION['transport_affichage'];
                                                            }
                                                            ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="produit_dangeureux" value=" <?php echo $_SESSION['produit_dangereux']; ?>" style="border-style:none;color: #8C001A;"/>

                                        <div class="panel-body" >
                                            <div class="form-group">
                                                <p>
                                                <h6>INFRACTION(S)</h6>                            
                                                </p>
                                                <table width="100%" border="0">
                                                    <?php
                                                    if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                        for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                            ?>
                                                            <tr>
                                                                <td valign="top">
                                                                    <label class="checkbox-inline">
                                                                        <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                    </label>
                                                                </td>
                                                                <td valign="top">
                                                                    <h6> <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?> </h6>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td valign="top">
                                                                <label class="checkbox-inline">
                                                                    <!--<h6>PAS DE FRAUDE </h6>-->
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
                                                foreach ($grpe_ess as $gp_es) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $gp_es['nom_GP']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $gp_es['poids_GP'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $gp_es['poidsMax_GP']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            /* $sur = $gp_es['poids_GP'] - $gp_es['poidsMax_GP'];
                                                            if ($sur < 0) {
                                                                echo 0;
                                                            } else {
                                                                echo $sur;
                                                            } */
															
															
															 $sur = $gp_es['poids_GP'] - $gp_es['poidsMax_GP'];
                                                            if ($sur < 0) {
                                                                echo 0;
                                                            } else {
														        $confimationGP = $gp_es['poids_GP'] - ($gp_es['poids_GP'] * $tolerance / 100);		
														        if (($confimationGP - $gp_es['poidsMax_GP']) >= 0) { 
                                                                 $sur = $confimationGP - $gp_es['poidsMax_GP'] ;
																  echo $sur;
                                                                } else   
                                                               if (($confimationGP - $gp_es['poidsMax_GP']) < 0) { 
                                                               $sur= 0;
                                                                   echo $sur;
                                                                 }                                       
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a class="btn btn-green btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                            ENREGISTRER
                                            <i class="fa fa-check fa-white"></i>
                                        </a>
                                        <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                            ANNULER
                                            <i class="fa fa-times fa fa-white"></i>
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
                                                     */
                                                    $ess_info = $dbh->query('SELECT a."id_EP", a."id_GP", a."nom_EP", a."poidsMax_EP", a."poidsMesure_EP", a."distMinEssieu_EP", a."distMaxEssieu_EP", a."positionEssieuMesuree_EP", a."distEssieuMesuree_EP", a."vitesse_EP", a."acceleration_EP", a."erreur_EP", a.RDB$DB_KEY FROM "Essieu_Pese" a where a."id_GP"=' . $g_e['id_GP']);
                                                    $ess_info->execute();
                                                    $ess = $ess_info->fetchAll();
                                                    foreach ($ess as $es) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $es['nom_EP']; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                echo $es['poidsMesure_EP'];
                                                                ?>
                                                            </td>
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
                                        <?php
                                        $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                        $info->execute();
                                        $essieux = $info->fetch();
                                        //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                        $sql->execute();
                                        $result = $sql->fetch();
                                        $overload_axle = $result["bigest_overload_ep"];
                                        //CALCUL
                                        if ($result['high'] < 0) {
                                            $_SESSION['surcharge_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_essieux'] = $result['high'];
                                        }

                                        //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');
                                        $sql_gp->execute();
                                        $result_gp = $sql_gp->fetch();
                                        $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                        //CALCUL
                                        if ($result_gp['high_gp'] < 0) {
                                            $_SESSION['surcharge_gp_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                        }
                                        // I-CHECK IF TRANSPORT IS HYDROCARBURE OR GAZ BUTANE OR BOUTEIL DE GAZ
                                        if ($_SESSION['produit_transporte'] == "HYDROCARBURE" || $_SESSION['produit_transporte'] == "GAZ BUTANE" || $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                            //if ($_SESSION['produit_transporte'] == "HYDROCARBURE"){
                                            $_SESSION['overload_name'] = "HYDROCARBURE";
                                            /* } else if ($_SESSION['produit_transporte'] == "GAZ BUTANE"){
                                              $_SESSION['overload_name'] = "GAZ BUTANE";
                                              }else if ($_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ"){
                                              $_SESSION['overload_name'] = "BOUTEILLE DE GAZ";
                                              }else{}
                                             */

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL 
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {

                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                            //I-2-THE CONVOY IS THEN NATIONAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                        }

                                        //II-CHECK IF TRANSPORT IS GRUME
                                        else if ($_SESSION['produit_transporte'] == "GRUME") {

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_INT + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                                $_SESSION['overload_name'] = "GRUME";
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            }
                                            //I-2-THE CONVOY IS THEN NATIONAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT + $fraisPESAGENAT;
                                                $_SESSION['overload_name'] = "GRUME";
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            }
                                        }

                                        //III-THE TRANSPORT IS SET TO GLOBAL WEIGHT
                                        else if ($app_pds_ttl == 1) {
                                            $pds = $_SESSION['value_surcharge'];
                                            $_SESSION['overload_name'] = "POIDS TOTAL";
                                            $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            //III-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                //III-2-a CHECK IF OVERLOAD EXISTS
                                                if ($_SESSION['value_surcharge'] > 0) {
                                                    $fine = ($pds * $frais_ext_INT) + $fraisPESAGEINT;
                                                } else {
                                                    $fine = $fraisPESAGEINT;
                                                }
                                            } else {
                                                //III-3 THE TRANSPORT IS THEN NATIONAL
                                                //III-3-a CHECK IF OVERLOAD EXISTS
                                                if ($_SESSION['value_surcharge'] > 0) {
                                                    $fine = ($pds * $frais_ext_NAT) + $fraisPESAGENAT;
                                                } else {
                                                    $fine = $fraisPESAGENAT;
                                                    $_SESSION['overload_mass'] = 0;
                                                }
                                            }
                                        }

                                        //IV-THE TRANSPORT IS NEITHER HYDROCARBURE OR GRUME NOR GLOBAL WEIGHT SO LOGIC GOES AS NORMAL AS USUAL
                                        else {
                                            //IV-1 CHECK WHICH IS BIGGER AMONG ESSIEUX GROUP ESSIEUX AND POIDS VEHICULE
                                            if ($_SESSION['surcharge_gp_essieux'] == $_SESSION['surcharge_essieux']) {
                                                $pds = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_axle;
                                            } else if ($_SESSION['surcharge_gp_essieux'] > $_SESSION['surcharge_essieux']) {
                                                $pds = $_SESSION['surcharge_gp_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_gp_axle;
                                            } else {
                                                $pds = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_axle;
                                            }
                                            if ($_SESSION['value_surcharge'] > $pds) {
                                                $pds = $_SESSION['value_surcharge'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = "POIDS TOTAL";
                                            } else if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                $_SESSION['overload_mass'] = 0;
                                                $_SESSION['overload_name'] = "";
                                            }
                                            /*
                                              if ($_SESSION['value_surcharge'] > $_SESSION['surcharge_essieux']) {
                                              $pds = $_SESSION['value_surcharge'];
                                              $_SESSION['overload_mass'] = $pds;
                                              } else {
                                              $pds = $_SESSION['surcharge_essieux'];
                                              $_SESSION['overload_mass'] = $pds;
                                              $_SESSION['overload_name'] = $overload_axle;
                                              }
                                              if ($pds < $_SESSION['surcharge_gp_essieux']) {
                                              $pds = $_SESSION['surcharge_gp_essieux'];
                                              $_SESSION['overload_mass'] = $pds;
                                              $_SESSION['overload_name'] = $overload_gp_axle;
                                              } else {
                                              $_SESSION['overload_name'] = "POIDS TOTAL";
                                              }
                                             */
                                            //IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                //III-2-a CHECK IF OVERLOAD EXISTS
                                                //ORIGINAL ONE:=> if ($_SESSION['value_surcharge'] > 0) {
                                                if ($pds > 0) {
                                                    $fine = ($pds * $frais_ext_INT) + $fraisPESAGEINT;
                                                } else {
                                                    $fine = $fraisPESAGEINT;
                                                }
                                            } else {
                                                //IV-3 THE TRANSPORT IS THEN NATIONAL
                                                //IV-3-a CHECK IF OVERLOAD EXISTS
                                                //ORIGINAL ONE:=> if ($_SESSION['value_surcharge'] > 0) {
                                                if ($pds > 0) {
                                                    $fine = ($pds * $frais_ext_NAT) + $fraisPESAGENAT;
                                                } else {
                                                    $fine = $fraisPESAGENAT;
                                                }
                                            }
                                        }
                                        if (isset($_SESSION['infraction'])) {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine + $_SESSION['infraction'];
                                        } else {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine;
                                        }
                                        $var = substr(round($_SESSION['montant_a_paye']), -3);
                                        //echo $var;
                                        //echo '<br/>'.$_SESSION['montant_a_paye'];
                                        if ($var < 100) {
                                            $_SESSION['montant_a_paye'] = $_SESSION['montant_a_paye'] - $var;
                                        } else if ((100 <= $var) && ($var < 600)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 500;
                                        } else if ((600 <= $var) && ($var < 1000)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 1000;
                                        }
                                        ?>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td >
                                                    <input style="visibility: hidden;" type="text" list="categoryname" autocomplete="off" id="clients" name="compte_client" class="form-control" value="<?php
                                                    $_c = $_SESSION['client'];
                                                    echo $_SESSION['client'];
                                                    ?>" required>

                                                                                                                                                                                                                                                                                                                                                                   <!-- <h5 style=" color: #8C001A;"><strong>CLIENT : <?php /*
                                             $_c = $_SESSION['client'];
                                             echo $_SESSION['client']; */
                                                    ?></strong></h5>-->
                                                </td>
                                                <!--
                                                            <td>
                                                <?php
                                                /* $bills = $_SESSION['montant_a_paye'];
                                                  //EXPORTATEUR REQUEST
                                                  /* $exportateur = $conn->prepare('SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [PREFERENTIEL] = 1'); *
                                                  $exportateur = $conn->prepare("SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [SOCIETE]= '$_c' AND [SOLDE_COMPTE_CLIENT] > '$bills'");
                                                  $exportateur->execute();
                                                  $exportateur_result = $exportateur->fetchAll();
                                                 * 
                                                 */
                                                ?>
                                                                <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="compte_client" class="form-control" placeholder="Choisir le Nº de Compte..." required>
                                                                <datalist id="categoryname">
                                                <?php //foreach ($exportateur_result as $key) {        ?>
                                                                        <option value="<?php //echo rtrim($key['ID_COMPTE_CLIENT']);                         ?>"><?php // echo "Nº " . rtrim($key['ID_COMPTE_CLIENT']) . "=>" . number_format(rtrim($key['SOLDE_COMPTE_CLIENT']), 0, '', '.') . $devise;                         ?></option>
                                                <?php //}         ?>
                                                                </datalist>
                                                            </td>
                                                -->
                                                <td style="float:right;font-size: 3em;">
                                                    <h4 style=" color: red;"><strong><u>MONTANT &Agrave; PAYER:</u>&nbsp;&nbsp;<?php
                                                            $bill = $_SESSION['montant_a_paye'];
                                                            echo number_format($_SESSION['montant_a_paye'], 0, '', '.') . " " . $devise;
                                                            ?></strong></h4> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- end: PAGE -->
                                <?php
                                //BILL FOR THE RECEIPT
                                $_SESSION['bill'] = $bill;
                                ?>
                                <!-- start: BOOTSTRAP EXTENDED MODALS -->
                                <div id="receipt" class="modal fade" tabindex="-1" data-width="700">
                                    <form method="post" action="">
                                        <div class="modal-body" id ="printThis">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <div class="row" >
                                                <section   style="width:100%; margin:0 auto;font-size: 11.336px; background-image:url(assets/images/modal.png); background-repeat:no-repeat;">
                                                    <img src="assets/images/modalhead.png" id="overlay">
                                                    <div id="two">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUCTURES ECONOMIQUES 
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
                                                            <tr >
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        STATION DE PESAGE FIXE <?php echo substr($_SESSION['site'], 7); ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>
                                                                            Nº VERBALISATION : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_verb']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            Nº PES&Eacute;E : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_pesee_wim']; ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            SOCI&Eacute;T&Eacute;/PROP :
                                                                        </b>
                                                                        <?php echo $societe['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            IMMATRICULATION : 
                                                                        </b>
                                                                        <?php
                                                                        $_SESSION['immatriculation'] = $immatriculation['valeur_champs'];
                                                                        echo $immatriculation['valeur_champs'];
                                                                        ?>
                                                                        <br><br>
                                                                        <b>
                                                                            PRODUIT :   
                                                                        </b>
                                                                        <?php echo $produit['valeur_champs']; ?>


                                                                    </div>
                                                                </td>
                                                                <td>&nbsp;</td>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>DATE :</b> <?php echo date('d-m-Y H:i:s'); ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            PROV/DEST:</b> <?php echo $provenance['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>EXPORTATEUR:</b> <?php echo $_SESSION['exportateur']; ?><br><br>
                                                                        <b>
                                                                            NATIONALIT&Eacute; :
                                                                        </b>
                                                                        <?php echo $_SESSION['nationalite']; ?>

                                                                        <br><br>
                                                                        <b>
                                                                            TRANSPORT : 
                                                                        </b>
                                                                        <?php
                                                                        if ($_SESSION['preferentiel'] != 1) {
                                                                            echo $_SESSION['transport'];
                                                                        } else {
                                                                            echo $_SESSION['transport_affichage'];
                                                                        }
                                                                        ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;</td>
                                                                <td>
                                                                    <div align="center">
                                                                        <?php
                                                                        echo '<img src="qr_code.php" style="width:100px;"/>';
                                                                        ?>
                                                                        <br>
                                                                        <div align="center" id="modal-silhouette">
                                                                            <?php
                                                                            if ($photo_vehicule['silhouette'] != '') {
                                                                                ?>
                                                                                <img src="<?php echo $photo_vehicule['silhouette']; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <br>
                                                                            <?php $_SESSION['class_vehicule']; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                                <th scope="col">POIDS (KG)</th>
                                                                <th scope="col">POIDS MAX (KG)</th>
                                                                <th scope="col">SURCHARGE (KG)</th>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $_SESSION['class_vehicule']; ?></td>
                                                                <td style="text-align:center"><?php echo $result_P['poids_total_vehicule_Pesee']; ?></td>
                                                                <td style="text-align:center"><?php echo $result_VP['poidsMax_VP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    $val_sur = $result_P['surcharge_Vehicule_Pesee'];
                                                                    echo $val_sur;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            foreach ($grpe_ess as $gp_es) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $gp_es['nom_GP']; ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php
                                                                        $_SESSION['poids_total_essieux'] = $gp_es['poids_GP'];
                                                                        echo $gp_es['poids_GP'];
                                                                        ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php echo $gp_es['poidsMax_GP']; ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php
                                                                        $sur = $gp_es['poids_GP'] - $gp_es['poidsMax_GP'];
                                                            if ($sur < 0) {
                                                                echo 0;
                                                            } else {
														        $confimationGP = $gp_es['poids_GP'] - ($gp_es['poids_GP'] * $tolerance / 100);		
														        if (($confimationGP - $gp_es['poidsMax_GP']) >= 0) { 
                                                                 $sur = $confimationGP - $gp_es['poidsMax_GP'] ;
																  echo $sur;
                                                                } else   
                                                               if (($confimationGP - $gp_es['poidsMax_GP']) < 0) { 
                                                               $sur= 0;
                                                                   echo $sur;
                                                                 }                                       
                                                            }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                                            $info->execute();
                                                            $essieux = $info->fetch();
                                                            //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                                            $sql->execute();
                                                            $result = $sql->fetch();
                                                            $overload_axle = $result["bigest_overload_ep"];
                                                            //CALCUL
                                                            if ($result['high'] < 0) {
                                                                $_SESSION['surcharge_essieux'] = 0;
                                                            } else {
                                                                $_SESSION['surcharge_essieux'] = $result['high'];
                                                            }

                                                            //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');
                                                            $sql_gp->execute();
                                                            $result_gp = $sql_gp->fetch();
                                                            $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                                            //CALCUL
                                                            if ($result_gp['high_gp'] < 0) {
                                                                $_SESSION['surcharge_gp_essieux'] = 0;
                                                            } else {
                                                                $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $essieux['nom_EP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    $result['high'] = $essieux['poidsMesure_EP'] - $essieux['poidsMax_EP'];
                                                                    echo $essieux['poidsMesure_EP'];
                                                                    ?>
                                                                </td>
                                                                <td style="text-align:center"><?php echo $essieux['poidsMax_EP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                   /* if ($result['high'] < 0) {
                                                                        $_SESSION['surcharge_essieux'] = 0;
                                                                        echo 0;
                                                                     } else {
                                                                        $_SESSION['surcharge_essieux'] = $result['high'];
                                                                        echo $result['high'];
                                                                    }
                                                                    */

                                                                $val_sur = $essieux['poidsMesure_EP'] - $essieux['poidsMax_EP'];
                                                                if ($result['high'] < 0) {
																	$_SESSION['surcharge_essieux'] = 0;
                                                                    echo 0;
                                                                } else {
														        $confimationEP = $essieux['poidsMesure_EP'] - ($essieux['poidsMesure_EP'] * $tolerance / 100)	 ;	
														        if (($confimationEP - $essieux['poidsMax_EP']) >= 0) { 
                                                                 $val_sur = $confimationEP - $essieux['poidsMax_EP'] ;
																 $_SESSION['surcharge_essieux'] =  $val_sur;
																  echo $val_sur;
                                                                } else   
                                                               if (($confimationEP - $essieux['poidsMax_EP']) < 0) { 
                                                               $val_sur= 0;
                                                                   echo $val_sur;
                                                                 }                                       
                                                            }


																   ?>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">TYPE D'INFRACTION(S)</th>
                                                                <th scope="col" colspan="2">AMENDE(S)</th>
                                                            </tr>
                                                            <?php
                                                            if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                                for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                        </td>
                                                                        <td>
                                                                            <div align="right">
                                                                                <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="3" style="text-align: center;">
                                                                        <label >
                                                                            <!--<h6>PAS DE FRAUDE </h6>-->
                                                                        </label>
                                                                    </td>
                                                                </tr>

                                                            <?php } ?>
                                                            <tr>
                                                                <?php
                                                                if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                                    ?>
                                                                    <td colspan='2'>
                                                                        PAS DE SURCHARGE
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <td>
                                                                        FACTURATION SUR "<?php echo $_SESSION['overload_name']; ?>"
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td align="right">
                                                                    <?php echo round($_SESSION['overload_mass']) . " KG"; ?>
                                                                </td>
                                                                <td align="right">
                                                                    <?php
                                                                    if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGEINT;
                                                                        if ($var < 100) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((100 <= $var) && ($var < 600)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((600 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    } else {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGENAT;
                                                                        if ($var < 100) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((100 <= $var) && ($var < 600)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((600 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">FRAIS DE PESAGE</td>
                                                                <td><div align="right">
                                                                        <?php
                                                                        /* if ($_SESSION['produit_transporte'] == "GRUME") {
                                                                          echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                          } else */if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                            echo number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                                        } else {
                                                                            echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                        }
                                                                        ?>
                                                                    </div></td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="0" style=" margin-top:1%">
                                                            <tr>
                                                                <td><u>Copie:</u>ORIGINAL</td>
                                                                <td>  <?php echo $_SESSION['produit_dangereux']; ?></td>
                                                                <td><div align="right">TOTAL &Agrave; PAYER *:</div></td>
                                                                <td  style=" font-size: large"><div align="right"><strong><?php echo number_format($bill, 0, '', '.') . " " . $devise; /* number_format($_SESSION['montant_a_paye'],0,'','.').' '.$devisePARAM; */ ?></strong></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Op&eacute;rateur de pesage: <?php echo $_SESSION['login_utilisateur'] ?></td>
                                                                <!--<td><strong>TOL&Eacute;RANCE APPLIQU&Eacute;E: <?php //echo $tolerance . '%';    ?></strong></td>-->
                                                            </tr>
                                                        </table>
                                                        <table align="right" style="margin-top:1%">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                               <td><div align="center"><strong> *PREVOIR 100 F POUR LES FRAIS DE TIMBRE D'ETAT  </strong></div></td>
                                                                <td><div align="left"><?php echo date('d-m-Y H:i:s'); ?></div></td>
                                                            </tr>
                                                        </table>
                                                        <?php
                                                        if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 120 / 100)) {
                                                            ?>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td><div align="center"><strong>
                                                                                <?php
                                                                                $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                                                $warning_fine_nat = ($surcharge_ext * $AmendeExtremeSurNat) + $fraisPESAGENAT;
                                                                                $warning_fine_int = ($surcharge_ext * $AmendeExtremeSurInt) + $fraisPESAGEINT;
                                                                                ?>
                                                                                <strong style="color:#861D20">
                                                                                    ****************************************************************************************************************************************************************************<br>
                                                                                    ATTENTION!! VOUS ETES EN EXTREME SURCHARGE DE  <strong style=" font-size: medium"><?php echo number_format($surcharge_ext, 0, '', '.') . "KG"; ?></strong> VOUS SEREZ BIENTOT FACTUR&Eacute; &Agrave; <strong style="font-size:medium;"> <?php
                                                                                        if ($_SESSION['transport'] != "INTERNATIONAL") {
                                                                                            echo number_format($warning_fine_nat, 0, '', '.') . " " . $devise;
                                                                                        } else {
                                                                                            echo number_format($warning_fine_int, 0, '', '.') . " " . $devise;
                                                                                        }
                                                                                        ?> </strong> 
                                                                                    <br>****************************************************************************************************************************************************************************</strong>

                                                                            </strong></div></td>
                                                                </tr>
                                                            </table>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <table width="100%" border="1" style="margin-top:1%">
                                                                <tr>
                                                                    <td><div align="center"><strong>AFRIQUE PESAGE SA | Site web : www.afriquepesage.com | TEL: +225 21 35 35 20/+225 21 35 64 47</strong></div></td>
                                                                </tr>
                                                            </table>
                                                            <?php
                                                        }
                                                        ?>
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
                                <?php
                            }
                        } else {
                            //EXTREME OVERLOAD IS TAKEN INTO ACCOUNT
                            if ($app_ext_sur == 1) {
                                $surcharge = 0;
                                $surcharge_ext = 0;
                                $frais_ext_NAT = $AmendeExtremeSurNat;
                                $frais_ext_INT = $AmendeExtremeSurInt;
                                $frais_ext_NAT01 = $INFPoidsTotalsAmNAT;
                                $frais_ext_INT01 = $INFPoidsTotalsAmINT;
                                if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                    $surcharge = 0;
                                    $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                } else
                                if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                    $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                    $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                } else
                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                    $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                    $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                                }
                                ?>
                                <div class="row second" style="margin-top: 0.5%;padding-left: 1%;padding-right: 1%; border-bottom: 2px solid #8C001A;">
                                    <table class="table table-hover table-bordered" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th>NOM CLASSE</th>
                                                <th>PTAC UEMOA (Kg)</th>
                                                <th>PTAC UEMOA 20% (Kg)</th>
                                                <th>PTAC UEMOA 40%(Kg)</th>
                                                <th>PDS DU VEHICULE (Kg)</th>
                                                <th>PDS EXC&Eacute;DENT (Kg)</th>                                                
                                                <th>EXTR&Egrave;ME SURCHARGE (Kg)</th>
                                                <th>FORTE SURCHARGE (Kg)</th>
                                            </tr>
                                        </thead>
                                        <tbody style=" text-align: center;">
                                            <tr>
                                                <td>
                                                    <?php echo substr($photo_vehicule_link, 7); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $_SESSION['ptac'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $result_VP['poidsMax_VP'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $uemoa['seuil_ext_surc']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo round($result_P['poids_total_vehicule_Pesee']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo round($result_P['surcharge_Vehicule_Pesee']);
                                                    ?>
                                                </td>                                                
                                                <td style="color:<?php switchColor($surcharge_ext) ?>; font-size:<?php switchFont($surcharge_ext) ?>">
                                                    <?php
                                                    echo round($surcharge_ext);
                                                    ?>
                                                </td>
                                                <td style="color:<?php color($surcharge) ?>; font-size:<?php font($surcharge) ?>">
                                                    <?php
                                                    echo round($surcharge);
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                                    <div class="col-sm-3" >
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td id="silhouette">
                                                            <?php
                                                            if ($_SESSION['photo'] != '') {
                                                                ?>
                                                                <img src="<?php echo $_SESSION['photo']; ?>"/>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td style="width:15% !important;"><label class="col-sm-8 control-label" for="form-field-5">
                                                                Nº VERB 
                                                            </label></td>
                                                        <td style="width:22% !important;"><input id="form-field-9" class="form-control" value="<?php echo $_SESSION['num_verb']; ?>"type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                Nº PESEE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $_SESSION['num_pesee_webafp']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                OP&Eacute;RATEUR
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php
                                                            if (!isset($_SESSION['login_utilisateur'])) {
                                                                
                                                            } else {
                                                                echo $_SESSION['login_utilisateur'];
                                                            }
                                                            ?>" type="text" placeholder="" readonly ></td>
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
                                                                TYPE VEHICULE
                                                            </label></td>
                                                        <td id="type">
                                                            <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo substr($photo_vehicule_link, 7); ?>" type="text" placeholder="" readonly >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                SOCI&Eacute;T&Eacute;/PROPRI&Eacute;TAIRE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $societe['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                IMMATRICULATION
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $immatriculation['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PROV/DEST
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $provenance['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
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
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PRODUIT
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $produit['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                NATIONALIT&Eacute;
                                                            </label></td>
                                                        <td>
                                                            <input id="form-field-1" class="form-control" name="nationalite" type="text" value="<?php echo $_SESSION['nationalite'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                EXPORTATEUR
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $_SESSION['exportateur'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                TRANSPORT
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php
                                                            if ($_SESSION['preferentiel'] != 1) {
                                                                echo $_SESSION['transport'];
                                                            } else {
                                                                echo $_SESSION['transport_affichage'];
                                                            }
                                                            ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="produit_dangeureux" value=" <?php echo $_SESSION['produit_dangereux']; ?>" style="border-style:none;color: #8C001A;"/>
                                        <div class="panel-body" >
                                            <div class="form-group">
                                                <p>
                                                <h6>INFRACTION(S)</h6>                            
                                                </p>
                                                <table width="100%" border="0">
                                                    <?php
                                                    if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                        for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                            ?>
                                                            <tr>
                                                                <td valign="top">
                                                                    <label class="checkbox-inline">
                                                                        <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                    </label>
                                                                </td>
                                                                <td valign="top">
                                                                    <h6> <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?> </h6>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td valign="top">
                                                                <label class="checkbox-inline">
                                                                    <!--<h6>PAS DE FRAUDE </h6>-->
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
                                                    <th>FORTE SURCHARGE (Kg)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($grpe_ess as $gp_es) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $gp_es['nom_GP']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $gp_es['poids_GP'] = ($gp_es['poids_GP'] - (($gp_es['poids_GP'] * $tolerance) / 100));
                                                            echo $gp_es['poids_GP'];
                                                            ?>
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
                                        <a class="btn btn-green btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                            ENREGISTRER
                                            <i class="fa fa-check fa-white"></i>
                                        </a>
                                        <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                            ANNULER
                                            <i class="fa fa-times fa fa-white"></i>
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
                                                    <th>FORTE SURCHARGE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($grpe_ess as $g_e) {
                                                    /*
                                                     * Get  Essieux infos
                                                     * Recuperer les infos des Essieux
                                                     */
                                                    $ess_info = $dbh->query('SELECT a."id_EP", a."id_GP", a."nom_EP", a."poidsMax_EP", a."poidsMesure_EP", a."distMinEssieu_EP", a."distMaxEssieu_EP", a."positionEssieuMesuree_EP", a."distEssieuMesuree_EP", a."vitesse_EP", a."acceleration_EP", a."erreur_EP", a.RDB$DB_KEY FROM "Essieu_Pese" a where a."id_GP"=' . $g_e['id_GP']);
                                                    $ess_info->execute();
                                                    $ess = $ess_info->fetchAll();
                                                    foreach ($ess as $es) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $es['nom_EP']; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $es['poidsMesure_EP'] = ($es['poidsMesure_EP'] - (($es['poidsMesure_EP'] * $tolerance) / 100));
                                                                echo $es['poidsMesure_EP'];
                                                                ?>
                                                            </td>
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
                                        <?php
                                        $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                        $info->execute();
                                        $essieux = $info->fetch();
                                        //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."poidsMesure_EP" as "EP" ,e."poidsMax_EP" as "EP_MAX" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP" order by "high" desc rows 1');
                                        $sql->execute();
                                        $result = $sql->fetch();
                                        $overload_axle = $result["bigest_overload_ep"];
                                        //CALCUL
                                        $result['EP'] = ($result['EP'] - (($result['EP'] * $tolerance) / 100)) - $result['EP_MAX'];

                                        if ($result['high'] < 0) {
                                            $_SESSION['surcharge_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_essieux'] = $result['EP'];
                                        }
                                        //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."poids_GP" as "GP" ,g."poidsMax_GP" as "GP_MAX" ,g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP",g."poids_GP" ,g."poidsMax_GP" order by "high_gp" desc rows 1');
                                        $sql_gp->execute();
                                        $result_gp = $sql_gp->fetch();
                                        $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                        //CALCUL
                                        $result_gp['GP'] = ($result_gp['GP'] - (($result_gp['GP'] * $tolerance) / 100)) - $result_gp['GP_MAX'];

                                        if ($result_gp['high_gp'] < 0) {
                                            $_SESSION['surcharge_gp_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_gp_essieux'] = $result_gp['GP'];
                                        }
                                        // I-CHECK IF TRANSPORT IS HYDROCARBURE OR GAZ BUTANE OR BOUTEIL DE GAZ
                                        if ($_SESSION['produit_transporte'] == "HYDROCARBURE" || $_SESSION['produit_transporte'] == "GAZ BUTANE" || $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                            //if ($_SESSION['produit_transporte'] == "HYDROCARBURE"){
                                            $_SESSION['overload_name'] = "HYDROCARBURE";
                                            /* } else if ($_SESSION['produit_transporte'] == "GAZ BUTANE"){
                                              $_SESSION['overload_name'] = "GAZ BUTANE";
                                              }else if ($_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ"){
                                              $_SESSION['overload_name'] = "BOUTEILLE DE GAZ";
                                              }else{}
                                             */

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL 
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {

                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                } else {
                                                    $fine = $fine + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                }
                                            }
                                            //I-2-CHECK IF THE CONVOY IS NATIONAL
                                            else if ($_SESSION['transport'] == "NATIONAL") {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                            //I-3-THE CONVOY IS THEN PREFERENTIAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                        }

                                        //II-CHECK IF TRANSPORT IS GRUME
                                        else if ($_SESSION['produit_transporte'] == "GRUME") {
                                            $_SESSION['overload_name'] = "GRUME";
                                            if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            } else {
                                                $_SESSION['overload_mass'] = $_SESSION['value_extreme_surcharge'];
                                                $_SESSION['value_surcharge'] = $_SESSION['value_extreme_surcharge'];
                                            }

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {

                                                if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                    $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                } else {
                                                    $fine = $_SESSION['value_surcharge'] * $frais_ext_INT + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                }
                                            }
                                            //I-2-CHECK IF THE CONVOY IS NATIONAL
                                            else if ($_SESSION['transport'] == "NATIONAL") {
                                                if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                    $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                } else {
                                                    $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                }
                                            }
                                            //I-3-THE CONVOY IS THEN PREFERENTIAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT + $fraisPESAGENAT;
                                            }
                                        }
                                        //III-THE TRANSPORT IS SET TO GLOBAL WEIGHT
                                        else if ($app_pds_ttl == 1) {
                                            $_SESSION['overload_name'] = "POIDS TOTAL";
                                            $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            $pds = $_SESSION['value_surcharge'];
                                            //III-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                //III-2-a CHECK IF TOTAL WEIGHT IS LESSER THAN (PTAC * 1.2)
                                                if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                                    $fine = $fraisPESAGEINT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.2) AND LESSER THAN (PTAC * 1.4)
                                                else
                                                if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                    $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                    $_SESSION['value_surcharge'] = $surcharge;
                                                    $fine = ($surcharge * $frais_ext_INT01) + $fraisPESAGEINT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                                else
                                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                    $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                    $_SESSION['value_surcharge'] = $surcharge_ext;
                                                    $fine = ($surcharge_ext * $frais_ext_INT) + $fraisPESAGEINT;
                                                }
                                            }
                                            //III-3 CHECK IF TRANSPORT IS NATIONAL
                                            else if ($_SESSION['transport'] == "NATIONAL") {
                                                //III-3-a CHECK IF TOTAL WEIGHT IS LESSER THAN (PTAC * 1.2)
                                                if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                                    $fine = $fraisPESAGENAT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.2) AND LESSER THAN (PTAC * 1.4)
                                                else
                                                if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                    $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                    $_SESSION['value_surcharge'] = $surcharge;
                                                    $fine = ($surcharge * $frais_ext_NAT01) + $fraisPESAGENAT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                                else
                                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                    $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                    $_SESSION['value_surcharge'] = $surcharge_ext;
                                                    $fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;
                                                }
                                            }
                                            //III-4 THE TRANSPORT IS THEN PREFERENTIAL
                                            else {
                                                if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                    $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                    $_SESSION['value_surcharge'] = $surcharge;
                                                    $fine = ($surcharge * $frais_ext_NAT01) + $fraisPESAGENAT;
                                                }
                                                //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                                else
                                                if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                    $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                    $_SESSION['value_surcharge'] = $surcharge_ext;
                                                    $fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;
                                                }
                                            }
                                        }
                                        //IV-THE TRANSPORT IS NEITHER HYDROCARBURE OR GRUME NOR SET TO GLOBAL WEIGHT SO LOGIC GOES AS NORMAL AS USUAL
                                        else {
                                            //IV-1 CHECK WHICH IS BIGGER AMONG ESSIEUX GROUP ESSIEUX AND POIDS VEHICULE
                                            if ($_SESSION['surcharge_gp_essieux'] == $_SESSION['surcharge_essieux']) {
                                                $pds = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_axle;
                                            } else if ($_SESSION['surcharge_gp_essieux'] > $_SESSION['surcharge_essieux']) {
                                                $pds = $_SESSION['surcharge_gp_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_gp_axle;
                                            } else {
                                                $pds = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_axle;
                                            }
                                            if ($_SESSION['value_surcharge'] > $pds) {
                                                $pds = $_SESSION['value_surcharge'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = "POIDS TOTAL";
                                            } else if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                $_SESSION['overload_mass'] = 0;
                                                $_SESSION['overload_name'] = "";
                                            }
                                            /*
                                              if ($_SESSION['value_surcharge'] > $_SESSION['surcharge_essieux']) {
                                              $pds = $_SESSION['value_surcharge'];
                                              $_SESSION['overload_name'] = "POIDS TOTAL";
                                              $_SESSION['overload_mass'] = $pds;
                                              } else {
                                              $pds = $_SESSION['surcharge_essieux'];
                                              $_SESSION['overload_mass'] = $pds;
                                              $_SESSION['overload_name'] = $overload_axle;
                                              }
                                              if ($pds < $_SESSION['surcharge_gp_essieux']) {
                                              $pds = $_SESSION['surcharge_gp_essieux'];
                                              $_SESSION['overload_mass'] = $pds;
                                              $_SESSION['overload_name'] = $overload_gp_axle;
                                              } else {
                                              $_SESSION['overload_name'] = "POIDS TOTAL";
                                              $_SESSION['overload_mass'] = $pds;
                                              }
                                             */
                                            //IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                //III-2-a CHECK IF EXTREME OVERLOAD EXISTS
                                                if ($_SESSION['value_extreme_surcharge'] > 0) {
                                                    //$fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurInt) + ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                                    $fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurInt) + $fraisPESAGEINT;
                                                } else {
                                                    //III-2-b CHECK IF OVERLOAD EXISTS
                                                    if ($_SESSION['overload_mass'] > 0) {
                                                        //if ($pds > 0) {
                                                        $fine = ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                                    } else {
                                                        $fine = $fraisPESAGEINT;
                                                    }
                                                }
                                            }
                                            //IV-3 CHECK IF TRANSPORT IS NATIONAL
                                            else if ($_SESSION['transport'] == "NATIONAL") {
                                                if ($_SESSION['value_extreme_surcharge'] > 0) {
                                                    $fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurNat) + $fraisPESAGENAT;
                                                } else {
                                                    //III-2-c CHECK IF OVERLOAD EXISTS
                                                    if ($_SESSION['overload_mass'] > 0) {
                                                        //if ($pds > 0) {
                                                        $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                                    } else {
                                                        $fine = $fraisPESAGENAT;
                                                    }
                                                }
                                            }
                                            //IV-3 THE TRANSPORT IS THEN PREFERENTIAL
                                            else {
                                                if ($_SESSION['value_extreme_surcharge'] > 0) {
                                                    $fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurNat) + $fraisPESAGENAT;
                                                } else {
                                                    //III-2-c CHECK IF OVERLOAD EXISTS
                                                    if ($_SESSION['overload_mass'] > 0) {
                                                        //if ($pds > 0) {
                                                        $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                                    } else {
                                                        $fine = $fraisPESAGENAT;
                                                    }
                                                }
                                            }
                                        }

                                        if (isset($_SESSION['infraction'])) {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine + $_SESSION['infraction'];
                                        } else {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine;
                                        }
                                        $var = substr(round($_SESSION['montant_a_paye']), -3);
                                        //echo $var;
                                        //echo '<br/>'.$_SESSION['montant_a_paye'];
                                        if ($var < 250) {
                                            $_SESSION['montant_a_paye'] = $_SESSION['montant_a_paye'] - $var;
                                        } else if ((250 <= $var) && ($var < 750)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 500;
                                        } else if ((750 <= $var) && ($var < 1000)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 1000;
                                        }
                                        ?>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td >
                                                    <input style="visibility: hidden;" type="text" list="categoryname" autocomplete="off" id="clients" name="compte_client" class="form-control" value="<?php
                                                    $_c = $_SESSION['client'];
                                                    echo $_SESSION['client'];
                                                    ?>" required>

                                                                                                                                                                                                                                                                                                                                                                                                                               <!-- <h5 style=" color: #8C001A;"><strong>CLIENT : <?php /*
                                             $_c = $_SESSION['client'];
                                             echo $_SESSION['client']; */
                                                    ?></strong></h5>-->
                                                </td>
                                                <!--
                                                <td>
                                                <?php
                                                /* $bills = $_SESSION['montant_a_paye'];
                                                  //EXPORTATEUR REQUEST
                                                  /* $exportateur = $conn->prepare('SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [PREFERENTIEL] = 1'); *
                                                  $exportateur = $conn->prepare("SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [SOCIETE]= '$_c' AND [SOLDE_COMPTE_CLIENT] > '$bills'");
                                                  $exportateur->execute();
                                                  $exportateur_result = $exportateur->fetchAll();
                                                 * 
                                                 */
                                                ?>
                                                    <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="compte_client" class="form-control" placeholder="Choisir le Nº de Compte..." required>
                                                    <datalist id="categoryname">
                                                <?php //foreach ($exportateur_result as $key) {        ?>
                                                            <option value="<?php //echo rtrim($key['ID_COMPTE_CLIENT']);                              ?>"><?php // echo "Nº " . rtrim($key['ID_COMPTE_CLIENT']) . "=>" . number_format(rtrim($key['SOLDE_COMPTE_CLIENT']), 0, '', '.') . $devise;                              ?></option>
                                                <?php //}         ?>
                                                    </datalist>
                                                </td>
                                                -->
                                                <td style="float:right;font-size: 3em;">
                                                    <h4 style=" color: red;"><strong><u>MONTANT &Agrave; PAYER:</u>&nbsp;&nbsp;<?php
                                                            $bill = $_SESSION['montant_a_paye'];
                                                            echo number_format($_SESSION['montant_a_paye'], 0, '', '.') . " " . $devise;
                                                            ?></strong></h4> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- end: FOOTER -->
                                <!-- end: PAGE CONTENT-->

                                <!-- end: PAGE -->
                                <?php
                                //BILL FOR THE RECEIPT
                                $_SESSION['bill'] = $bill;
                                ?>
                                <!-- start: BOOTSTRAP EXTENDED MODALS -->
                                <div id="receipt" class="modal fade" tabindex="-1" data-width="700">
                                    <form method="post" action="">
                                        <div class="modal-body" id ="printThis">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <div class="row" >
                                                <section   style="width:100%; margin:0 auto;font-size: 11.336px; background-image:url(assets/images/modal.png); background-repeat:no-repeat;">
                                                    <img src="assets/images/modalhead.png" id="overlay">
                                                    <div id="two">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUCTURES ECONOMIQUES
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
                                                            <tr >
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        STATION DE PESAGE FIXE <?php echo substr($_SESSION['site'], 7); ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>
                                                                            Nº VERBALISATION : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_verb']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            Nº PES&Eacute;E : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_pesee_wim']; ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            SOCI&Eacute;T&Eacute;/PROP :
                                                                        </b>
                                                                        <?php echo $societe['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            IMMATRICULATION : 
                                                                        </b>
                                                                        <?php
                                                                        $_SESSION['immatriculation'] = $immatriculation['valeur_champs'];
                                                                        echo $immatriculation['valeur_champs'];
                                                                        ?>
                                                                        <br><br>
                                                                        <b>
                                                                            PRODUIT :   
                                                                        </b>
                                                                        <?php echo $produit['valeur_champs']; ?>


                                                                    </div>
                                                                </td>
                                                                <td>&nbsp;</td>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>DATE :</b> <?php echo date('d-m-Y H:i:s'); ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            PROV/DEST:</b> <?php echo $provenance['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>EXPORTATEUR:</b> <?php echo $_SESSION['exportateur']; ?><br><br>
                                                                        <b>
                                                                            NATIONALIT&Eacute; :
                                                                        </b>
                                                                        <?php echo $_SESSION['nationalite']; ?>

                                                                        <br><br>
                                                                        <b>
                                                                            TRANSPORT : 
                                                                        </b>
                                                                        <?php
                                                                        if ($_SESSION['preferentiel'] != 1) {
                                                                            echo $_SESSION['transport'];
                                                                        } else {
                                                                            echo $_SESSION['transport_affichage'];
                                                                        }
                                                                        ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;</td>
                                                                <td>
                                                                    <div align="center">
                                                                        <?php
                                                                        echo '<img src="qr_code.php" style="width:100px;"/>';
                                                                        ?>
                                                                        <br>
                                                                        <div align="center" id="modal-silhouette">
                                                                            <?php
                                                                            if ($photo_vehicule['silhouette'] != '') {
                                                                                ?>
                                                                                <img src="<?php echo $photo_vehicule['silhouette']; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <br>
                                                                            <?php $_SESSION['class_vehicule']; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                                <th scope="col">POIDS (KG)</th>
                                                                <th scope="col">POIDS MAX (KG)</th>
                                                                <th scope="col">FORTE SURCHARGE (KG)</th>
                                                                <th scope="col">EXTREME SURCHARGE (KG)</th>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $_SESSION['class_vehicule']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    echo round($result_P['poids_total_vehicule_Pesee']);
                                                                    ?>
                                                                </td>
                                                                <td style="text-align:center"><?php echo $result_VP['poidsMax_VP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    //$result_P['surcharge_Vehicule_Pesee'] = ($result_P['surcharge_Vehicule_Pesee']-(($result_P['surcharge_Vehicule_Pesee']*$tolerance)/100));
                                                                    if ($surcharge_ext < 0) {
                                                                        echo round($result_P['surcharge_Vehicule_Pesee']);
                                                                    } else {
                                                                        echo round($result_P['surcharge_Vehicule_Pesee']);
                                                                        // $val_sur = abs($surcharge_ext - $result_P['surcharge_Vehicule_Pesee']);
                                                                        // echo $val_sur;
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    if ($surcharge_ext < 0) {
                                                                        $_SESSION['poids_total_extreme_surcharge'] = 0;
                                                                        echo 0;
                                                                    } else {
                                                                        $_SESSION['poids_total_extreme_surcharge'] = $surcharge_ext;
                                                                        echo round($surcharge_ext);
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            foreach ($grpe_ess as $gp_es) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $gp_es['nom_GP']; ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php
                                                                        $gp_es['poids_GP'] = ($gp_es['poids_GP'] - (($gp_es['poids_GP'] * $tolerance) / 100));
                                                                        $_SESSION['poids_total_essieux'] = $gp_es['poids_GP'];
                                                                        echo $gp_es['poids_GP'];
                                                                        ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php echo $gp_es['poidsMax_GP']; ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php
                                                                        $sur = $gp_es['poids_GP'] - $gp_es['poidsMax_GP'];
                                                                        if ($sur < 0) {
                                                                            echo 0;
                                                                        } else {
                                                                            echo $sur;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td style="background-color: #EEEEEE">&nbsp;</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                                            $info->execute();
                                                            $essieux = $info->fetch();
                                                            //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."poidsMesure_EP" as "EP" ,e."poidsMax_EP" as "EP_MAX" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP" order by "high" desc rows 1');
                                                            $sql->execute();
                                                            $result = $sql->fetch();
                                                            $overload_axle = $result["bigest_overload_ep"];
                                                            //CALCUL
                                                            $result['EP'] = ($result['EP'] - (($result['EP'] * $tolerance) / 100)) - $result['EP_MAX'];

                                                            if ($result['high'] < 0) {
                                                                $_SESSION['surcharge_essieux'] = 0;
                                                            } else {
                                                                $_SESSION['surcharge_essieux'] = $result['EP'];
                                                            }
                                                            //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."poids_GP" as "GP" ,g."poidsMax_GP" as "GP_MAX" ,g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP",g."poids_GP" ,g."poidsMax_GP" order by "high_gp" desc rows 1');
                                                            $sql_gp->execute();
                                                            $result_gp = $sql_gp->fetch();
                                                            $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                                            //CALCUL
                                                            $result_gp['GP'] = ($result_gp['GP'] - (($result_gp['GP'] * $tolerance) / 100)) - $result_gp['GP_MAX'];

                                                            if ($result_gp['high_gp'] < 0) {
                                                                $_SESSION['surcharge_gp_essieux'] = 0;
                                                            } else {
                                                                $_SESSION['surcharge_gp_essieux'] = $result_gp['GP'];
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $essieux['nom_EP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    $essieux['poidsMesure_EP'] = ($essieux['poidsMesure_EP'] - (($essieux['poidsMesure_EP'] * $tolerance) / 100));
                                                                    $result['high'] = $essieux['poidsMesure_EP'] - $essieux['poidsMax_EP'];
                                                                    echo $essieux['poidsMesure_EP'];
                                                                    ?>
                                                                </td>
                                                                <td style="text-align:center"><?php echo $essieux['poidsMax_EP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    if ($result['high'] < 0) {
                                                                        $_SESSION['surcharge_essieux'] = 0;
                                                                        echo 0;
                                                                    } else {
                                                                        $_SESSION['surcharge_essieux'] = $result['high'];
                                                                        echo $result['high'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td style="background-color: #EEEEEE">&nbsp;</td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">TYPE D'INFRACTION(S)</th>
                                                                <th scope="col" colspan="2">AMENDE(S)</th>
                                                            </tr>
                                                            <?php
                                                            if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                                for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                        </td>
                                                                        <td>
                                                                            <div align="right">
                                                                                <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="3" style="text-align: center;">
                                                                        <label >
                                                                            <!--<h6>PAS DE FRAUDE </h6>-->
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <?php
                                                                if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                                    ?>
                                                                    <td colspan='2'>
                                                                        PAS DE SURCHARGE
                                                                    </td>
                                                                    <?php
                                                                } else if ($_SESSION['overload_mass'] != 0 && $_SESSION['poids_total_extreme_surcharge'] == 0) {
                                                                    ?>
                                                                    <td>
                                                                        FACTURATION SUR "<?php
                                                                        //$_SESSION['overload_name'] = $_SESSION['overload_name'];
                                                                        echo $_SESSION['overload_name'];
                                                                        ?>"
                                                                    </td>
                                                                    <td align="right">
                                                                        <?php
                                                                        //$_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                                                        echo round($_SESSION['overload_mass']) . " KG";
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <td>
                                                                        FACTURATION SUR "<?php
                                                                        $_SESSION['overload_name'] = "EXTREME SURCHARGE AU PTAC";
                                                                        echo $_SESSION['overload_name'];
                                                                        ?>"
                                                                    </td>
                                                                    <td align="right">
                                                                        <?php
                                                                        $_SESSION['overload_mass'] = $_SESSION['poids_total_extreme_surcharge'];
                                                                        echo round($_SESSION['overload_mass']) . " KG";
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td align="right">
                                                                    <?php
                                                                    if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGEINT;
                                                                        if ($var < 250) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((250 <= $var) && ($var < 750)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((750 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    } else {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGENAT;
                                                                        if ($var < 250) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((250 <= $var) && ($var < 750)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((750 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">FRAIS DE PESAGE</td>
                                                                <td><div align="right">
                                                                        <?php
                                                                        /* if ($_SESSION['produit_transporte'] == "GRUME") {
                                                                          echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                          } else */ if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                            echo number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                                        } else {
                                                                            echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                        }
                                                                        ?>
                                                                    </div></td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="0" style=" margin-top:2%">
                                                            <tr>
                                                                <td><u>Copie:</u>ORIGINAL</td>
                                                                <td>  <?php echo $_SESSION['produit_dangereux']; ?></td>
                                                                <td><div align="right">TOTAL &Agrave; PAYER * :</div></td>
                                                                <td style=" font-size: large"><div align="right"><strong><?php echo number_format($bill, 0, '', ' ') . " " . $devise; /* number_format($_SESSION['montant_a_paye'],0,'','.').' '.$devisePARAM; */ ?></strong></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Op&eacute;rateur de pesage:<?php echo $_SESSION['login_utilisateur'] ?></td>
                                                                <td>&nbsp;</td>
                                                                <!--<td><strong>TOL&Eacute;RANCE APPLIQU&Eacute;E: <?php //echo $tolerance . '%';    ?></strong></td>-->
                                                            </tr>
                                                        </table>
                                                        <table align="right" style="margin-top:1%">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td><div align="center"><strong> *PREVOIR 100 F POUR LES FRAIS DE TIMBRE D'ETAT  </strong></div></td>
                                                                <td><div  align="left"><?php echo date('d-m-Y H:i:s'); ?></div></td>
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
                                <?php
                            } else {
                                ?>
                                <div class="row second" style="margin-top: 0.5%;padding-left: 1%;padding-right: 1%; border-bottom: 2px solid #8C001A;">
                                    <table class="table table-hover table-bordered" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th>NOM CLASSE</th>
                                                <th>PDS MAX VEHICULE (Kg)</th>
                                                <th>PDS ENREGISTR&Eacute; (Kg)</th>
                                                <th>FORTE SURCHARGE (Kg)</th>
                                            </tr>
                                        </thead>
                                        <tbody style=" text-align: center;">
                                            <tr>
                                                <td>
                                                    <?php echo substr($photo_vehicule_link, 7); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $result_VP['poidsMax_VP'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $result_P['poids_total_vehicule_Pesee'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $result_P['surcharge_Vehicule_Pesee'];
                                                    ?>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                                    <div class="col-sm-3" >
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td id="silhouette">
                                                            <?php
                                                            if ($_SESSION['photo'] != '') {
                                                                ?>
                                                                <img src="<?php echo $_SESSION['photo']; ?>"/>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td style="width:15% !important;"><label class="col-sm-8 control-label" for="form-field-5">
                                                                Nº VERB
                                                            </label></td>
                                                        <td style="width:22% !important;"><input id="form-field-9" class="form-control" value="<?php echo $_SESSION['num_verb']; ?>"type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                Nº PESEE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $_SESSION['num_pesee_webafp']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                OP&Eacute;RATEUR
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php
                                                            if (!isset($_SESSION['login_utilisateur'])) {
                                                                
                                                            } else {
                                                                echo $_SESSION['login_utilisateur'];
                                                            }
                                                            ?>" type="text" placeholder="" readonly ></td>
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
                                                                TYPE VEHICULE
                                                            </label></td>
                                                        <td id="type">
                                                            <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo substr($photo_vehicule_link, 7); ?>" type="text" placeholder="" readonly >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                SOCI&Eacute;T&Eacute;/PROPRI&Eacute;TAIRE
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $societe['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                IMMATRICULATION
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $immatriculation['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PROV/DEST
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $provenance['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
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
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                PRODUIT
                                                            </label></td>
                                                        <td><input id="form-field-1" class="form-control" value="<?php echo $produit['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                NATIONALIT&Eacute;
                                                            </label></td>
                                                        <td>
                                                            <input id="form-field-1" class="form-control" name="nationalite" type="text" value="<?php echo $_SESSION['nationalite'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                EXPORTATEUR
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $_SESSION['exportateur'] ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label class="col-sm-10 control-label" for="form-field-5">
                                                                TRANSPORT
                                                            </label></td>
                                                        <td>                                                        
                                                            <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php
                                                            if ($_SESSION['preferentiel'] != 1) {
                                                                echo $_SESSION['transport'];
                                                            } else {
                                                                echo $_SESSION['transport_affichage'];
                                                            }
                                                            ?>" placeholder=""  readonly />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="produit_dangeureux" value=" <?php echo $_SESSION['produit_dangereux']; ?>" style="border-style:none;color: #8C001A;"/>

                                        <div class="panel-body" >
                                            <div class="form-group">
                                                <p>
                                                <h6>INFRACTION(S)</h6>                            
                                                </p>
                                                <table width="100%" border="0">
                                                    <?php
                                                    if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                        for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                            ?>
                                                            <tr>
                                                                <td valign="top">
                                                                    <label class="checkbox-inline">
                                                                        <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                    </label>
                                                                </td>
                                                                <td valign="top">
                                                                    <h6> <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?> </h6>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td valign="top">
                                                                <label class="checkbox-inline">
                                                                    <!--<h6>PAS DE FRAUDE </h6>-->
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
                                                    <th>FORTE SURCHARGE (Kg)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($grpe_ess as $gp_es) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $gp_es['nom_GP']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $gp_es['poids_GP'] = ($gp_es['poids_GP'] - (($gp_es['poids_GP'] * $tolerance) / 100));
                                                            echo $gp_es['poids_GP'];
                                                            ?>
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
                                        <a class="btn btn-green btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                            ENREGISTRER
                                            <i class="fa fa-check fa-white"></i>
                                        </a>
                                        <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                            ANNULER
                                            <i class="fa fa-times fa fa-white"></i>
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
                                                    <th>FORTE SURCHARGE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($grpe_ess as $g_e) {
                                                    /*
                                                     * Get  Essieux infos
                                                     * Recuperer les infos des Essieux
                                                     */
                                                    $ess_info = $dbh->query('SELECT a."id_EP", a."id_GP", a."nom_EP", a."poidsMax_EP", a."poidsMesure_EP", a."distMinEssieu_EP", a."distMaxEssieu_EP", a."positionEssieuMesuree_EP", a."distEssieuMesuree_EP", a."vitesse_EP", a."acceleration_EP", a."erreur_EP", a.RDB$DB_KEY FROM "Essieu_Pese" a where a."id_GP"=' . $g_e['id_GP']);
                                                    $ess_info->execute();
                                                    $ess = $ess_info->fetchAll();
                                                    foreach ($ess as $es) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $es['nom_EP']; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $es['poidsMesure_EP'] = ($es['poidsMesure_EP'] - (($es['poidsMesure_EP'] * $tolerance) / 100));
                                                                echo $es['poidsMesure_EP'];
                                                                ?>
                                                            </td>
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
                                        <?php
                                        $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                        $info->execute();
                                        $essieux = $info->fetch();
                                        //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."poidsMesure_EP" as "EP" ,e."poidsMax_EP" as "EP_MAX" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP" order by "high" desc rows 1');
                                        $sql->execute();
                                        $result = $sql->fetch();
                                        $overload_axle = $result["bigest_overload_ep"];
                                        //CALCUL
                                        $result['EP'] = ($result['EP'] - (($result['EP'] * $tolerance) / 100)) - $result['EP_MAX'];

                                        if ($result['high'] < 0) {
                                            $_SESSION['surcharge_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_essieux'] = $result['EP'];
                                        }

                                        //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                        $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."poids_GP" as "GP" ,g."poidsMax_GP" as "GP_MAX" ,g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP",g."poids_GP" ,g."poidsMax_GP" order by "high_gp" desc rows 1');
                                        $sql_gp->execute();
                                        $result_gp = $sql_gp->fetch();
                                        $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                        //CALCUL
                                        $result_gp['GP'] = ($result_gp['GP'] - (($result_gp['GP'] * $tolerance) / 100)) - $result_gp['GP_MAX'];

                                        if ($result_gp['high_gp'] < 0) {
                                            $_SESSION['surcharge_gp_essieux'] = 0;
                                        } else {
                                            $_SESSION['surcharge_gp_essieux'] = $result_gp['GP'];
                                        }
                                        // I-CHECK IF TRANSPORT IS HYDROCARBURE OR GAZ BUTANE OR BOUTEIL DE GAZ
                                        if ($_SESSION['produit_transporte'] == "HYDROCARBURE" || $_SESSION['produit_transporte'] == "GAZ BUTANE" || $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                            //if ($_SESSION['produit_transporte'] == "HYDROCARBURE"){
                                            $_SESSION['overload_name'] = "HYDROCARBURE";
                                            /* } else if ($_SESSION['produit_transporte'] == "GAZ BUTANE"){
                                              $_SESSION['overload_name'] = "GAZ BUTANE";
                                              }else if ($_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ"){
                                              $_SESSION['overload_name'] = "BOUTEILLE DE GAZ";
                                              }else{}
                                             */

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL 
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {

                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGEINT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                            //I-2-THE CONVOY IS THEN NATIONAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT;
                                                if ($fine > 10000) {
                                                    $fine = 10000 + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    //$_SESSION['overload_name'] = "HYDROCARBURE";
                                                } else {
                                                    $fine = $fine + $fraisPESAGENAT;
                                                    $_SESSION['fine'] = $fine;
                                                    // $_SESSION['overload_name'] = "HYDROCARBURE";
                                                }
                                            }
                                        }

                                        //II-CHECK IF TRANSPORT IS GRUME
                                        else if ($_SESSION['produit_transporte'] == "GRUME") {

                                            //I-1-CHECK IF THE CONVOY IS ITERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                                $_SESSION['overload_name'] = "GRUME";
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            }
                                            //I-2-THE CONVOY IS THEN NATIONAL
                                            else {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT + $fraisPESAGENAT;
                                                $_SESSION['overload_name'] = "GRUME";
                                                $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            }
                                        }

                                        //III-THE TRANSPORT IS SET TO GLOBAL WEIGHT
                                        else if ($app_pds_ttl == 1) {
                                            $pds = $_SESSION['value_surcharge'];
                                            $_SESSION['overload_name'] = "POIDS TOTAL";
                                            $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                            //III-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                //III-2-a CHECK IF OVERLOAD EXISTS
                                                if ($_SESSION['value_surcharge'] > 0) {
                                                    $fine = ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                                } else {
                                                    $fine = $fraisPESAGEINT;
                                                }
                                            } else {
                                                //III-3 THE TRANSPORT IS THEN NATIONAL
                                                //III-3-a CHECK IF OVERLOAD EXISTS
                                                if ($_SESSION['value_surcharge'] > 0) {
                                                    $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                                } else {
                                                    $fine = $fraisPESAGENAT;
                                                    $_SESSION['overload_mass'] = 0;
                                                }
                                            }
                                        }

                                        //IV-THE TRANSPORT IS NEITHER HYDROCARBURE OR GRUME NOR GLOBAL WEIGHT SO LOGIC GOES AS NORMAL AS USUAL
                                        else {
                                            //IV-1 CHECK WHICH IS BIGGER AMONG ESSIEUX GROUP ESSIEUX AND POIDS VEHICULE
                                            if ($_SESSION['surcharge_gp_essieux'] == $_SESSION['surcharge_essieux']) {
                                                $pds = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_axle;
                                            } else if ($_SESSION['surcharge_gp_essieux'] > $_SESSION['surcharge_essieux']) {
                                                $pds = $_SESSION['surcharge_gp_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_gp_axle;
                                            } else {
                                                $pds = $_SESSION['surcharge_essieux'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = $overload_axle;
                                            }
                                            if ($_SESSION['value_surcharge'] > $pds) {
                                                $pds = $_SESSION['value_surcharge'];
                                                $_SESSION['overload_mass'] = $pds;
                                                $_SESSION['overload_name'] = "POIDS TOTAL";
                                            } else if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                $_SESSION['overload_mass'] = 0;
                                                $_SESSION['overload_name'] = "";
                                            }
                                            /*
                                              if ($_SESSION['value_surcharge'] > $_SESSION['surcharge_essieux']) {
                                              $pds = $_SESSION['value_surcharge'];
                                              $_SESSION['overload_mass'] = $pds;
                                              } else {
                                              $pds = $_SESSION['surcharge_essieux'];
                                              $_SESSION['overload_mass'] = $pds;
                                              $_SESSION['overload_name'] = $overload_axle;
                                              }
                                              if ($pds < $_SESSION['surcharge_gp_essieux']) {
                                              $pds = $_SESSION['surcharge_gp_essieux'];
                                              $_SESSION['overload_mass'] = $pds;
                                              $_SESSION['overload_name'] = $overload_gp_axle;
                                              } else {
                                              $_SESSION['overload_name'] = "POIDS TOTAL";
                                              }
                                             */
                                            //IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                            if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                //III-2-a CHECK IF OVERLOAD EXISTS
                                                //ORIGINAL ONE:=> if ($_SESSION['value_surcharge'] > 0) {
                                                if ($pds > 0) {
                                                    $fine = ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                                } else {
                                                    $fine = $fraisPESAGEINT;
                                                }
                                            } else {
                                                //IV-3 THE TRANSPORT IS THEN NATIONAL
                                                //IV-3-a CHECK IF OVERLOAD EXISTS
                                                //ORIGINAL ONE:=> if ($_SESSION['value_surcharge'] > 0) {
                                                if ($pds > 0) {
                                                    $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                                } else {
                                                    $fine = $fraisPESAGENAT;
                                                }
                                            }
                                        }
                                        if (isset($_SESSION['infraction'])) {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine + $_SESSION['infraction'];
                                        } else {
                                            $_SESSION['montant_paye'] = $fine;
                                            $_SESSION['montant_a_paye'] = $fine;
                                        }
                                        $var = substr(round($_SESSION['montant_a_paye']), -3);
                                        //echo $var;
                                        //echo '<br/>'.$_SESSION['montant_a_paye'];
                                        if ($var < 250) {
                                            $_SESSION['montant_a_paye'] = $_SESSION['montant_a_paye'] - $var;
                                        } else if ((250 <= $var) && ($var < 750)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 500;
                                        } else if ((750 <= $var) && ($var < 1000)) {
                                            $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 1000;
                                        }
                                        ?>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td >
                                                    <input style="visibility: hidden;" type="text" list="categoryname" autocomplete="off" id="clients" name="compte_client" class="form-control" value="<?php
                                                    $_c = $_SESSION['client'];
                                                    echo $_SESSION['client'];
                                                    ?>" required>

                                                                                                                                                                                                                                                                                                                                                                                                                               <!-- <h5 style=" color: #8C001A;"><strong>CLIENT : <?php /*
                                             $_c = $_SESSION['client'];
                                             echo $_SESSION['client']; */
                                                    ?></strong></h5>-->
                                                </td>
                                                <!--
                                                            <td>
                                                <?php
                                                /* $bills = $_SESSION['montant_a_paye'];
                                                  //EXPORTATEUR REQUEST
                                                  /* $exportateur = $conn->prepare('SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [PREFERENTIEL] = 1'); *
                                                  $exportateur = $conn->prepare("SELECT * FROM [dbo].[COMPTE_CLIENT] WHERE [SOCIETE]= '$_c' AND [SOLDE_COMPTE_CLIENT] > '$bills'");
                                                  $exportateur->execute();
                                                  $exportateur_result = $exportateur->fetchAll();
                                                 * 
                                                 */
                                                ?>
                                                                <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="compte_client" class="form-control" placeholder="Choisir le Nº de Compte..." required>
                                                                <datalist id="categoryname">
                                                <?php //foreach ($exportateur_result as $key) {           ?>
                                                                        <option value="<?php //echo rtrim($key['ID_COMPTE_CLIENT']);                           ?>"><?php // echo "Nº " . rtrim($key['ID_COMPTE_CLIENT']) . "=>" . number_format(rtrim($key['SOLDE_COMPTE_CLIENT']), 0, '', '.') . $devise;                           ?></option>
                                                <?php //}             ?>
                                                                </datalist>
                                                            </td>
                                                -->
                                                <td style="float:right;font-size: 3em;">
                                                    <h4 style=" color: red;"><strong><u>MONTANT &Agrave; PAYER:</u>&nbsp;&nbsp;<?php
                                                            $bill = $_SESSION['montant_a_paye'];
                                                            echo number_format($_SESSION['montant_a_paye'], 0, '', '.') . " " . $devise;
                                                            ?></strong></h4> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                                <!-- end: FOOTER -->
                                <?php
                                //BILL FOR THE RECEIPT
                                $_SESSION['bill'] = $bill;
                                ?>
                                <!-- start: BOOTSTRAP EXTENDED MODALS -->
                                <div id="receipt" class="modal fade" tabindex="-1" data-width="700">
                                    <form method="post" action="">
                                        <div class="modal-body" id ="printThis">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <div class="row" >
                                                <section   style="width:100%; margin:0 auto;font-size: 11.336px; background-image:url(assets/images/modal.png); background-repeat:no-repeat;">
                                                    <img src="assets/images/modalhead.png" id="overlay">
                                                    <div id="two">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUCTURES ECONOMIQUES 
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
                                                            <tr >
                                                                <td colspan="5">
                                                                    <div align="center">
                                                                        STATION DE PESAGE FIXE <?php echo substr($_SESSION['site'], 7); ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>
                                                                            Nº VERBALISATION : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_verb']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            Nº PES&Eacute;E : 
                                                                        </b>
                                                                        <?php echo $_SESSION['num_pesee_wim']; ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            SOCI&Eacute;T&Eacute;/PROP :
                                                                        </b>
                                                                        <?php echo $societe['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>
                                                                            IMMATRICULATION : 
                                                                        </b>
                                                                        <?php
                                                                        $_SESSION['immatriculation'] = $immatriculation['valeur_champs'];
                                                                        echo $immatriculation['valeur_champs'];
                                                                        ?>
                                                                        <br><br>
                                                                        <b>
                                                                            PRODUIT :   
                                                                        </b>
                                                                        <?php echo $produit['valeur_champs']; ?>


                                                                    </div>
                                                                </td>
                                                                <td>&nbsp;</td>
                                                                <td>
                                                                    <div align="left" >
                                                                        <b>DATE :</b> <?php echo date('d-m-Y H:i:s'); ?> 
                                                                        <br><br>
                                                                        <b>
                                                                            PROV/DEST:</b> <?php echo $provenance['valeur_champs']; ?>
                                                                        <br><br>
                                                                        <b>EXPORTATEUR:</b> <?php echo $_SESSION['exportateur']; ?><br><br>
                                                                        <b>
                                                                            NATIONALIT&Eacute; :
                                                                        </b>
                                                                        <?php echo $_SESSION['nationalite']; ?>

                                                                        <br><br>
                                                                        <b>
                                                                            TRANSPORT : 
                                                                        </b>
                                                                        <?php
                                                                        if ($_SESSION['preferentiel'] != 1) {
                                                                            echo $_SESSION['transport'];
                                                                        } else {
                                                                            echo $_SESSION['transport_affichage'];
                                                                        }
                                                                        ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    &nbsp;</td>
                                                                <td>
                                                                    <div align="center">
                                                                        <?php
                                                                        echo '<img src="qr_code.php" style="width:100px;"/>';
                                                                        ?>
                                                                        <br>
                                                                        <div align="center" id="modal-silhouette">
                                                                            <?php
                                                                            if ($photo_vehicule['silhouette'] != '') {
                                                                                ?>
                                                                                <img src="<?php echo $photo_vehicule['silhouette']; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                                <br>
                                                                                <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <br>
                                                                            <?php $_SESSION['class_vehicule']; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                                <th scope="col">POIDS (KG)</th>
                                                                <th scope="col">POIDS MAX (KG)</th>
                                                                <th scope="col"> FORTE SURCHARGE (KG)</th>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $_SESSION['class_vehicule']; ?></td>
                                                                <td style="text-align:center"><?php echo $result_P['poids_total_vehicule_Pesee']; ?></td>
                                                                <td style="text-align:center"><?php echo $result_VP['poidsMax_VP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    $val_sur = $result_P['surcharge_Vehicule_Pesee'];
                                                                    echo $val_sur;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            foreach ($grpe_ess as $gp_es) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $gp_es['nom_GP']; ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php
                                                                        $gp_es['poids_GP'] = ($gp_es['poids_GP'] - (($gp_es['poids_GP'] * $tolerance) / 100));
                                                                        $_SESSION['poids_total_essieux'] = $gp_es['poids_GP'];
                                                                        echo $gp_es['poids_GP'];
                                                                        ?>
                                                                    </td>
                                                                    <td class="dyp">
                                                                        <?php echo $gp_es['poidsMax_GP']; ?>
                                                                    </td>
                                                                    <td class="dyp">
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
                                                                <?php
                                                            }
                                                            $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                                            $info->execute();
                                                            $essieux = $info->fetch();
                                                            //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."poidsMesure_EP" as "EP" ,e."poidsMax_EP" as "EP_MAX" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP" order by "high" desc rows 1');
                                                            $sql->execute();
                                                            $result = $sql->fetch();
                                                            $overload_axle = $result["bigest_overload_ep"];
                                                            //CALCUL
                                                            $result['EP'] = ($result['EP'] - (($result['EP'] * $tolerance) / 100)) - $result['EP_MAX'];

                                                            if ($result['high'] < 0) {
                                                                $_SESSION['surcharge_essieux'] = 0;
                                                            } else {
                                                                $_SESSION['surcharge_essieux'] = $result['EP'];
                                                            }

                                                            //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                            $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."poids_GP" as "GP" ,g."poidsMax_GP" as "GP_MAX" ,g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP",g."poids_GP" ,g."poidsMax_GP" order by "high_gp" desc rows 1');
                                                            $sql_gp->execute();
                                                            $result_gp = $sql_gp->fetch();
                                                            $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                                            //CALCUL
                                                            $result_gp['GP'] = ($result_gp['GP'] - (($result_gp['GP'] * $tolerance) / 100)) - $result_gp['GP_MAX'];

                                                            if ($result_gp['high_gp'] < 0) {
                                                                $_SESSION['surcharge_gp_essieux'] = 0;
                                                            } else {
                                                                $_SESSION['surcharge_gp_essieux'] = $result_gp['GP'];
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td style="text-align:left"><?php echo $essieux['nom_EP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    $essieux['poidsMesure_EP'] = ($essieux['poidsMesure_EP'] - (($essieux['poidsMesure_EP'] * $tolerance) / 100));
                                                                    $result['high'] = $essieux['poidsMesure_EP'] - $essieux['poidsMax_EP'];
                                                                    echo $essieux['poidsMesure_EP'];
                                                                    ?>
                                                                </td>
                                                                <td style="text-align:center"><?php echo $essieux['poidsMax_EP']; ?></td>
                                                                <td style="text-align:center">
                                                                    <?php
                                                                    if ($result['high'] < 0) {
                                                                        $_SESSION['surcharge_essieux'] = 0;
                                                                        echo 0;
                                                                    } else {
                                                                        $_SESSION['surcharge_essieux'] = $result['high'];
                                                                        echo $result['high'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="1" style=" margin-top:0.5%">
                                                            <tr>
                                                                <th scope="col">TYPE D'INFRACTION(S)</th>
                                                                <th scope="col" colspan="2">AMENDE(S)</th>
                                                            </tr>
                                                            <?php
                                                            if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                                for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                        </td>
                                                                        <td>
                                                                            <div align="right">
                                                                                <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="3" style="text-align: center;">
                                                                        <label >
                                                                            <!--<h6>PAS DE FRAUDE </h6>-->
                                                                        </label>
                                                                    </td>
                                                                </tr>

                                                            <?php } ?>
                                                            <tr>
                                                                <?php
                                                                if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                                    ?>
                                                                    <td colspan='2'>
                                                                        PAS DE SURCHARGE
                                                                    </td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <td>
                                                                        FACTURATION SUR "<?php echo $_SESSION['overload_name']; ?>"
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td align="right">
                                                                    <?php echo round($_SESSION['overload_mass']) . " KG"; ?>
                                                                </td>
                                                                <td align="right">
                                                                    <?php
                                                                    if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGEINT;
                                                                        if ($var < 250) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((250 <= $var) && ($var < 750)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((750 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    } else {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGENAT;
                                                                        if ($var < 250) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                        } else if ((250 <= $var) && ($var < 750)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                        } else if ((750 <= $var) && ($var < 1000)) {
                                                                            $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                        }
                                                                        echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">FRAIS DE PESAGE</td>
                                                                <td><div align="right">
                                                                        <?php
                                                                        /* if ($_SESSION['produit_transporte'] == "GRUME") {
                                                                          echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                          } else */if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                            echo number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                                        } else {
                                                                            echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                        }
                                                                        ?>
                                                                    </div></td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" border="0" style=" margin-top:1%">
                                                            <tr>
                                                                <td><u>Copie:</u>ORIGINAL</td>
                                                                <td>  <?php echo $_SESSION['produit_dangereux']; ?></td>
                                                                // <td><div align="right">TOTAL &Agrave; PAYER * :</div></td>
                                                                <td  style=" font-size: large"><div align="right"><strong><?php echo number_format($bill, 0, '', '.') . " " . $devise; /* number_format($_SESSION['montant_a_paye'],0,'','.').' '.$devisePARAM; */ ?></strong></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Op&eacute;rateur de pesage: <?php echo $_SESSION['login_utilisateur'] ?></td>
                                                                <!--<td><strong>TOL&Eacute;RANCE APPLIQU&Eacute;E: <?php //echo $tolerance . '%';    ?></strong></td>-->
                                                            </tr>
                                                        </table>
                                                        <table align="right" style="margin-top:1%">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                             <td><div align="center"><strong> *PREVOIR 100 F POUR LES FRAIS DE TIMBRE D'ETAT</strong></div></td>
                                                                <td><div  align="left"><?php echo date('d-m-Y H:i:s'); ?></div></td>
                                                            </tr>
                                                        </table>
                                                        <?php
                                                        if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                            ?>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td><div align="center"><strong>
                                                                                <?php
                                                                                $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                                                $warning_fine_nat = ($surcharge_ext * $AmendeExtremeSurNat) + $fraisPESAGENAT;
                                                                                $warning_fine_int = ($surcharge_ext * $AmendeExtremeSurInt) + $fraisPESAGEINT;
                                                                                ?>
                                                                                <strong style="color:#861D20">
                                                                                    ****************************************************************************************************************************************************************************<br>
                                                                                    ATTENTION!! VOUS ETES EN EXTREME SURCHARGE DE  <strong style=" font-size: medium"><?php echo number_format($surcharge_ext, 0, '', '.') . "KG"; ?></strong> VOUS SEREZ BIENTOT FACTUR&Eacute; &Agrave; <strong style="font-size:medium;"> <?php
                                                                                        if ($_SESSION['transport'] != "INTERNATIONAL") {
                                                                                            echo number_format($warning_fine_nat, 0, '', '.') . " " . $devise;
                                                                                        } else {
                                                                                            echo number_format($warning_fine_int, 0, '', '.') . " " . $devise;
                                                                                        }
                                                                                        ?> </strong> 
                                                                                    <br>****************************************************************************************************************************************************************************</strong>

                                                                            </strong></div></td>
                                                                </tr>
                                                            </table>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <table width="100%" border="1" style="margin-top:1%">
                                                                <tr>
                                                                    <td><div align="center"><strong>AFRIQUE PESAGE SA | Site web : www.afriquepesage.com | TEL: +225 21 35 35 20/+225 21 35 64 47</strong></div></td>
                                                                </tr>
                                                            </table>
                                                            <?php
                                                        }
                                                        ?>
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
                                <?php
                            }
                        }
                    } else {
                        if ($app_ext_sur == 1) {
                            $surcharge = 0;
                            $surcharge_ext = 0;
                            $frais_ext_NAT = $AmendeExtremeSurNat;
                            $frais_ext_INT = $AmendeExtremeSurInt;
                            $frais_ext_NAT01 = $INFPoidsTotalsAmNAT;
                            $frais_ext_INT01 = $INFPoidsTotalsAmINT;
                            if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                $surcharge = 0;
                                $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                            } else
                            if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                            } else
                            if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                $_SESSION['value_extreme_surcharge'] = $surcharge_ext;
                            }
                            ?>

                            <div class="row second" style="margin-top: 0.5%;padding-left: 1%;padding-right: 1%; border-bottom: 2px solid #8C001A;">
                                <table class="table table-hover table-bordered" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th>NOM CLASSE</th>
                                            <th>PTAC UEMOA (Kg)</th>
                                            <th>PTAC UEMOA 20% (Kg)</th>
                                            <th>PTAC UEMOA 40%(Kg)</th>
                                            <th>PDS DU VEHICULE (Kg)</th>
                                            <th>PDS EXC&Eacute;DENT (Kg)</th>                                                
                                            <th>EXTR&Egrave;ME SURCHARGE (Kg)</th>
                                            <th>FORTE SURCHARGE (Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody style=" text-align: center;">
                                        <tr>
                                            <td>
                                                <?php echo substr($photo_vehicule_link, 7); ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $_SESSION['ptac'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $result_VP['poidsMax_VP'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $uemoa['seuil_ext_surc']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $_SESSION['poids_total_vehicule'] = $result_P['poids_total_vehicule_Pesee'];
                                                echo round($result_P['poids_total_vehicule_Pesee']);
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $_SESSION['value_surcharge'] = $result_P['surcharge_Vehicule_Pesee'];
                                                echo round($result_P['surcharge_Vehicule_Pesee']);
                                                ?>
                                            </td>                                                
                                            <td style="color:<?php switchColor($surcharge_ext) ?>; font-size:<?php switchFont($surcharge_ext) ?>">
                                                <?php
                                                echo round($surcharge_ext);
                                                ?>
                                            </td>
                                            <td style="color:<?php color($surcharge) ?>; font-size:<?php font($surcharge) ?>">
                                                <?php
                                                echo round($surcharge);
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                                <div class="col-sm-3" >
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td id="silhouette">
                                                        <?php
                                                        if ($_SESSION['photo'] != '') {
                                                            ?>
                                                            <img src="<?php echo $_SESSION['photo']; ?>"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td style="width:15% !important;"><label class="col-sm-8 control-label" for="form-field-5">
                                                            Nº VERB 
                                                        </label></td>
                                                    <td style="width:22% !important;"><input id="form-field-9" class="form-control" value="<?php echo $_SESSION['num_verb']; ?>"type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            Nº PESEE
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $_SESSION['num_pesee_webafp']; ?>" type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            OP&Eacute;RATEUR
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php
                                                        if (!isset($_SESSION['login_utilisateur'])) {
                                                            
                                                        } else {
                                                            echo $_SESSION['login_utilisateur'];
                                                        }
                                                        ?>" type="text" placeholder="" readonly ></td>
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
                                                            TYPE VEHICULE
                                                        </label></td>
                                                    <td id="type">
                                                        <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo substr($photo_vehicule_link, 7); ?>" type="text" placeholder="" readonly >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            SOCI&Eacute;T&Eacute;/PROPRI&Eacute;TAIRE
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $societe['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            IMMATRICULATION
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $immatriculation['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            PROV/DEST
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $provenance['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
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
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            PRODUIT
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $produit['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            NATIONALIT&Eacute;
                                                        </label></td>
                                                    <td>
                                                        <input id="form-field-1" class="form-control" name="nationalite" type="text" value="<?php echo $_SESSION['nationalite'] ?>" placeholder=""  readonly />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            EXPORTATEUR
                                                        </label></td>
                                                    <td>                                                        
                                                        <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $_SESSION['exportateur'] ?>" placeholder=""  readonly />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            TRANSPORT
                                                        </label></td>
                                                    <td>                                                        
                                                        <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php
                                                        if ($_SESSION['preferentiel'] != 1) {
                                                            echo $_SESSION['transport'];
                                                        } else {
                                                            echo $_SESSION['transport_affichage'];
                                                        }
                                                        ?>" placeholder=""  readonly />
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="produit_dangeureux" value=" <?php echo $_SESSION['produit_dangereux']; ?>" style="border-style:none;color: #8C001A;"/>
                                    <div class="panel-body" >
                                        <div class="form-group">
                                            <p>
                                            <h6>INFRACTION(S)</h6>                            
                                            </p>
                                            <table width="100%" border="0">
                                                <?php
                                                if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                    for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td valign="top">
                                                                <label class="checkbox-inline">
                                                                    <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                </label>
                                                            </td>
                                                            <td valign="top">
                                                                <h6> <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?> </h6>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td valign="top">
                                                            <label class="checkbox-inline">
                                                                <!--<h6>PAS DE FRAUDE </h6>-->
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
                                                <th>FORTE SURCHARGE (Kg)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
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
                                    <a class="btn btn-green btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                        ENREGISTRER
                                        <i class="fa fa-check fa-white"></i>
                                    </a>
                                    <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                        ANNULER
                                        <i class="fa fa-times fa fa-white"></i>
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
                                                <th>FORTE SURCHARGE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($grpe_ess as $g_e) {
                                                /*
                                                 * Get  Essieux infos
                                                 * Recuperer les infos des Essieux
                                                 */
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
                                    <?php
                                    $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                    $info->execute();
                                    $essieux = $info->fetch();
                                    //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                    $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                    $sql->execute();
                                    $result = $sql->fetch();
                                    $overload_axle = $result["bigest_overload_ep"];
                                    //CALCUL
                                    if ($result['high'] < 0) {
                                        $_SESSION['surcharge_essieux'] = 0;
                                    } else {
                                        $_SESSION['surcharge_essieux'] = $result['high'];
                                    }

                                    //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                    $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');
                                    $sql_gp->execute();
                                    $result_gp = $sql_gp->fetch();
                                    $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                    //CALCUL
                                    if ($result_gp['high_gp'] < 0) {
                                        $_SESSION['surcharge_gp_essieux'] = 0;
                                    } else {
                                        $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                    }
                                    // I-CHECK IF TRANSPORT IS HYDROCARBURE OR GAZ BUTANE OR BOUTEIL DE GAZ
                                    if ($_SESSION['produit_transporte'] == "HYDROCARBURE" || $_SESSION['produit_transporte'] == "GAZ BUTANE" || $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                        //if ($_SESSION['produit_transporte'] == "HYDROCARBURE"){
                                        $_SESSION['overload_name'] = "HYDROCARBURE";
                                        /* } else if ($_SESSION['produit_transporte'] == "GAZ BUTANE"){
                                          $_SESSION['overload_name'] = "GAZ BUTANE";
                                          }else if ($_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ"){
                                          $_SESSION['overload_name'] = "BOUTEILLE DE GAZ";
                                          }else{}
                                         */

                                        //I-1-CHECK IF THE CONVOY IS ITERNATIONAL 
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {

                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT;
                                            if ($fine > 10000) {
                                                $fine = 10000 + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                            } else {
                                                $fine = $fine + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                            }
                                        }
                                        //I-2-CHECK IF THE CONVOY IS NATIONAL
                                        else if ($_SESSION['transport'] == "NATIONAL") {
                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT;
                                            if ($fine > 10000) {
                                                $fine = 10000 + $fraisPESAGENAT;
                                                $_SESSION['fine'] = $fine;
                                                // $_SESSION['overload_name'] = "HYDROCARBURE";
                                            } else {
                                                $fine = $fine + $fraisPESAGENAT;
                                                $_SESSION['fine'] = $fine;
                                                //$_SESSION['overload_name'] = "HYDROCARBURE";
                                            }
                                        }
                                        //I-3-THE CONVOY IS THEN PREFERENTIAL
                                        else {
                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT;
                                            if ($fine > 10000) {
                                                $fine = 10000 + $fraisPESAGENAT;
                                                $_SESSION['fine'] = $fine;
                                                // $_SESSION['overload_name'] = "HYDROCARBURE";
                                            } else {
                                                $fine = $fine + $fraisPESAGENAT;
                                                $_SESSION['fine'] = $fine;
                                                // $_SESSION['overload_name'] = "HYDROCARBURE";
                                            }
                                        }
                                    }

                                    //II-CHECK IF TRANSPORT IS GRUME
                                    else if ($_SESSION['produit_transporte'] == "GRUME") {
                                        $_SESSION['overload_name'] = "GRUME";
                                        if ($_SESSION['value_extreme_surcharge'] == 0) {
                                            $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                        } else {
                                            $_SESSION['overload_mass'] = $_SESSION['value_extreme_surcharge'];
                                            $_SESSION['value_surcharge'] = $_SESSION['value_extreme_surcharge'];
                                        }

                                        //I-1-CHECK IF THE CONVOY IS ITERNATIONAL
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {

                                            if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                            } else {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_INT + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                            }
                                        }
                                        //I-2-CHECK IF THE CONVOY IS NATIONAL
                                        else if ($_SESSION['transport'] == "NATIONAL") {
                                            if ($_SESSION['value_extreme_surcharge'] == 0) {
                                                $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                            } else {
                                                $fine = $_SESSION['value_surcharge'] * $frais_ext_NAT + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                            }
                                        }
                                        //I-3-THE CONVOY IS THEN PREFERENTIAL
                                        else {
                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT + $fraisPESAGENAT;
                                        }
                                    }
                                    //III-THE TRANSPORT IS SET TO GLOBAL WEIGHT
                                    else if ($app_pds_ttl == 1) {
                                        $_SESSION['overload_name'] = "POIDS TOTAL";
                                        $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                        $pds = $_SESSION['value_surcharge'];
                                        //III-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {
                                            //III-2-a CHECK IF TOTAL WEIGHT IS LESSER THAN (PTAC * 1.2)
                                            if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                                $fine = $fraisPESAGEINT;
                                            }
                                            //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.2) AND LESSER THAN (PTAC * 1.4)
                                            else
                                            if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                $_SESSION['value_surcharge'] = $surcharge;
                                                $fine = ($surcharge * $frais_ext_INT01) + $fraisPESAGEINT;
                                            }
                                            //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                            else
                                            if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                $_SESSION['value_surcharge'] = $surcharge_ext;
                                                $fine = ($surcharge_ext * $frais_ext_INT) + $fraisPESAGEINT;
                                            }
                                        }
                                        //III-3 CHECK IF TRANSPORT IS NATIONAL
                                        else if ($_SESSION['transport'] == "NATIONAL") {
                                            //III-3-a CHECK IF TOTAL WEIGHT IS LESSER THAN (PTAC * 1.2)
                                            if ($_SESSION['poid_total'] <= ($_SESSION['ptac'] * 120 / 100)) {
                                                $fine = $fraisPESAGENAT;
                                            }
                                            //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.2) AND LESSER THAN (PTAC * 1.4)
                                            else
                                            if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                $_SESSION['value_surcharge'] = $surcharge;
                                                $fine = ($surcharge * $frais_ext_NAT01) + $fraisPESAGENAT;
                                            }
                                            //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                            else
                                            if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                $_SESSION['value_surcharge'] = $surcharge_ext;
                                                $fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;
                                            }
                                        }
                                        //III-4 THE TRANSPORT IS THEN PREFERENTIAL
                                        else {
                                            if (($_SESSION['poid_total'] > ($_SESSION['ptac'] * 120 / 100)) && ($_SESSION['poid_total'] < ($_SESSION['ptac'] * 140 / 100))) {
                                                $surcharge = $_SESSION['poid_total'] - ($_SESSION['ptac'] * 120 / 100);
                                                $_SESSION['value_surcharge'] = $surcharge;
                                                $fine = ($surcharge * $frais_ext_NAT01) + $fraisPESAGENAT;
                                            }
                                            //III-2-b CHECK IF TOTAL WEIGHT IS GREATER THAN (PTAC * 1.4)
                                            else
                                            if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                $_SESSION['value_surcharge'] = $surcharge_ext;
                                                $fine = ($surcharge_ext * $frais_ext_NAT) + $fraisPESAGENAT;
                                            }
                                        }
                                    }
                                    //IV-THE TRANSPORT IS NEITHER HYDROCARBURE OR GRUME NOR SET TO GLOBAL WEIGHT SO LOGIC GOES AS NORMAL AS USUAL
                                    else {
                                        //IV-1 CHECK WHICH IS BIGGER AMONG ESSIEUX GROUP ESSIEUX AND POIDS VEHICULE
                                        if ($_SESSION['surcharge_gp_essieux'] == $_SESSION['surcharge_essieux']) {
                                            $pds = $_SESSION['surcharge_essieux'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = $overload_axle;
                                        } else if ($_SESSION['surcharge_gp_essieux'] > $_SESSION['surcharge_essieux']) {
                                            $pds = $_SESSION['surcharge_gp_essieux'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = $overload_gp_axle;
                                        } else {
                                            $pds = $_SESSION['surcharge_essieux'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = $overload_axle;
                                        }
                                        if ($_SESSION['value_surcharge'] > $pds) {
                                            $pds = $_SESSION['value_surcharge'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = "POIDS TOTAL";
                                        } else if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                            $_SESSION['overload_mass'] = 0;
                                            $_SESSION['overload_name'] = "";
                                        }
                                        /*
                                          if ($_SESSION['value_surcharge'] > $_SESSION['surcharge_essieux']) {
                                          $pds = $_SESSION['value_surcharge'];
                                          $_SESSION['overload_name'] = "POIDS TOTAL";
                                          $_SESSION['overload_mass'] = $pds;
                                          } else {
                                          $pds = $_SESSION['surcharge_essieux'];
                                          $_SESSION['overload_mass'] = $pds;
                                          $_SESSION['overload_name'] = $overload_axle;
                                          }
                                          if ($pds < $_SESSION['surcharge_gp_essieux']) {
                                          $pds = $_SESSION['surcharge_gp_essieux'];
                                          $_SESSION['overload_mass'] = $pds;
                                          $_SESSION['overload_name'] = $overload_gp_axle;
                                          } else {
                                          $_SESSION['overload_name'] = "POIDS TOTAL";
                                          $_SESSION['overload_mass'] = $pds;
                                          }
                                         */
                                        //IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {
                                            //III-2-a CHECK IF EXTREME OVERLOAD EXISTS
                                            if ($_SESSION['value_extreme_surcharge'] > 0) {
                                                //$fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurInt) + ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                                $fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurInt) + $fraisPESAGEINT;
                                            } else {
                                                //III-2-b CHECK IF OVERLOAD EXISTS
                                                if ($_SESSION['overload_mass'] > 0) {
                                                    //if ($pds > 0) {
                                                    $fine = ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                                } else {
                                                    $fine = $fraisPESAGEINT;
                                                }
                                            }
                                        }
                                        //IV-3 CHECK IF TRANSPORT IS NATIONAL
                                        else if ($_SESSION['transport'] == "NATIONAL") {
                                            if ($_SESSION['value_extreme_surcharge'] > 0) {
                                                $fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurNat) + $fraisPESAGENAT;
                                            } else {
                                                //III-2-c CHECK IF OVERLOAD EXISTS
                                                if ($_SESSION['overload_mass'] > 0) {
                                                    //if ($pds > 0) {
                                                    $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                                } else {
                                                    $fine = $fraisPESAGENAT;
                                                }
                                            }
                                        }
                                        //IV-3 THE TRANSPORT IS THEN PREFERENTIAL
                                        else {
                                            if ($_SESSION['value_extreme_surcharge'] > 0) {
                                                $fine = ($_SESSION['value_extreme_surcharge'] * $AmendeExtremeSurNat) + $fraisPESAGENAT;
                                            } else {
                                                //III-2-c CHECK IF OVERLOAD EXISTS
                                                if ($_SESSION['overload_mass'] > 0) {
                                                    //if ($pds > 0) {
                                                    $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                                } else {
                                                    $fine = $fraisPESAGENAT;
                                                }
                                            }
                                        }
                                    }
                                    
                                    if (isset($_SESSION['infraction'])) {
                                        $_SESSION['montant_paye'] = $fine;
                                        $_SESSION['montant_a_paye'] = $fine + $_SESSION['infraction'];
                                    } else {
                                        $_SESSION['montant_paye'] = $fine;
                                        $_SESSION['montant_a_paye'] = $fine;
                                    }
                                    $var = substr(round($_SESSION['montant_a_paye']), -3);
                                    //echo $var;
                                    //echo '<br/>'.$_SESSION['montant_a_paye'];
                                    if ($var < 250) {
                                        $_SESSION['montant_a_paye'] = $_SESSION['montant_a_paye'] - $var;
                                    } else if ((250 <= $var) && ($var < 750)) {
                                        $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 500;
                                    } else if ((750 <= $var) && ($var < 1000)) {
                                        $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 1000;
                                    }
                                    ?>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td >
                                                <input style="visibility: hidden;" type="text" list="categoryname" autocomplete="off" id="clients" name="compte_client" class="form-control" value="<?php
                                                $_c = $_SESSION['client'];
                                                echo $_SESSION['client'];
                                                ?>" required>

                                                                                                                                                                                                                                                                   <!-- <h5 style=" color: #8C001A;"><strong>CLIENT : <?php /*
                                             $_c = $_SESSION['client'];
                                             echo $_SESSION['client']; */
                                                ?></strong></h5>-->
                                            </td>
                                            <!--
                                            <td>
                                            <?php
                                            /* $bills = $_SESSION['montant_a_paye'];
                                              //EXPORTATEUR REQUEST
                                              /* $exportateur = $conn->prepare('SELECT * FROM [COMPTE_CLIENT] WHERE [PREFERENTIEL] = 1'); *
                                              $exportateur = $conn->prepare("SELECT * FROM [COMPTE_CLIENT] WHERE [SOCIETE]= '$_c' AND [SOLDE_COMPTE_CLIENT] > '$bills'");
                                              $exportateur->execute();
                                              $exportateur_result = $exportateur->fetchAll();
                                             * 
                                             */
                                            ?>
                                                <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="compte_client" class="form-control" placeholder="Choisir le Nº de Compte..." required>
                                                <datalist id="categoryname">
                                            <?php //foreach ($exportateur_result as $key) {      ?>
                                                        <option value="<?php //echo rtrim($key['ID_COMPTE_CLIENT']);                      ?>"><?php // echo "Nº " . rtrim($key['ID_COMPTE_CLIENT']) . "=>" . number_format(rtrim($key['SOLDE_COMPTE_CLIENT']), 0, '', '.') . $devise;                      ?></option>
                                            <?php //}      ?>
                                                </datalist>
                                            </td>
                                            -->
                                            <td style="float:right;font-size: 3em;">
                                                <h4 style=" color: red;"><strong><u>MONTANT &Agrave; PAYER:</u>&nbsp;&nbsp;<?php
                                                        $bill = $_SESSION['montant_a_paye'];
                                                        echo number_format($_SESSION['montant_a_paye'], 0, '', '.') . " " . $devise;
                                                        ?></strong></h4> 
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- end: FOOTER -->
                            <!-- end: PAGE CONTENT-->
                            <!-- end: PAGE -->
                            <?php
                            //BILL FOR THE RECEIPT
                            $_SESSION['bill'] = $bill;
                            ?>
                            <!-- start: BOOTSTRAP EXTENDED MODALS -->
                            <div id="receipt" class="modal fade" tabindex="-1" data-width="700">
                                <form method="post" action="">
                                    <div class="modal-body" id ="printThis">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <div class="row" >
                                            <section   style="width:100%; margin:0 auto;font-size: 11.336px; background-image:url(assets/images/modal.png); background-repeat:no-repeat;">
                                                <img src="assets/images/modalhead.png" id="overlay">
                                                <div id="two">
                                                    <table width="100%" border="0">
                                                        <tr>
                                                            <td colspan="5">
                                                                <div align="center">
                                                                    R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUCTURES ECONOMIQUES
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
                                                        <tr >
                                                            <td colspan="5">
                                                                <div align="center">
                                                                    STATION DE PESAGE FIXE <?php echo substr($_SESSION['site'], 7); ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div align="left" >
                                                                    <b>
                                                                        Nº VERBALISATION : 
                                                                    </b>
                                                                    <?php echo $_SESSION['num_verb']; ?>
                                                                    <br><br>
                                                                    <b>
                                                                        Nº PES&Eacute;E : 
                                                                    </b>
                                                                    <?php echo $_SESSION['num_pesee_wim']; ?> 
                                                                    <br><br>
                                                                    <b>
                                                                        SOCI&Eacute;T&Eacute;/PROP :
                                                                    </b>
                                                                    <?php echo $societe['valeur_champs']; ?>
                                                                    <br><br>
                                                                    <b>
                                                                        IMMATRICULATION : 
                                                                    </b>
                                                                    <?php
                                                                    $_SESSION['immatriculation'] = $immatriculation['valeur_champs'];
                                                                    echo $immatriculation['valeur_champs'];
                                                                    ?>
                                                                    <br><br>
                                                                    <b>
                                                                        PRODUIT :   
                                                                    </b>
                                                                    <?php echo $produit['valeur_champs']; ?>


                                                                </div>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td>
                                                                <div align="left" >
                                                                    <b>DATE :</b> <?php echo date('d-m-Y H:i:s'); ?> 
                                                                    <br><br>
                                                                    <b>
                                                                        PROV/DEST:</b> <?php echo $provenance['valeur_champs']; ?>
                                                                    <br><br>
                                                                    <b>EXPORTATEUR:</b> <?php echo $_SESSION['exportateur']; ?><br><br>
                                                                    <b>
                                                                        NATIONALIT&Eacute; :
                                                                    </b>
                                                                    <?php echo $_SESSION['nationalite']; ?>

                                                                    <br><br>
                                                                    <b>
                                                                        TRANSPORT : 
                                                                    </b>
                                                                    <?php
                                                                    if ($_SESSION['preferentiel'] != 1) {
                                                                        echo $_SESSION['transport'];
                                                                    } else {
                                                                        echo $_SESSION['transport_affichage'];
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                &nbsp;</td>
                                                            <td>
                                                                <div align="center">
                                                                    <?php
                                                                    echo '<img src="qr_code.php" style="width:100px;"/>';
                                                                    ?>
                                                                    <br>
                                                                    <div align="center" id="modal-silhouette">
                                                                        <?php
                                                                        if ($photo_vehicule['silhouette'] != '') {
                                                                            ?>
                                                                            <img src="<?php echo $photo_vehicule['silhouette']; ?>"/>
                                                                            <br>
                                                                            <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                            <br>
                                                                            <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <br>
                                                                        <?php $_SESSION['class_vehicule']; ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" border="1" style=" margin-top:0.5%">
                                                        <tr>
                                                            <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                            <th scope="col">POIDS (KG)</th>
                                                            <th scope="col">POIDS MAX (KG)</th>
                                                            <th scope="col">FORTE SURCHARGE (KG)</th>
                                                            <th scope="col">EXTREME SURCHARGE (KG)</th>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:left"><?php echo $_SESSION['class_vehicule']; ?></td>
                                                            <td style="text-align:center"><?php echo round($result_P['poids_total_vehicule_Pesee']); ?></td>
                                                            <td style="text-align:center"><?php echo $result_VP['poidsMax_VP']; ?></td>
                                                            <td style="text-align:center">
                                                                <?php
                                                                if ($surcharge_ext < 0) {
                                                                    echo round($result_P['surcharge_Vehicule_Pesee']);
                                                                } else {
                                                                    echo round($result_P['surcharge_Vehicule_Pesee']);
                                                                    // $val_sur = abs($surcharge_ext - $result_P['surcharge_Vehicule_Pesee']);
                                                                    // echo $val_sur;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td style="text-align:center">
                                                                <?php
                                                                if ($surcharge_ext < 0) {
                                                                    $_SESSION['poids_total_extreme_surcharge'] = 0;
                                                                    echo 0;
                                                                } else {
                                                                    $_SESSION['poids_total_extreme_surcharge'] = $surcharge_ext;
                                                                    echo round($surcharge_ext);
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        foreach ($grpe_ess as $gp_es) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $gp_es['nom_GP']; ?>
                                                                </td>
                                                                <td class="dyp">
                                                                    <?php
                                                                    $_SESSION['poids_total_essieux'] = $gp_es['poids_GP'];
                                                                    echo $gp_es['poids_GP'];
                                                                    ?>
                                                                </td>
                                                                <td class="dyp">
                                                                    <?php echo $gp_es['poidsMax_GP']; ?>
                                                                </td>
                                                                <td class="dyp">
                                                                    <?php
                                                                    $sur = $gp_es['poids_GP'] - $gp_es['poidsMax_GP'];
                                                                    if ($sur < 0) {
                                                                        echo 0;
                                                                    } else {
                                                                        echo $sur;
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td style="background-color: #EEEEEE">&nbsp;</td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                                        $info->execute();
                                                        $essieux = $info->fetch();
                                                        //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                        $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                                        $sql->execute();
                                                        $result = $sql->fetch();
                                                        $overload_axle = $result["bigest_overload_ep"];
                                                        //CALCUL
                                                        if ($result['high'] < 0) {
                                                            $_SESSION['surcharge_essieux'] = 0;
                                                        } else {
                                                            $_SESSION['surcharge_essieux'] = $result['high'];
                                                        }
                                                        //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                        $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');
                                                        $sql_gp->execute();
                                                        $result_gp = $sql_gp->fetch();
                                                        $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                                        if ($result_gp['high_gp'] < 0) {
                                                            $_SESSION['surcharge_gp_essieux'] = 0;
                                                        } else {
                                                            $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td style="text-align:left"><?php echo $essieux['nom_EP']; ?></td>
                                                            <td style="text-align:center"><?php echo $essieux['poidsMesure_EP']; ?></td>
                                                            <td style="text-align:center"><?php echo $essieux['poidsMax_EP']; ?></td>
                                                            <td style="text-align:center">
                                                                <?php
                                                                if ($result['high'] < 0) {
                                                                    $_SESSION['surcharge_essieux'] = 0;
                                                                    echo 0;
                                                                } else {
                                                                    $_SESSION['surcharge_essieux'] = $result['high'];
                                                                    echo $result['high'];
                                                                }
                                                                ?>
                                                            </td>
                                                            <td style="background-color: #EEEEEE">&nbsp;</td>
                                                        </tr>
                                                    </table>

                                                    <table width="100%" border="1" style=" margin-top:0.5%">
                                                        <tr>
                                                            <th scope="col">TYPE D'INFRACTION(S)</th>
                                                            <th scope="col" colspan="2">AMENDE(S)</th>
                                                        </tr>
                                                        <?php
                                                        if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                            for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div align="right">
                                                                            <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="3" style="text-align: center;">
                                                                    <label >
                                                                        <!--<h6>PAS DE FRAUDE </h6>-->
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <?php
                                                            if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                                ?>
                                                                <td colspan='2'>
                                                                    PAS DE SURCHARGE
                                                                </td>
                                                                <?php
                                                            } else if ($_SESSION['overload_mass'] != 0 && $_SESSION['poids_total_extreme_surcharge'] == 0) {
                                                                ?>
                                                                <td>
                                                                    FACTURATION SUR "<?php
                                                                    //$_SESSION['overload_name'] = $_SESSION['overload_name'];
                                                                    echo $_SESSION['overload_name'];
                                                                    ?>"
                                                                </td>
                                                                <td align="right">
                                                                    <?php
                                                                    //$_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                                                    echo round($_SESSION['overload_mass']) . " KG";
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <td>
                                                                    FACTURATION SUR "<?php
                                                                    $_SESSION['overload_name'] = "EXTREME SURCHARGE AU PTAC";
                                                                    echo $_SESSION['overload_name'];
                                                                    ?>"
                                                                </td>
                                                                <td align="right">
                                                                    <?php
                                                                    $_SESSION['overload_mass'] = $_SESSION['poids_total_extreme_surcharge'];
                                                                    echo round($_SESSION['overload_mass']) . " KG";
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                            <td align="right">
                                                                <?php
                                                                if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                    $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGEINT;
                                                                    if ($var < 250) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                    } else if ((250 <= $var) && ($var < 750)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                    } else if ((750 <= $var) && ($var < 1000)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                    }
                                                                    echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                } else {
                                                                    $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGENAT;
                                                                    if ($var < 250) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                    } else if ((250 <= $var) && ($var < 750)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                    } else if ((750 <= $var) && ($var < 1000)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                    }
                                                                    echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">FRAIS DE PESAGE</td>
                                                            <td><div align="right">
                                                                    <?php
                                                                    /* if ($_SESSION['produit_transporte'] == "GRUME") {
                                                                      echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                      } else */ if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                        echo number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                                    } else {
                                                                        echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                    }
                                                                    ?>
                                                                </div></td>
                                                        </tr>
                                                    </table>

                                                    <table width="100%" border="0" style=" margin-top:2%">
                                                        <tr>
                                                            <td><u>Copie:</u>ORIGINAL</td>
                                                            <td>  <?php echo $_SESSION['produit_dangereux']; ?></td>
                                                            <td><div align="right">TOTAL &Agrave; PAYER * :</div></td>
                                                            <td style=" font-size: large"><div align="right"><strong><?php echo number_format($bill, 0, '', ' ') . " " . $devise; /* number_format($_SESSION['montant_a_paye'],0,'','.').' '.$devisePARAM; */ ?></strong></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Op&eacute;rateur de pesage:<?php echo $_SESSION['login_utilisateur'] ?></td>
                                                        </tr>
                                                    </table>
                                                    <table align="right" style="margin-top:1%">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td><div align="center"><strong> *PREVOIR 100 F POUR LES FRAIS DE TIMBRE D'ETAT  </strong></div></td>
                                                            <td><div  align="left"><?php echo date('d-m-Y H:i:s'); ?></div></td>
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
                            <?php
                        } else {
                            ?>
                            <div class="row second" style="margin-top: 0.5%;padding-left: 1%;padding-right: 1%; border-bottom: 2px solid #8C001A;">
                                <table class="table table-hover table-bordered" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th>NOM CLASSE</th>
                                            <th>PDS MAX VEHICULE (Kg)</th>
                                            <th>PDS ENREGISTR&Eacute; (Kg)</th>
                                            <th>FORTE SURCHARGE (Kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody style=" text-align: center;">
                                        <tr>
                                            <td>
                                                <?php echo substr($photo_vehicule_link, 7); ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $result_VP['poidsMax_VP'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $_SESSION['poids_total_vehicule'] = $result_P['poids_total_vehicule_Pesee'];
                                                echo $result_P['poids_total_vehicule_Pesee'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $_SESSION['value_surcharge'] = $result_P['surcharge_Vehicule_Pesee'];
                                                echo $result_P['surcharge_Vehicule_Pesee'];
                                                ?>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row " style="margin-top: 0.5%; border-bottom: 2px solid #8C001A;">
                                <div class="col-sm-3" >
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td id="silhouette">
                                                        <?php
                                                        if ($_SESSION['photo'] != '') {
                                                            ?>
                                                            <img src="<?php echo $_SESSION['photo']; ?>"/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td style="width:15% !important;"><label class="col-sm-8 control-label" for="form-field-5">
                                                            Nº VERB
                                                        </label></td>
                                                    <td style="width:22% !important;"><input id="form-field-9" class="form-control" value="<?php echo $_SESSION['num_verb']; ?>"type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            Nº PESEE
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $_SESSION['num_pesee_webafp']; ?>" type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            OP&Eacute;RATEUR
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php
                                                        if (!isset($_SESSION['login_utilisateur'])) {
                                                            
                                                        } else {
                                                            echo $_SESSION['login_utilisateur'];
                                                        }
                                                        ?>" type="text" placeholder="" readonly ></td>
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
                                                            TYPE VEHICULE
                                                        </label></td>
                                                    <td id="type">
                                                        <input id="form-field-1" class="form-control" name="type_vehicule" value="<?php echo substr($photo_vehicule_link, 7); ?>" type="text" placeholder="" readonly >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            SOCI&Eacute;T&Eacute;/PROPRI&Eacute;TAIRE
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" name="nom_client" value="<?php echo $societe['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            IMMATRICULATION
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $immatriculation['valeur_champs']; ?>" type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            PROV/DEST
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $provenance['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
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
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            PRODUIT
                                                        </label></td>
                                                    <td><input id="form-field-1" class="form-control" value="<?php echo $produit['valeur_champs']; ?>"  type="text" placeholder="" readonly ></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            NATIONALIT&Eacute;
                                                        </label></td>
                                                    <td>
                                                        <input id="form-field-1" class="form-control" name="nationalite" type="text" value="<?php echo $_SESSION['nationalite'] ?>" placeholder=""  readonly />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            EXPORTATEUR
                                                        </label></td>
                                                    <td>                                                        
                                                        <input id="form-field-1" class="form-control" name="exportateur" type="text" value="<?php echo $_SESSION['exportateur'] ?>" placeholder=""  readonly />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="col-sm-10 control-label" for="form-field-5">
                                                            TRANSPORT
                                                        </label></td>
                                                    <td>                                                        
                                                        <input id="form-field-1" class="form-control" name="transport" type="text" value="<?php
                                                        if ($_SESSION['preferentiel'] != 1) {
                                                            echo $_SESSION['transport'];
                                                        } else {
                                                            echo $_SESSION['transport_affichage'];
                                                        }
                                                        ?>" placeholder=""  readonly />
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="produit_dangeureux" value=" <?php echo $_SESSION['produit_dangereux']; ?>" style="border-style:none;color: #8C001A;"/>

                                    <div class="panel-body" >
                                        <div class="form-group">
                                            <p>
                                            <h6>INFRACTION(S)</h6>                            
                                            </p>
                                            <table width="100%" border="0">
                                                <?php
                                                if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                    for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                        ?>
                                                        <tr>
                                                            <td valign="top">
                                                                <label class="checkbox-inline">
                                                                    <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                </label>
                                                            </td>
                                                            <td valign="top">
                                                                <h6> <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?> </h6>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td valign="top">
                                                            <label class="checkbox-inline">
                                                                <!--<h6>PAS DE FRAUDE </h6>-->
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
                                                <th>FORTE SURCHARGE (Kg)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
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
                                    <a class="btn btn-green btn-lg" href="#receipt" data-toggle = "modal"> <!--onClick="window.print()"-->
                                        ENREGISTRER
                                        <i class="fa fa-check fa-white"></i>
                                    </a>
                                    <a class="btn btn-red btn-lg" href="intro_operateur.php">
                                        ANNULER
                                        <i class="fa fa-times fa fa-white"></i>
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
                                                <th>FORTE SURCHARGE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($grpe_ess as $g_e) {
                                                /*
                                                 * Get  Essieux infos
                                                 * Recuperer les infos des Essieux
                                                 */
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
                                    <?php
                                    $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                    $info->execute();
                                    $essieux = $info->fetch();
                                    //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                    $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                    $sql->execute();
                                    $result = $sql->fetch();
                                    $overload_axle = $result["bigest_overload_ep"];
                                    //CALCUL
                                    if ($result['high'] < 0) {
                                        $_SESSION['surcharge_essieux'] = 0;
                                    } else {
                                        $_SESSION['surcharge_essieux'] = $result['high'];
                                    }

                                    //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                    $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');
                                    $sql_gp->execute();
                                    $result_gp = $sql_gp->fetch();
                                    $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                    //CALCUL
                                    if ($result_gp['high_gp'] < 0) {
                                        $_SESSION['surcharge_gp_essieux'] = 0;
                                    } else {
                                        $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                    }
                                    // I-CHECK IF TRANSPORT IS HYDROCARBURE OR GAZ BUTANE OR BOUTEIL DE GAZ
                                    if ($_SESSION['produit_transporte'] == "HYDROCARBURE" || $_SESSION['produit_transporte'] == "GAZ BUTANE" || $_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ") {
                                        //if ($_SESSION['produit_transporte'] == "HYDROCARBURE"){
                                        $_SESSION['overload_name'] = "HYDROCARBURE";
                                        /* } else if ($_SESSION['produit_transporte'] == "GAZ BUTANE"){
                                          $_SESSION['overload_name'] = "GAZ BUTANE";
                                          }else if ($_SESSION['produit_transporte'] == "BOUTEILLE DE GAZ"){
                                          $_SESSION['overload_name'] = "BOUTEILLE DE GAZ";
                                          }else{}
                                         */

                                        //I-1-CHECK IF THE CONVOY IS ITERNATIONAL 
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {

                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT;
                                            if ($fine > 10000) {
                                                $fine = 10000 + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                                //$_SESSION['overload_name'] = "HYDROCARBURE";
                                            } else {
                                                $fine = $fine + $fraisPESAGEINT;
                                                $_SESSION['fine'] = $fine;
                                                //$_SESSION['overload_name'] = "HYDROCARBURE";
                                            }
                                        }
                                        //I-2-THE CONVOY IS THEN NATIONAL
                                        else {
                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT;
                                            if ($fine > 10000) {
                                                $fine = 10000 + $fraisPESAGENAT;
                                                $_SESSION['fine'] = $fine;
                                                //$_SESSION['overload_name'] = "HYDROCARBURE";
                                            } else {
                                                $fine = $fine + $fraisPESAGENAT;
                                                $_SESSION['fine'] = $fine;
                                                // $_SESSION['overload_name'] = "HYDROCARBURE";
                                            }
                                        }
                                    }

                                    //II-CHECK IF TRANSPORT IS GRUME
                                    else if ($_SESSION['produit_transporte'] == "GRUME") {

                                        //I-1-CHECK IF THE CONVOY IS ITERNATIONAL
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {
                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmINT + $fraisPESAGEINT;
                                            $_SESSION['fine'] = $fine;
                                            $_SESSION['overload_name'] = "GRUME";
                                            $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                        }
                                        //I-2-THE CONVOY IS THEN NATIONAL
                                        else {
                                            $fine = $_SESSION['value_surcharge'] * $INFPoidsTotalsAmNAT + $fraisPESAGENAT;
                                            $_SESSION['overload_name'] = "GRUME";
                                            $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                        }
                                    }

                                    //III-THE TRANSPORT IS SET TO GLOBAL WEIGHT
                                    else if ($app_pds_ttl == 1) {
                                        $pds = $_SESSION['value_surcharge'];
                                        $_SESSION['overload_name'] = "POIDS TOTAL";
                                        $_SESSION['overload_mass'] = $_SESSION['value_surcharge'];
                                        //III-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {
                                            //III-2-a CHECK IF OVERLOAD EXISTS
                                            if ($_SESSION['value_surcharge'] > 0) {
                                                $fine = ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                            } else {
                                                $fine = $fraisPESAGEINT;
                                            }
                                        } else {
                                            //III-3 THE TRANSPORT IS THEN NATIONAL
                                            //III-3-a CHECK IF OVERLOAD EXISTS
                                            if ($_SESSION['value_surcharge'] > 0) {
                                                $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                            } else {
                                                $fine = $fraisPESAGENAT;
                                                $_SESSION['overload_mass'] = 0;
                                            }
                                        }
                                    }

                                    //IV-THE TRANSPORT IS NEITHER HYDROCARBURE OR GRUME NOR GLOBAL WEIGHT SO LOGIC GOES AS NORMAL AS USUAL
                                    else {
                                        //IV-1 CHECK WHICH IS BIGGER AMONG ESSIEUX GROUP ESSIEUX AND POIDS VEHICULE
                                        if ($_SESSION['surcharge_gp_essieux'] == $_SESSION['surcharge_essieux']) {
                                            $pds = $_SESSION['surcharge_essieux'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = $overload_axle;
                                        } else if ($_SESSION['surcharge_gp_essieux'] > $_SESSION['surcharge_essieux']) {
                                            $pds = $_SESSION['surcharge_gp_essieux'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = $overload_gp_axle;
                                        } else {
                                            $pds = $_SESSION['surcharge_essieux'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = $overload_axle;
                                        }
                                        if ($_SESSION['value_surcharge'] > $pds) {
                                            $pds = $_SESSION['value_surcharge'];
                                            $_SESSION['overload_mass'] = $pds;
                                            $_SESSION['overload_name'] = "POIDS TOTAL";
                                        } else if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                            $_SESSION['overload_mass'] = 0;
                                            $_SESSION['overload_name'] = "";
                                        }
                                        /*
                                          if ($_SESSION['value_surcharge'] > $_SESSION['surcharge_essieux']) {
                                          $pds = $_SESSION['value_surcharge'];
                                          $_SESSION['overload_mass'] = $pds;
                                          } else {
                                          $pds = $_SESSION['surcharge_essieux'];
                                          $_SESSION['overload_mass'] = $pds;
                                          $_SESSION['overload_name'] = $overload_axle;
                                          }
                                          if ($pds < $_SESSION['surcharge_gp_essieux']) {
                                          $pds = $_SESSION['surcharge_gp_essieux'];
                                          $_SESSION['overload_mass'] = $pds;
                                          $_SESSION['overload_name'] = $overload_gp_axle;
                                          } else {
                                          $_SESSION['overload_name'] = "POIDS TOTAL";
                                          }
                                         */
                                        //IV-2 CHECK IF TRANSPORT IS INTERNATIONAL
                                        if ($_SESSION['transport'] == "INTERNATIONAL") {
                                            //III-2-a CHECK IF OVERLOAD EXISTS
                                            //ORIGINAL ONE:=> if ($_SESSION['value_surcharge'] > 0) {
                                            if ($pds > 0) {
                                                $fine = ($pds * $INFPoidsTotalsAmINT) + $fraisPESAGEINT;
                                            } else {
                                                $fine = $fraisPESAGEINT;
                                            }
                                        } else {
                                            //IV-3 THE TRANSPORT IS THEN NATIONAL
                                            //IV-3-a CHECK IF OVERLOAD EXISTS
                                            //ORIGINAL ONE:=> if ($_SESSION['value_surcharge'] > 0) {
                                            if ($pds > 0) {
                                                $fine = ($pds * $INFPoidsTotalsAmNAT) + $fraisPESAGENAT;
                                            } else {
                                                $fine = $fraisPESAGENAT;
                                            }
                                        }
                                    }
                                    if (isset($_SESSION['infraction'])) {
                                        $_SESSION['montant_paye'] = $fine;
                                        $_SESSION['montant_a_paye'] = $fine + $_SESSION['infraction'];
                                    } else {
                                        $_SESSION['montant_paye'] = $fine;
                                        $_SESSION['montant_a_paye'] = $fine;
                                    }
                                    $var = substr(round($_SESSION['montant_a_paye']), -3);
                                    //echo $var;
                                    //echo '<br/>'.$_SESSION['montant_a_paye'];
                                    if ($var < 250) {
                                        $_SESSION['montant_a_paye'] = $_SESSION['montant_a_paye'] - $var;
                                    } else if ((250 <= $var) && ($var < 750)) {
                                        $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 500;
                                    } else if ((750 <= $var) && ($var < 1000)) {
                                        $_SESSION['montant_a_paye'] = ($_SESSION['montant_a_paye'] - $var) + 1000;
                                    }
                                    ?>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td >
                                                <input style="visibility: hidden;" type="text" list="categoryname" autocomplete="off" id="clients" name="compte_client" class="form-control" value="<?php
                                                $_c = $_SESSION['client'];
                                                echo $_SESSION['client'];
                                                ?>" required>

                                                                                                                                                                                                                                                                   <!-- <h5 style=" color: #8C001A;"><strong>CLIENT : <?php /*
                                             $_c = $_SESSION['client'];
                                             echo $_SESSION['client']; */
                                                ?></strong></h5>-->
                                            </td>
                                            <!--
                                                        <td>
                                            <?php
                                            /* $bills = $_SESSION['montant_a_paye'];
                                              //EXPORTATEUR REQUEST
                                              /* $exportateur = $conn->prepare('SELECT * FROM [COMPTE_CLIENT] WHERE [PREFERENTIEL] = 1'); *
                                              $exportateur = $conn->prepare("SELECT * FROM [COMPTE_CLIENT] WHERE [SOCIETE]= '$_c' AND [SOLDE_COMPTE_CLIENT] > '$bills'");
                                              $exportateur->execute();
                                              $exportateur_result = $exportateur->fetchAll();
                                             * 
                                             */
                                            ?>
                                                            <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="compte_client" class="form-control" placeholder="Choisir le Nº de Compte..." required>
                                                            <datalist id="categoryname">
                                            <?php //foreach ($exportateur_result as $key) {         ?>
                                                                    <option value="<?php //echo rtrim($key['ID_COMPTE_CLIENT']);                   ?>"><?php // echo "Nº " . rtrim($key['ID_COMPTE_CLIENT']) . "=>" . number_format(rtrim($key['SOLDE_COMPTE_CLIENT']), 0, '', '.') . $devise;                   ?></option>
                                            <?php //}         ?>
                                                            </datalist>
                                                        </td>
                                            -->
                                            <td style="float:right;font-size: 3em;">
                                                <h4 style=" color: red;"><strong><u>MONTANT &Agrave; PAYER:</u>&nbsp;&nbsp;<?php
                                                        $bill = $_SESSION['montant_a_paye'];
                                                        echo number_format($_SESSION['montant_a_paye'], 0, '', '.') . " " . $devise;
                                                        ?></strong></h4> 
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- end: FOOTER -->
                            <!-- end: PAGE CONTENT-->
                            <!-- end: PAGE -->
                            <?php
                            //BILL FOR THE RECEIPT
                            $_SESSION['bill'] = $bill;
                            ?>
                            <!-- start: BOOTSTRAP EXTENDED MODALS -->
                            <div id="receipt" class="modal fade" tabindex="-1" data-width="700">
                                <form method="post" action="">
                                    <div class="modal-body" id ="printThis">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                        <div class="row" >
                                            <section   style="width:100%; margin:0 auto;font-size: 11.336px; background-image:url(assets/images/modal.png); background-repeat:no-repeat;">
                                                <img src="assets/images/modalhead.png" id="overlay">
                                                <div id="two">
                                                    <table width="100%" border="0">
                                                        <tr>
                                                            <td colspan="5">
                                                                <div align="center">
                                                                    R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUCTURES ECONOMIQUES 
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
                                                        <tr >
                                                            <td colspan="5">
                                                                <div align="center">
                                                                    STATION DE PESAGE FIXE <?php echo substr($_SESSION['site'], 7); ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div align="left" >
                                                                    <b>
                                                                        Nº VERBALISATION : 
                                                                    </b>
                                                                    <?php echo $_SESSION['num_verb']; ?>
                                                                    <br><br>
                                                                    <b>
                                                                        Nº PES&Eacute;E : 
                                                                    </b>
                                                                    <?php echo $_SESSION['num_pesee_wim']; ?> 
                                                                    <br><br>
                                                                    <b>
                                                                        SOCI&Eacute;T&Eacute;/PROP :
                                                                    </b>
                                                                    <?php echo $societe['valeur_champs']; ?>
                                                                    <br><br>
                                                                    <b>
                                                                        IMMATRICULATION : 
                                                                    </b>
                                                                    <?php
                                                                    $_SESSION['immatriculation'] = $immatriculation['valeur_champs'];
                                                                    echo $immatriculation['valeur_champs'];
                                                                    ?>
                                                                    <br><br>
                                                                    <b>
                                                                        PRODUIT :   
                                                                    </b>
                                                                    <?php echo $produit['valeur_champs']; ?>


                                                                </div>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td>
                                                                <div align="left" >
                                                                    <b>DATE :</b> <?php echo date('d-m-Y H:i:s'); ?> 
                                                                    <br><br>
                                                                    <b>
                                                                        PROV/DEST:</b> <?php echo $provenance['valeur_champs']; ?>
                                                                    <br><br>
                                                                    <b>EXPORTATEUR:</b> <?php echo $_SESSION['exportateur']; ?><br><br>
                                                                    <b>
                                                                        NATIONALIT&Eacute; :
                                                                    </b>
                                                                    <?php echo $_SESSION['nationalite']; ?>

                                                                    <br><br>
                                                                    <b>
                                                                        TRANSPORT : 
                                                                    </b>
                                                                    <?php
                                                                    if ($_SESSION['preferentiel'] != 1) {
                                                                        echo $_SESSION['transport'];
                                                                    } else {
                                                                        echo $_SESSION['transport_affichage'];
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                &nbsp;</td>
                                                            <td>
                                                                <div align="center">
                                                                    <?php
                                                                    echo '<img src="qr_code.php" style="width:100px;"/>';
                                                                    ?>
                                                                    <br>
                                                                    <div align="center" id="modal-silhouette">
                                                                        <?php
                                                                        if ($photo_vehicule['silhouette'] != '') {
                                                                            ?>
                                                                            <img src="<?php echo $photo_vehicule['silhouette']; ?>"/>
                                                                            <br>
                                                                            <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img src="<?php echo 'silhouettes/Type_inconnu.png'; ?>"/>
                                                                            <br>
                                                                            <?php echo $_SESSION['photo_vehicule_link']; ?>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <br>
                                                                        <?php $_SESSION['class_vehicule']; ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" border="1" style=" margin-top:0.5%">
                                                        <tr>
                                                            <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                                                            <th scope="col">POIDS (KG)</th>
                                                            <th scope="col">POIDS MAX (KG)</th>
                                                            <th scope="col"> FORTE SURCHARGE (KG)</th>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:left"><?php echo $_SESSION['class_vehicule']; ?></td>
                                                            <td style="text-align:center"><?php echo $result_P['poids_total_vehicule_Pesee']; ?></td>
                                                            <td style="text-align:center"><?php echo $result_VP['poidsMax_VP']; ?></td>
                                                            <td style="text-align:center">
                                                                <?php
                                                                $val_sur = $result_P['surcharge_Vehicule_Pesee'];
                                                                echo $val_sur;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        foreach ($grpe_ess as $gp_es) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $gp_es['nom_GP']; ?>
                                                                </td>
                                                                <td class="dyp">
                                                                    <?php
                                                                    $_SESSION['poids_total_essieux'] = $gp_es['poids_GP'];
                                                                    echo $gp_es['poids_GP'];
                                                                    ?>
                                                                </td>
                                                                <td class="dyp">
                                                                    <?php echo $gp_es['poidsMax_GP']; ?>
                                                                </td>
                                                                <td class="dyp">
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
                                                            <?php
                                                        }
                                                        $info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' . $_SESSION['num_pesee'] . ' order by surch desc rows 1 to 1');
                                                        $info->execute();
                                                        $essieux = $info->fetch();
                                                        //TO DETERMINE THE ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                        $sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" ,e."nom_EP" as "bigest_overload_ep"
from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where e."id_GP"=g."id_GP" 
and g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" 
and p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by e."nom_EP" order by "high" desc rows 1');
                                                        $sql->execute();
                                                        $result = $sql->fetch();
                                                        $overload_axle = $result["bigest_overload_ep"];
                                                        //CALCUL
                                                        if ($result['high'] < 0) {
                                                            $_SESSION['surcharge_essieux'] = 0;
                                                        } else {
                                                            $_SESSION['surcharge_essieux'] = $result['high'];
                                                        }

                                                        //TO DETERMINE THE GROUP ESSIEUX THAT HAS BIGGEST OVERLOAD
                                                        $sql_gp = $dbh->query('select max(g."poids_GP"-g."poidsMax_GP") as "high_gp",g."nom_GP" as "bigest_overload_gp"
 from "Mobile_Pese" a,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p 
where g."id_MP"=a."id_MP" 
and a."id_VP"=v."id_VP" and 
p."Id_VP"=v."id_VP" 
and p."Numero_Pesee"= ' . $_SESSION['num_pesee'] . ' group by g."nom_GP" order by "high_gp" desc rows 1');
                                                        $sql_gp->execute();
                                                        $result_gp = $sql_gp->fetch();
                                                        $overload_gp_axle = $result_gp["bigest_overload_gp"];
                                                        if ($result_gp['high_gp'] < 0) {
                                                            $_SESSION['surcharge_gp_essieux'] = 0;
                                                        } else {
                                                            $_SESSION['surcharge_gp_essieux'] = $result_gp['high_gp'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td style="text-align:left"><?php echo $essieux['nom_EP']; ?></td>
                                                            <td style="text-align:center"><?php echo $essieux['poidsMesure_EP']; ?></td>
                                                            <td style="text-align:center"><?php echo $essieux['poidsMax_EP']; ?></td>
                                                            <td style="text-align:center">
                                                                <?php
                                                                if ($result['high'] < 0) {
                                                                    $_SESSION['surcharge_essieux'] = 0;
                                                                    echo 0;
                                                                } else {
                                                                    $_SESSION['surcharge_essieux'] = $result['high'];
                                                                    echo $result['high'];
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <table width="100%" border="1" style=" margin-top:0.5%">
                                                        <tr>
                                                            <th scope="col">TYPE D'INFRACTION(S)</th>
                                                            <th scope="col" colspan="2">AMENDE(S)</th>
                                                        </tr>
                                                        <?php
                                                        if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
                                                            for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <?php echo $_SESSION['LIBELLE_TYPE_INF'][$i]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div align="right">
                                                                            <?php echo number_format($_SESSION['MONTANT_INF'][$i], 0, '', '.') . " " . $devise; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="3" style="text-align: center;">
                                                                    <label >
                                                                        <!--<h6>PAS DE FRAUDE </h6>-->
                                                                    </label>
                                                                </td>
                                                            </tr>

                                                        <?php } ?>
                                                        <tr>
                                                            <?php
                                                            if ($_SESSION['value_surcharge'] == 0 && $pds == 0) {
                                                                ?>
                                                                <td colspan='2'>
                                                                    PAS DE SURCHARGE
                                                                </td>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <td>
                                                                    FACTURATION SUR "<?php echo $_SESSION['overload_name']; ?>"
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                            <td align="right">
                                                                <?php echo round($_SESSION['overload_mass']) . " KG"; ?>
                                                            </td>
                                                            <td align="right">
                                                                <?php
                                                                if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                    $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGEINT;
                                                                    if ($var < 250) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                    } else if ((250 <= $var) && ($var < 750)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                    } else if ((750 <= $var) && ($var < 1000)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                    }
                                                                    echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                } else {
                                                                    $_SESSION['prix_pesee_simple'] = $_SESSION['montant_paye'] - $fraisPESAGENAT;
                                                                    if ($var < 250) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var;
                                                                    } else if ((250 <= $var) && ($var < 750)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 500;
                                                                    } else if ((750 <= $var) && ($var < 1000)) {
                                                                        $_SESSION['prix_pesee_simple'] = $_SESSION['prix_pesee_simple'] - $var + 1000;
                                                                    }
                                                                    echo number_format($_SESSION['prix_pesee_simple'], 0, '', '.') . " " . $devise;
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">FRAIS DE PESAGE</td>
                                                            <td><div align="right">
                                                                    <?php
                                                                    /* if ($_SESSION['produit_transporte'] == "GRUME") {
                                                                      echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                      } else */if ($_SESSION['transport'] == "INTERNATIONAL") {
                                                                        echo number_format($fraisPESAGEINT, 0, '', '.') . " " . $devise;
                                                                    } else {
                                                                        echo number_format($fraisPESAGENAT, 0, '', '.') . " " . $devise;
                                                                    }
                                                                    ?>
                                                                </div></td>
                                                        </tr>
                                                    </table>

                                                    <table width="100%" border="0" style=" margin-top:1%">
                                                        <tr>
                                                            <td><u>Copie:</u>ORIGINAL</td>
                                                            <td>  <?php echo $_SESSION['produit_dangereux']; ?></td>
                                                            <td><div align="right">TOTAL &Agrave; PAYER * :</div></td>
                                                            <td  style=" font-size: large"><div align="right"><strong><?php echo number_format($bill, 0, '', '.') . " " . $devise; /* number_format($_SESSION['montant_a_paye'],0,'','.').' '.$devisePARAM; */ ?></strong></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Op&eacute;rateur de pesage: <?php echo $_SESSION['login_utilisateur'] ?></td>
                                                        </tr>
                                                    </table>
                                                    <table align="right" style="margin-top:1%">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                           <td><div align="center"><strong> *PREVOIR 100 F POUR LES FRAIS DE TIMBRE D'ETAT  </strong></div></td>
                                                            <td><div align="left"><?php echo date('d-m-Y H:i:s'); ?></div></td>
                                                        </tr>
                                                    </table>
                                                    <?php
                                                    if ($_SESSION['poid_total'] >= ($_SESSION['ptac'] * 140 / 100)) {
                                                        ?>
                                                        <table width="100%">
                                                            <tr>
                                                                <td><div align="center"><strong>
                                                                            <?php
                                                                            $surcharge_ext = $_SESSION['poid_total'] - $_SESSION['ptac'];
                                                                            $warning_fine_nat = ($surcharge_ext * $AmendeExtremeSurNat) + $fraisPESAGENAT;
                                                                            $warning_fine_int = ($surcharge_ext * $AmendeExtremeSurInt) + $fraisPESAGEINT;
                                                                            ?>
                                                                            <strong style="color:#861D20">
                                                                                ****************************************************************************************************************************************************************************<br>
                                                                                ATTENTION!! VOUS ETES EN EXTREME SURCHARGE DE  <strong style=" font-size: medium"><?php echo number_format($surcharge_ext, 0, '', '.') . "KG"; ?></strong> VOUS SEREZ BIENTOT FACTUR&Eacute; &Agrave; <strong style="font-size:medium;"> <?php
                                                                                    if ($_SESSION['transport'] != "INTERNATIONAL") {
                                                                                        echo number_format($warning_fine_nat, 0, '', '.') . " " . $devise;
                                                                                    } else {
                                                                                        echo number_format($warning_fine_int, 0, '', '.') . " " . $devise;
                                                                                    }
                                                                                    ?> </strong> 
                                                                                <br>****************************************************************************************************************************************************************************</strong>

                                                                        </strong></div></td>
                                                            </tr>
                                                        </table>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <table width="100%" border="1" style="margin-top:1%">
                                                            <tr>
                                                                <td><div align="center"><strong>AFRIQUE PESAGE SA | Site web : www.afriquepesage.com | TEL: +225 21 35 35 20/+225 21 35 64 47</strong></div></td>
                                                            </tr>
                                                        </table>
                                                        <?php
                                                    }
                                                    ?>
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
                            <?php
                        }
                    }
                    ?>
                    <div style="text-align:center;width: 50%; margin: 0 auto;">
                        <div class="footer-inner">
                            AFRIQUE PESAGE S.A c&ocirc;te d'ivoire - Abidjan - Zone 4C, Rue du docteur CALMETTE - Adresse:16
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
                </div>
                <!-- end: END MAIN CONTAINER -->
            </div>
            <!-- end: END MAIN CONTAINER -->
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
                    var frm_element = document.getElementById('clients').value;
                    printElement(document.getElementById("printThis"));
                    /* printElement(document.getElementById("printThisToo"), true, "<hr />");*/
                    window.print();
                    $.ajax({
                        type: 'POST',
                        data: {dyp: frm_element},
                        url: 'verbalisation.php',
                        success: function (data) {
                            if (data != 'Error') {
                                alert(data);
                                window.location.href = 'insert_Wim.php';
                            } else {
                                alert('ERREUR! RECOMMENCER');
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
    <?php
} else {
    echo "<script>
                    alert('VERBALISATION DEJA ENREGISTREE');
                window.location.href='intro_operateur.php';
                </script>";
}
}
?>