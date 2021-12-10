<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
$nom_site = $_SESSION['site'];
if ($_SESSION['first_connect'] != 1) {

    $id_u = preg_replace('/\s+/', '', $_SESSION['userid']);
    echo "<script>alert('C\'EST VOTRE PREMIERE CONNEXION, VEUILLEZ MODIFIER LE MOT DE PASSE AVANT DE CONTINUER'); window.location.href='first_connect.php?id=$id_u';</script>";
} else {
    if (isset($_POST['edit_dyp'])) {
        $dyp1 = md5($_POST['old']);
        $dyp2 = md5($dyp1);
        if ($dyp2 == preg_replace('/\s+/', '', $_SESSION['dyp'])) {
            if ($_POST['new1'] == $_POST['new2']) {
                $dyp = md5($_POST['new1']);
                $m_a = md5($dyp);
                $sql = "UPDATE [dbo].[UTILISATEUR] SET [MP_UT] = ? WHERE [ID_TYPE_UTILISATEUR] = 4 AND [LOGIN_UT] =?";
                $q = $conn->prepare($sql);
                $q->execute(array($m_a, $_SESSION['m_a']));
                if ($q) {
                    /*                     * *****************************JOURAL ENTRY****************** */
                    $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                    $log = "*" . date('d-m-Y H:i:s') . ": Mot de passe modifié par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . " \n\n";
                    fwrite($login_log, $log);
                    fclose($login_log);
                    /*                     * *************************************************************** */
                    echo "<script>
                    alert('MOT DE PASSE MODIFIE');
                window.location.href='logout.php';
                </script>";
                }
            } else {
                /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') . ": Erreur Effectuée pendant la modification du mot de passe par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . " \n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
                echo "<script>
                    alert('LES MOTS DE PASSE NE CORRESPONDENT PAS');
                window.location.href='intro_admin.php';
                </script>";
            }
        } else {
            /*             * *****************************JOURAL ENTRY****************** */
            $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
            $log = "*" . date('d-m-Y H:i:s') . ": Erreur Effectuée pendant la modification du mot de passe par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . " \n\n";
            fwrite($login_log, $log);
            fclose($login_log);
            /*             * *************************************************************** */
            echo "<script>
                    alert('ERREUR DE MOT DE PASSE');
                window.location.href='intro_admin.php';
                </script>";
        }
    }
    //header("Refresh:5");
//echo session_id()
    $_SESSION['test'] = 0;
    include 'connections/FirebirdConnection.php';
    include 'connections/AfriquepesageConnection.php';
    unset($_SESSION['LIBELLE_TYPE_INF']);
    unset($_SESSION['MONTANT_INF']);
    unset($_SESSION['CODE_TYPE_INF']);
    unset($_SESSION['LIBELLE_CODE_INF']);
    $sth = $dbh->prepare('SELECT a."Numero_Pesee", a."Id_VP", a."Date_Pesee", a."Heure_Pesee", a."Unite_Mesure_Pesee", a."Vitesse_Moyenne_Pesee", a."Acceleration_Moyenne_Pesee", a."Selectionne_Pesee", a."Photo_Pesee", a."Commentaire_Pesee", a."Utilisateur_Pesee", a."poids_total_vehicule_Pesee", a."surcharge_Vehicule_Pesee", a."Vitesse_Min_Pesee", a."Vitesse_Max_Pesee", a."Erreur_Pesee", a."Type_Pesee", a."position_virgule", a.RDB$DB_KEY FROM "Pesee" a ORDER BY a."Numero_Pesee" DESC rows 1 to 1');
    $sth->execute();
    $result = $sth->fetch();
    $num_pesee = $result["Numero_Pesee"];
    $libelle = array();
    $montant = array();
    $code = array();
    $libelle_code = array();

    if (isset($_POST['search'])) {
        if (isset($_POST['produit_dangeureux'])) {
            if ($_POST['produit_dangeureux'] != "") {
                $_SESSION['produit_dangeureux'] = $_POST['produit_dangereux'];
            }
        }
        $verb = 'V' . $_POST['num_pesee'] . date('my') . $_SESSION['num_site'];
        $date_entry = date('d-m-Y');

//CHECK VERBALISATION NUMBER
        $count = "SELECT COUNT(*) OVER (PARTITION BY 1) as RowCnt FROM [Afriquepesage].[dbo].[VERBALISATION] where [ID_VERB] ='$verb' AND [DATE_VERB] ='$date_entry'";
        $users = $conn->query($count);
        $total_verba = $users->fetch();

//CHECK PREFERENTIAL CLIENT
        $client = $_POST['client'];
        $count_client = "SELECT COUNT(*) OVER (PARTITION BY 1) as RowCnt FROM [Afriquepesage].[dbo].[COMPTE_CLIENT] where [PREFERENTIEL] =1 AND [SOCIETE] ='$client'";
        $c_cl = $conn->query($count_client);
        $total_client = $c_cl->fetch();




        if ($total_verba > 0) {
            echo "<script>
              alert('PESEE DEJA VERBALISEE');
              window.location.href='intro_operateur.php';
         </script>"
            ;
        } else if ($_POST['num_pesee'] > $num_pesee) {
            //echo $_POST['num_pesee']."<br>".$num_pesee;
            echo "<script>
              alert('PESEE INEXISTANTE');
              window.location.href='intro_operateur.php';
        </script>";
            /*
              for ($i = 0;
              $i > sizeof($_POST['listeinf']);
              $i++) {
              if ($_POST['listeinf'][$i] != '') {

              }
              }
              //$_SESSION[''] = ;
             */
        }
        /*
          else if ($total_client == 0 && $_POST['transport'] == "PREFERENTIEL") {
          echo "<script>
          alert('CET EXPORTATEUR NE BENEFICIE PAS DU TARIF PREFERENTIEL');
          window.location.href='intro_operateur.php';
          </script>"
          ;
          }
         */ else if (($total_client > 0 && $_POST['transport'] == "INTERNATIONAL") || ($total_client > 0 && $_POST['transport'] == "NATIONAL")) {
            echo "<script>
              alert('CET EXPORTATEUR BENEFICIE DU TARIF PREFERENTIEL! CE TARIF LUI SERA APPLIQUE');
         </script>"
            ;

            $_SESSION['transport'] = "PREFERENTIEL";
            $_SESSION['nationalite'] = $_POST['nationalite'];
            $_SESSION['client'] = $_POST['client'];
            $_SESSION['exportateur'] = $_POST['exportateur'];
            $_SESSION['citern'] = $_POST['citern'];
            $_SESSION['infraction'] = $_POST['listeinf'];
            if (isset($_POST['produit_dangereux'])) {
                $_SESSION['produit_dangereux'] = $_POST['produit_dangereux'];
            } else {
                $_SESSION['produit_dangereux'] = "";
            }


            /*
              if (isset($_POST['transport'])) {
             */
//INFRACTIONS LIST
            $nbreInf = "SELECT [CODE_TYPE_INF],[LIBELLE_TYPE_INF],[MONTANT_INF_INT],[LIBELLE_CODE_INF] FROM [Afriquepesage].[dbo].[TYPE_INFRACTION]";
            $nbreinfra = $conn->query($nbreInf);
            $totinf = $nbreinfra->fetchAll();
//CHECK INFRACTION
            foreach ($totinf as $key) {
                if (isset($_POST[$key['LIBELLE_CODE_INF']])) {
                    $_SESSION['infraction'] = $_SESSION['infraction'] + $key['MONTANT_INF_INT'];
                    $_SESSION['LIBELLE_TYPE_INF'][] = $key['LIBELLE_TYPE_INF'];
                    $_SESSION['MONTANT_INF'][] = $key['MONTANT_INF_INT'];
                    $_SESSION['CODE_TYPE_INF'][] = $key['CODE_TYPE_INF'];
                    $_SESSION['LIBELLE_CODE_INF'][] = $key['LIBELLE_CODE_INF'];
                }
            }
            $_SESSION['num_pesee'] = $_POST['num_pesee'];
            $_SESSION['date_wim_pesee'] = $result["Date_Pesee"];
            header("location: operateur_verbalisation.php");
            die;
        } else {
            $_SESSION['nationalite'] = $_POST['nationalite'];
            $_SESSION['client'] = $_POST['client'];
            $_SESSION['exportateur'] = $_POST['exportateur'];
            $_SESSION['citern'] = $_POST['citern'];
            $_SESSION['infraction'] = $_POST['listeinf'];
            $_SESSION['transport'] = $_POST['transport'];


            /*
              if (isset($_POST['transport'])) {
             */
//INFRACTIONS LIST
            $nbreInf = "SELECT [CODE_TYPE_INF],[LIBELLE_TYPE_INF],[MONTANT_INF_INT],[LIBELLE_CODE_INF] FROM [Afriquepesage].[dbo].[TYPE_INFRACTION]";
            $nbreinfra = $conn->query($nbreInf);
            $totinf = $nbreinfra->fetchAll();
//CHECK INFRACTION
            foreach ($totinf as $key) {
                if (isset($_POST[$key['LIBELLE_CODE_INF']])) {
                    $_SESSION['infraction'] = $_SESSION['infraction'] + $key['MONTANT_INF_INT'];
                    $_SESSION['LIBELLE_TYPE_INF'][] = $key['LIBELLE_TYPE_INF'];
                    $_SESSION['MONTANT_INF'][] = $key['MONTANT_INF_INT'];
                    $_SESSION['CODE_TYPE_INF'][] = $key['CODE_TYPE_INF'];
                    $_SESSION['LIBELLE_CODE_INF'][] = $key['LIBELLE_CODE_INF'];
                }
            }
            /* THIS PORTION WAS PART OF THE ORIGINAL CODE WHERE WE ONLY ADD INTERNATIONAL AND NATIONAL
             * NOW THE IF-ELSE STATEMENT IS NO LONGER REUIRED SINCE WE HAVE THREE TYPES OF TRANSPORT 
             * WE LEFT THE CODE 'CUZ WE MAY NEED THAT.
             * THE FIRST LOGIC IN THE TWO TRANSPORT TYPE WAS IF THE $_POST['TRANSPORT'] WAS SET THEN THAT WOULD MEAN THAT
             * IT'S AN INTERNATIONAL ONE OTHERWISE (IF IT'S NOT SET) THE TRANSPORT IS NATIONAL.
             * WE COMMEDTED THAT BECAUSE NATIONAL AND PREFERED ARE DEALT THE SAME WAY! THAT MEANS THAT THE BILL IS HANDLE THE SAME WAY SO NO NEED TO ADD
             * ONE MORE CONDITION AND THE BILLING CONDITION IS DEALT IN THE OPEEATEUR_VERBALISATION.PHP FILE BECAUSE WE NEED TO INSERT THE RIGHT TYPE 
             * OF TRANSPORT FOR OUR INTERNAL STATS
             * 
              } else {
              $_SESSION['transport'] = 'NATIONAL';
              //INFRACTIONS LIST
              $nbreInf = "SELECT [CODE_TYPE_INF],[LIBELLE_TYPE_INF],[MONTANT_INF_NAT],[LIBELLE_CODE_INF] FROM [Afriquepesage].[dbo].[TYPE_INFRACTION]";
              $nbreinfra = $conn->query($nbreInf);
              $totinf = $nbreinfra->fetchAll();
              //CHECK INFRACTION
              foreach ($totinf as $key) {
              if (isset($_POST[$key['LIBELLE_CODE_INF']])) {
              $_SESSION['infraction'] = $_SESSION['infraction'] + $key['MONTANT_INF_NAT'];
              $_SESSION['LIBELLE_TYPE_INF'][] = $key['LIBELLE_TYPE_INF'];
              $_SESSION['MONTANT_INF'][] = $key['MONTANT_INF_NAT'];
              $_SESSION['CODE_TYPE_INF'][] = $key['CODE_TYPE_INF'];
              $_SESSION['LIBELLE_CODE_INF'][] = $key['LIBELLE_CODE_INF'];
              }
              }
              }
             */
            $_SESSION['num_pesee'] = $_POST['num_pesee'];
            $_SESSION['date_wim_pesee'] = $result["Date_Pesee"];
            if (isset($_POST['produit_dangereux'])) {
                $_SESSION['produit_dangereux'] = $_POST['produit_dangereux'];
            } else {
                $_SESSION['produit_dangereux'] = "";
            }
            header("location: operateur_verbalisation.php");
            die;
        }
    }
    if (isset($_POST['search_duplicata'])) {
        $duplicata_pesee = $_POST['duplicata_pesee'];
        $sth = $dbh->prepare("SELECT [ID_VERB],[ID_USER],[NUMERO_PESE],[DATE_VERB],[DATE_PESEE_WIM],[NATIONALITE],[TRANSIT],[PDPUIT_DANGE],[INF_GABARIT],[LOGIN_OP],[AMENDE_TOTAL],[OBSERVATION_VERB],[IMMAT_VEHICULE],[PRODUIT_TRANSPORTE],[PROV_DEST],[NOM_STE],[POIDS_TOTAL],[CLASSE_VEHICULE],[PAIMENT_VERBA],[MONTANT_AMENDE_PAYE],[MONTANT_RESTANT],[NOM_CLIENT] FROM [Afriquepesage].[dbo].[VERBALISATION] where [NUMERO_PESE] ='$duplicata_pesee' AND WHERE [NOM_STE] = '$nom_site' ");
        $sth->execute();
        $result = $sth->fetch();

        if ($result["ID_VERB"] != '') {
            $_SESSION['duplicata_id_verb'] = $result["ID_VERB"];
            header("location: duplicata.php");
            die;
        } else {
            $message = "Le numero de pes&eacute;e n'existe pas dans la base de donn&eacute;es SAGE WIM";
            header("location: intro_operateur.php");
            die;
        }
    } else {
        
    }
//liste des infractions
    $nbreInf = "SELECT * FROM [dbo].[TYPE_INFRACTION]";
    $nbreinfra = $conn->query($nbreInf);
    $totinf = $nbreinfra->fetchAll();

//DUPLICATA REQUEST
    $num = $conn->prepare("SELECT TOP 1 [NUMERO_PESE] FROM [Afriquepesage].[dbo].[VERBALISATION] WHERE [NOM_STE] = '$nom_site' ORDER BY [NUMERO_PESE] DESC");
    $num->execute();
    $num_result = $num->fetch();
    $number = $num_result["NUMERO_PESE"];

//COUNTRIES REQUEST
    $countries = $conn->prepare('SELECT * FROM [Afriquepesage].[dbo].[COUNTRIES]');
    $countries->execute();
    $countries_result = $countries->fetchAll();

//EXPORTATEUR REQUEST
    /* $exportateur = $conn->prepare('SELECT * FROM [Afriquepesage].[dbo].[COMPTE_CLIENT] WHERE [PREFERENTIEL] = 1'); */
//$exportateur = $conn->prepare('SELECT DISTINCT * FROM [Afriquepesage].[dbo].[COMPTE_CLIENT] ');
    $exportateur = $conn->prepare('SELECT DISTINCT [SOCIETE] FROM [Afriquepesage].[dbo].[COMPTE_CLIENT]');
    $exportateur->execute();
    $exportateur_result = $exportateur->fetchAll();
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
            <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
            <link rel="shortcut icon" href="favicon.ico" />
            <script type="text/JavaScript">
                function valid(f) {
                !(/^[0-9#209#241]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209#241]/ig,''):null;
                }
                function valid2(f) {
                !(/^[A-z0-9&#209;&#241; ]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241; ]/ig,''):null;
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
                #responsive{
                    width: 400px !important;
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
                                                    <a href="#"><i class="clip-home-2"></i>
                                                        &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                         ?></a></li>
                                                <li>
                                                    <a href="#edit" data-toggle = "modal"><i class="clip-locked"></i>
                                                    &nbsp;Changer le Mot de passe </a>
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
                                        Tableau de Bord <small>Op&eacute;rateur </small></h1>
                                    <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                                </div>
                                <!-- end: PAGE TITLE & BREADCRUMB -->
                            </div>
                        </div>
                        <!-- end: PAGE HEADER -->
                        <!-- start: PAGE CONTENT -->
                        <!-- start: PAGE CONTENT -->
                        <div class="row">
                            <div class="col-sm-12" style="margin-top:0.5%;">
                                <!-- start: RESPONSIVE ICONS BUTTONS PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="color:#8C001A;">
                                        <i class="clip-menu-3 "></i>
                                        <?php echo $_SESSION['site']; ?> 
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <!--<a href="javascript:window.location.reload()">-->
                                                <div class="col-sm-4" >
                                                    <a href = "#responsive" data-toggle = "modal" class="btn btn-icon btn-block">
                                                        <i class="clip-truck"></i>
                                                        VERBALISATION <span class="badge badge-danger"> <i class="clip-truck"></i> </span>
                                                    </a>
                                                </div>
                                            <!--</a>-->
                                            <div class="col-sm-4">
                                                <a href = "#duplicata" data-toggle = "modal" class="btn btn-icon btn-block" >
                                                    <i class="clip-images"></i>
                                                    DUPLICATA <span class="badge badge-danger"> <i class=" clip-images"></i> </span>
                                                </a>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="operateur_recap.php" class="btn btn-icon btn-block">
                                                    <i class="fa fa-barcode"></i>
                                                    RECAPITULATIF <span class="badge badge-danger"> <i class="fa fa-barcode"></i> </span>
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
                <!--start: BOOTSTRAP EXTENDED MODALS FOR VERBALISATION-->
                <div id = "responsive" class = "modal fade" tabindex = "-1" data-width = "300" style = "display: none;">
                    <div class = "modal-header">
                        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                            &times;
                        </button>
                        <h6 class = "modal-title mod">INFORMATIONS DE VERBALISATION</h6>
                    </div>
                    <form method="post" id="search_form" action="">
                        <div class = "modal-body">
                            <div class = "row">
                                <div class = "col-md-12">
                                    <p >
                                        <input id="pat" class = "form-control" type = "text" name="num_pesee" value="<?php echo $num_pesee; ?>"style="text-align:center; "onkeyup="valid(this)" onblur="valid(this)"/>
                                        <span>
                                            <?php
                                            if (!isset($message)) {
                                                
                                            } else {
                                                echo $message;
                                            }
                                            ?>
                                        </span>
                                    </p>

                                    <table width="100%" border="0">
                                        <tr>
                                            <td><label class="col-sm-10 control-label" for="form-field-5">
                                                    CLIENT
                                                </label></td>
                                            <td>
                                                <input type="text" list="catgoryname" autocomplete="off" id="pcatgory" name="client" class="form-control" onkeyup="valid2(this)" onblur="valid2(this)" required>
                                                <datalist id="catgoryname">
                                                    <?php foreach ($exportateur_result as $keys) { ?>
                                                        <option value="<?php echo rtrim($keys['SOCIETE']); ?>"><?php echo rtrim($keys['SOCIETE']); ?></option>
                                                    <?php } ?>
                                                </datalist>
                                            </td>
                                            <!--<td><input id="form-field-1" class="form-control" name="exportateur" value="" type="text" placeholder=""  required/></td>-->
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label" for="form-field-5">
                                                    PAYS ORIGINE
                                                </label></td>
                                            <td>
                                                <input type="text" list="categoryname" autocomplete="off" id="pcategory" name="nationalite" class="form-control" onkeyup="valid2(this)" onblur="valid2(this)" required>
                                                <datalist id="categoryname">
                                                    <?php foreach ($countries_result as $key) { ?>
                                                        <option value="<?php echo rtrim($key['name']); ?>"><?php echo rtrim($key['name']); ?></option>
                                                    <?php } ?>
                                                </datalist>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label" for="form-field-5">
                                                    EXPORTATEUR
                                                </label></td>
                                            <td>
                                                <input id="form-field-1" class="form-control" name="exportateur" value="" type="text" placeholder="" onkeyup="valid2(this)" onblur="valid2(this)" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label" for="form-field-5">
                                                    CITERNE
                                                </label></td>
                                            <td>
                                                <select name="citern" id="form-field-1" class="form-control" required>
                                                    <option value="non">NON</option>
                                                    <option value="oui">OUI</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="produit_dangereux" class="flat-red" value="PRODUIT DANGEUREUX" >
                                                    Produit dangereux
                                                </label>
                                            </td>
                                        </tr>
                                        <?php
                                        foreach ($totinf as $toti) {
                                            ?>
                                            <tr>
                                                <td valign="top">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="<?php echo $toti['LIBELLE_CODE_INF']; ?>" class="flat-red" value="<?php echo $toti['CODE_TYPE_INF']; ?>" >
                                                        <?php echo $toti['LIBELLE_TYPE_INF']; ?>
                                                    </label>
                                                </td>
                                                <!--<td valign="top"><input type="text" id="<?php //echo $toti['CODE_TYPE_INF'];             ?>" name="amende[]" size="12"/> </td>-->
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td style="width:201px;">
                                                <h6 class = "modal-title mod">TYPE DE TRANSPORT:</h6>
                                                <label class="checkbox-inline" for="form-field-5">

                                                    <input type="radio" name="transport" class="flat-red" value="NATIONAL" required/>
                                                    NAT&nbsp;&nbsp;
                                                    <input type="radio" name="transport" class="flat-red" value="INTERNATIONAL"/>
                                                    &nbsp;INTER
                                                    <!--&nbsp;&nbsp;<input type="radio" name="transport" class="flat-red" value="PREFERENTIEL"/>
                                                    <span style="color:#8C001A;"><strong>PR&Eacute;F</strong></span>-->
                                                </label>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class = "modal-footer">
                            <button type = "button" data-dismiss = "modal" class = "btn btn-light-grey">
                                FERMER
                            </button>
                            <button type = "submit" class = "btn btn-blue" name="search">
                                RECHERCHER
                            </button>
                        </div>
                    </form>
                </div>
                <!-- end: BOOTSTRAP EXTENDED MODALS FOR VERBALISATION-->
                <!--start: BOOTSTRAP EXTENDED MODALS FOR DUPLICATA-->
                <div id = "duplicata" class = "modal fade" tabindex = "-1" data-width = "300" style = "display: none;">
                    <div class = "modal-header">
                        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                            &times;
                        </button>
                        <h6 class = "modal-title mod">ENTRER LE NUM&Eacute;RO DE VERBALISATION</h6>
                    </div>
                    <form method="post" id="search_form" action="duplicata.php">
                        <div class = "modal-body">
                            <div class = "row">
                                <div class = "col-md-12">
                                    <p >
                                        <input class = "form-control" type = "text" name="duplicata" value="<?php echo $number; ?>"style="text-align:center;"/>
                                        <span>
                                            <?php
                                            if (!isset($message)) {
                                                
                                            } else {
                                                echo $message;
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class = "modal-footer">
                            <button type = "button" data-dismiss = "modal" class = "btn btn-blue">
                                FERMER
                            </button>
                            <button type = "submit" class = "btn btn-red" name="search_duplicata">
                                RECHERCHER
                            </button>
                        </div>
                    </form>
                </div>
                <!-- end: BOOTSTRAP EXTENDED MODALS FOR VERBALISATION-->
                
                <div id = "edit" class = "modal fade" tabindex = "-1" data-width = "300" style = "display: none;">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                        &times;
                    </button>
                    <h6 class = "modal-title mod">CHANGER VOTRE MOT DE PASSE</h6>
                </div>
                <form method="post" id="search_form" action="">
                    <div class = "modal-body">
                        <div class = "row">
                            <div class = "col-md-12">
                                <p>
                                    <input class = "form-control" type = "password" name="old" value="" placeholder="Ancien mot de passe" style="text-align:center;"/>
                                </p>
                                <p>
                                    <input class = "form-control" type = "password" name="new1" value="" placeholder="Nouveau mot de passe" style="text-align:center;"/>
                                </p>
                                <p>
                                    <input class = "form-control" type = "password" name="new2" value="" placeholder="Confirmer le mot de passe" style="text-align:center;"/>
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
            <script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
            <script src="assets/js/main.js"></script>
            <!-- end: MAIN JAVASCRIPTS -->
            <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
            <script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
            <script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
            <script src="assets/js/ui-modals.js"></script>
            <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
            <script type="text/javascript">
                                                    $('#responsive').on('show.bs.modal', function (e) {
                                                        // javascript:location.reload();
                                                        //if (!data) return e.preventDefault() // stops modal from being shown
                                                        $.ajax({
                                                            type: 'POST',
                                                            data: 'hello',
                                                            url: 'intro_resp_site.php',
                                                            success: function (data) {
                                                                if (data != 'Error') {
                                                                    document.getElementById('pat').value = data;
                                                                    //alert(data);
                                                                } else {
                                                                    alert('ERREUR! RECOMMENCER');
                                                                }
                                                            },
                                                            error: function () {
                                                                /*console.log(data);*/
                                                                alert('ERREUR! RECOMMENCER');
                                                            }
                                                        });
                                                    })
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

    <?php
}
?>