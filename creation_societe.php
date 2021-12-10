<?php
/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
include 'connections/AfriquepesageConnection.php';
session_start();
if (empty($_SESSION['login_utilisateur'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header("Location:index.php");
    exit();
}
?>
<?php
//enregistrement des données dans la table UT
//if (isset($_POST['enregistrer'])){
//echo $_POST['nom'];
if (isset($_POST['enregistrer'])) {
        $req = "INSERT INTO [dbo].[Site] ([num_S],[nom_S] ,[nom_S1],[adresse_S] ,[codePostal_S] ,[ville_S],[pays_S] , [tel_S] ,[fax_S],[email_S],[commentaire_S]) 
		 VALUES(:num_S,:nom_S,:nom_S1,:adresse_S,:codePostal_S,:ville_S,:pays_S,:tel_S,:fax_S,:email_S,:commentaire_S)";
        $name= 'STATION DE '.$_POST['ville'];
        $name2= 'STATION '.$_POST['ville'];

    $q = $conn->prepare($req);
    $q->execute(array(':num_S' => $_POST['site'],
        ':nom_S' => $name,
        ':nom_S1' => $name2,
        ':adresse_S' => $_POST['adresse'],
        ':codePostal_S' => $_POST['code_post'],
        ':ville_S' => $_POST['ville'],
        ':pays_S' => $_POST['pays'],
        ':tel_S' => $_POST['telephone'],
        ':fax_S' => $_POST['fax'],
        ':email_S' => $_POST['email'],
        ':commentaire_S' => $_POST['commentaire']));
        
            if ($q) {
                /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/sites/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') . ": NOUVEAU SITE*" . $name . " CREE PAR *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
                echo "<script>alert('SITE CREE'); window.location.href='creation_site.php';</script>";
            }
}
$info = "";


//fin
//$userscount = "SELECT [ID_TYPE_UTILISATEUR],[NOM_UT],[PRENOM_UT],[COURRIEL_UT],[LOGIN_UT], [CONTACT_UT],[MP_UT],COUNT(*) OVER (PARTITION BY 1) as RowCnt FROM [Afriquepesage].[dbo].[UTILISATEUR]";
$userscount = "SELECT [Afriquepesage].[dbo].[UTILISATEUR].[ID_TYPE_UTILISATEUR],[ID_USER],[NOM_UT],[PRENOM_UT],[COURRIEL_UT],[LOGIN_UT], [CONTACT_UT],[MP_UT],[STATUT_UT],[LIBELLE_TYPE_UTILISATEUR],[nom_S] FROM [Afriquepesage].[dbo].[UTILISATEUR],[Afriquepesage].[dbo].[TYPE_UTILISATEUR],[Afriquepesage].[dbo].[Site] where [Afriquepesage].[dbo].[UTILISATEUR].ID_TYPE_UTILISATEUR=[Afriquepesage].[dbo].[TYPE_UTILISATEUR].ID_TYPE_UTILISATEUR  and  [Afriquepesage].[dbo].[UTILISATEUR].[num_S]=[Afriquepesage].[dbo].[Site].[num_S]";
$users = $conn->query($userscount);
$totaluserss = $users->fetchAll();

//liste des types user
$typeusers = "SELECT [ID_TYPE_UTILISATEUR],[LIBELLE_TYPE_UTILISATEUR] ,[ABREVIATION]FROM [dbo].[TYPE_UTILISATEUR]";
$typ = $conn->query($typeusers);
$totaltype = $typ->fetchAll();

//liste des sites
$selectsite = "SELECT [NUM_S] ,[NOM_S] ,[ADRESSE_S] ,[CODEPOSTAL_S] ,[VILLE_S] ,[PAYS_S] ,[CONTACT_S] ,[TEL_S] ,[FAX_S] ,[EMAIL_S] ,[LOGO_S] ,[COMMENTAIRE_S] FROM [dbo].[SITE]";
$listsite = $conn->query($selectsite);
$totalsite = $listsite->fetchAll();

//LAST SITE NUMBER
    $num = $conn->prepare("SELECT TOP 1 [NUM_S] FROM [Afriquepesage].[dbo].[SITE] ORDER BY [NUM_S] DESC");
    $num->execute();
    $num_result = $num->fetch();
    $number = $num_result["NUM_S"]+1;
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
        <script type="text/JavaScript">
            function valid(f) {
            !(/^[0-9#209#241]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209#241]/ig,''):null;
            }
            function valid2(f) {
            !(/^[A-z0-9&#209;&#241; ]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241; ]/ig,''):null;
            }
            function valid3(f) {
            !(/^[A-z0-9&#209;&#241;@;.;]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241;@;.;]/ig,''):null;
            }

            function valid3(f) {
            !(/^[A-z0-9&#209;&#241;.; ]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241;.; ]/ig,''):null;
            }
        </script>
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
                                <h1>GESTION SITE<small>Afrique Pesage </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="col-sm-12" >
                        <div class="col-sm-4" style="margin-top:5%;">
                            <form  method="POST" action="">
                                <table border="0" >
                                    <tr>
                                        <td><label class="col-sm-12 control-label">NUM&Eacute;RO SITE</label> </td>
                                        <td><input type="text" name="site" id="form-field-1" class="form-control" value="<?php echo $number; ?>" readonly=""/> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td><label class="col-sm-12 control-label">NOM DE LA VILLE</label> </td>
                                        <td><input type="text" name="ville" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                 <!--   <tr>
                                        <td><label class="col-sm-12 control-label"> NOM </label> </td>
                                        <td><input type="text" name="libelle" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr> -->
                                    <tr>
                                        <td><label class="col-sm-12 control-label">ADRESSE</label> </td>
                                        <td><input type="text" name="adresse" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-12 control-label">CODE POSTAL</label> </td>
                                        <td><input type="text" name="code_post"  id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-12 control-label">PAYS</label> </td>
                                        <td><input type="text" name="pays" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                   <!-- <tr>
                                        <td><label class="col-sm-12 control-label">CONTACT</label> </td>
                                        <td><input type="text" name="contact" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>-->
                                    <tr>
                                        <td><label class="col-sm-12 control-label">T&Eacute;L&Ecaron;PHONE</label> </td>
                                        <td><input type="text" name="telephone" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-12 control-label">FAX</label> </td>
                                        <td><input type="text" name="fax" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-12 control-label">COURRIEL</label> </td>
                                        <td><input type="text" name="email" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                   <!-- <tr>
                                        <td><label class="col-sm-12 control-label">LOGO</label> </td>
                                        <td><input type="text" name="logo" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>-->
                                    <tr>
                                        <td><label class="col-sm-12 control-label">COMMENTAIRE</label> </td>
                                        <td><input type="text" name="commentaire" id="form-field-1" class="form-control" required placeholder=""> </input> </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table> 
                                <table>
                                    <tr>

                                        <td ><input type="submit" value="ENREGISTRER" name="enregistrer" class="btn btn-green btn-lg"/></td>
                                        <td>&nbsp;</td>
                                        <td ><a href="transporteurs.php" class="btn btn-red btn-lg">RETOUR</a> </td>
                                        <td>&nbsp;</td>
                                        <td ><a href="intro_respo_site.php" class="btn btn-blue btn-lg">ACCUEIL</a></td>
                                    </tr> 
                                </table>

                            </form>
                        </div>
                        <div class="col-sm-8" style="margin-top:5%;">
                          
                            <!-- start: DYNAMIC TABLE PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Sites
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                        <thead>
                                            <tr>
                                                <th>NUM&Eacute;RO SITE</th>
                                                <th>NOM SITE</th>
                                                <th>T&Eacute;L&Ecaron;PHONE</th>

                                                <th bgcolor="#E8B0C2"><label class="col-sm-12 control-label">CODE POSTAL</label> </th>
                                                <th bgcolor="#E8B0C2"><label class="col-sm-12 control-label">VILLE</label> </th>
                                                <th bgcolor="#E8B0C2"><label class="col-sm-12 control-label">PAYS</label> </th>
                                                <th bgcolor="#E8B0C2" ><label class="col-sm-12 control-label">COURRIEL</label> </th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($totaluserss == 0) {
                                                echo '<tr>
                                                        <td colspan="7">Aucun Site dans la base de données </td>
                                                    </tr>   ';
                                            } else {
                                                foreach ($totalsite as $totalusers) {
                                                    ?>
                                                     <tr>
                                                        <td style="padding-left: 5px"><?php echo $totalusers["NUM_S"]; ?></td> 
                                                        <td style="padding-left: 5px"><?php echo $totalusers["NOM_S"]; ?></td> 
                                                        <td style="padding-left: 5px"><?php echo $totalusers["TEL_S"]; ?></td> 
                                                        <td style="padding-left: 5px"><?php echo $totalusers["CODEPOSTAL_S"]; ?></td>  
                                                        <td style="padding-left: 5px"><?php echo $totalusers["VILLE_S"]; ?></td>  
                                                        <td style="padding-left: 5px"><?php echo $totalusers["PAYS_S"]; ?></td>   
                                                        <td style="padding-left: 5px"><?php echo $totalusers["EMAIL_S"]; ?></td>  
                                                    
                                                    </tr> 
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end: DYNAMIC TABLE PANEL -->
                        </div>
                    </div>
                </div>
                <div style="width:100px; margin: 0 auto;">

                </div>
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
        <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
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