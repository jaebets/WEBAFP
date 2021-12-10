<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
include 'connections/AfriquepesageConnection.php';
$idt = $_GET['id'];
session_start();
if (empty($_SESSION['login_utilisateur'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header("Location:index.php");
    exit();
}
//liste des types user
$typeusers = "SELECT [ID_TYPE_UTILISATEUR],[LIBELLE_TYPE_UTILISATEUR] ,[ABREVIATION]FROM [dbo].[TYPE_UTILISATEUR]";
$typ = $conn->query($typeusers);
$totaltype = $typ->fetchAll();

//liste des sites
$selectsite = "SELECT [NUM_S] ,[NOM_S] ,[ADRESSE_S] ,[CODEPOSTAL_S] ,[VILLE_S] ,[PAYS_S] ,[CONTACT_S] ,[TEL_S] ,[FAX_S] ,[EMAIL_S] ,[LOGO_S] ,[COMMENTAIRE_S] FROM [dbo].[SITE]";
$listsite = $conn->query($selectsite);
$totalsite = $listsite->fetchAll();

//selection User
$nbre = "SELECT *FROM [Afriquepesage].[dbo].[UTILISATEUR] WHERE [ID_USER]='" . $idt . "'";
$nbreuser = $conn->query($nbre);
$totuser = $nbreuser->fetch();

//site du user
$selectsite1 = "SELECT [NUM_S] ,[NOM_S] FROM [dbo].[SITE] WHERE [NUM_S]='" . $totuser['NUM_S'] . "'";
$listsite1 = $conn->query($selectsite1);
$totalsite1 = $listsite1->fetch();

//Type du USER
$typeusers1 = "SELECT [ID_TYPE_UTILISATEUR],[LIBELLE_TYPE_UTILISATEUR] ,[ABREVIATION]FROM [dbo].[TYPE_UTILISATEUR] WHERE [ID_TYPE_UTILISATEUR]='" . $totuser['ID_TYPE_UTILISATEUR'] . "'";
$typ1 = $conn->query($typeusers1);
$totaltype1 = $typ1->fetch();

//Modification
if (isset($_POST['modifier'])) {
    $idt = $_GET['id'];
    //confirmation
        if (isset($_POST['mp1']) && isset($_POST['mp2'])) {

            if (($_POST['mp1'] != $_POST['mp2']) || (strlen($_POST['mp1']) < 6)) {

                /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') . ": Tentative de modification du mot de passe echouée lors de la pemiere connexion par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
                $info = "ERREUR SUR LE MOT DE PASSE! VERIFIEZ SA TAILLE OU SON EXACTITUDE";
                echo
                '<script type="text/javascript" language="javascript">
                alert("' . $info . '");
            </script>';
            } else {
                $m_p_s = md5($_POST['mp1']);
                $m_p = md5($m_p_s);
                echo'<script>
        if (!(confirm("Voulez vous enregistrer les modifications"))) { 
   window.location.href="utilisateurs.php";} </script>';
                //modification en cas de confirmation
                $requpdate = "UPDATE [Afriquepesage].[dbo].[UTILISATEUR] SET [CONTACT_UT]=?, [COURRIEL_UT]=?, [MP_UT]=?, [MP_UT_C]=? WHERE [ID_USER]='" . $idt . "'";
                $requpdate1 = $conn->prepare($requpdate);
                $requpdate1->execute(array($_POST['contacts'], $_POST['courriel'], $m_p, 1));
                if ($requpdate1) {
                    /*                     * *****************************JOURAL ENTRY****************** */
                    $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                    $log = "*" . date('d-m-Y H:i:s') . ": Modification des infos de l'uilisateur *" . preg_replace('/\s+/', '', $_POST['nom']) . " *" . $_POST['prenom'] . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                    fwrite($login_log, $log);
                    fclose($login_log);
                    /*                     * *************************************************************** */
                    echo "<script>alert('INFORMATION MODIFIEE'); window.location.href='logout.php';</script>";
                }
            }
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
            <link rel="shortcut icon" href="favicon.ico" />
           <style>

              /*   html,body {
                    margin: 0;
                    padding: 0;
                    overflow: hidden;
                }
                */
            .mod  {
                color:  #8C001A;
                
            </style>
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
            <?php //echo $INFRECAmNAT;    ?>
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
                                                        &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];?></a></li>
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

                                    <h1>GESTION UTILISATEURS <small>Afrique Pesage </small></h1>
                                    <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                                </div>
                                <!-- end: PAGE TITLE & BREADCRUMB -->
                            </div>
                        </div>
                        <!-- end: PAGE HEADER -->
                        <!-- end: PAGE HEADER -->
                        <div class="col-sm-12">

                            <form method="POST" action="">
                                <div align="center">
                                    <strong><span style="color: red"> Modification</span></strong><br/><br/>
                                    <table border="0" width="600">
                                        <tr>
                                            <td><label class="col-sm-10 control-label">Nom & Pr&eacute;noms</label></td> 
                                            <td><input type="text" value="<?php echo preg_replace('/\s+/', '', $totuser['NOM_UT']) . " " . preg_replace('/\s+/', '', $totuser['PRENOM_UT']); ?>" name="nom" id="form-field-1" class="form-control" required placeholder="" readonly="true"> </input> </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">type Utilisateur</label> </td>
                                            <td><input type="text" value="<?php echo $totaltype1['LIBELLE_TYPE_UTILISATEUR']; ?>" name="prenom" id="form-field-1" class="form-control" required placeholder="" readonly="true"> </input> </td>
                                        </tr> 
                                        <tr>
                                            <td><label class="col-sm-10 control-label">Site</label></td>
                                            <td><input type="text" value="<?php echo $totalsite1['NOM_S']; ?>" name="prenom" id="form-field-1" class="form-control" required placeholder="" readonly="true"> </input> </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">Contacts </label></td>
                                            <td><input type="text" value="<?php echo $totuser['CONTACT_UT']; ?>" name="contacts" id="form-field-1" class="form-control" required placeholder="" > </input></td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">Courriel</label> </td>
                                            <td><input type="email" value="<?php echo $totuser['COURRIEL_UT']; ?>" name="courriel" id="form-field-1" class="form-control" required placeholder="mail@email.com" > </input> </td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-10 control-label">Mot de Passe </label></td>
                                        <td><input type="password" value="" name="mp1" id="form-field-1" class="form-control" required placeholder="Minimum 6 characters"> </input></td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-10 control-label">Confirmez Le Mot de Passe</label> </td>
                                        <td><input type="password" value="" name="mp2" id="form-field-1" class="form-control" required placeholder="Minimum 6 characters"> </input> </td>
                                    </tr>
                                </table>
                                    <br><br> 
                                    <div style="width: 100px; margin: 0 auto;">
                                        <input type="submit" value="Modifier" name="modifier" class="btn btn-green btn-lg"/>
                                    </div>
                            </div>
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
    </body>
    <!-- end: BODY -->
</html>