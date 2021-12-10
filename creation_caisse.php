<?php
include 'connections/AfriquepesageConnection.php';
/*
 * Author: y.dago@afriquepesage.com
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

//Liste des caisses
$reqcaisse = $conn->query("SELECT [ID_CAISSE],[LIBELLE_CAISSE],[STATUT_CAISSE],[Afriquepesage].[dbo].[SITE].[NUM_S],[Afriquepesage].[dbo].[SITE].[NOM_S]FROM [Afriquepesage].[dbo].[CAISSE],[Afriquepesage].[dbo].[SITE] WHERE [Afriquepesage].[dbo].[CAISSE].[NUM_S]=[Afriquepesage].[dbo].[SITE].[NUM_S]");
$list = $reqcaisse->fetchAll();
$volumes = sizeof($list);

//liste des sites
$selectsite = "SELECT [NUM_S] ,[NOM_S] ,[ADRESSE_S] ,[CODEPOSTAL_S] ,[VILLE_S] ,[PAYS_S] ,[CONTACT_S] ,[TEL_S] ,[FAX_S] ,[EMAIL_S] ,[LOGO_S] ,[COMMENTAIRE_S] FROM [dbo].[SITE]";
$listsite = $conn->query($selectsite);
$totalsite = $listsite->fetchAll();
//mise at jour

if (isset($_POST['caisse_save'])) {
    $site_num = $_POST['site'];
    for ($i = 0; $i < $_POST['caisse']; $i++) {
//CHECK LAST INSERTED CASH REGISTER NUMBER
        $count = "SELECT MAX([LIBELLE_CAISSE]) as [LIBELLE_CAISSE] FROM [Afriquepesage].[dbo].[CAISSE] where [NUM_S] = '$site_num' ";
        $s = $conn->query($count);
        $name = $s->fetch();

        //CHECK LAST INSERTED CASH REGISTER ID
        $id = "SELECT MAX([ID_CAISSE]) as [ID_CAISSE] FROM [Afriquepesage].[dbo].[CAISSE] where [NUM_S] = '$site_num' ";
        $s2 = $conn->query($id);
        $n = $s2->fetch();

        $number = explode(" ", $name['LIBELLE_CAISSE']);
        $start = substr($n["ID_CAISSE"], 0, 4);
        $t = $number[1];
        if ($t <= 9) {
            $t = $t + 1;
            $tt = "0" . $t;
            $caisse = $number[0] . " " . $tt;
            // echo $n["ID_CAISSE"]."<br><br>";
            // echo "the id begining=".substr($n["ID_CAISSE"], 0,4)."<br><br>";
            //  echo "last digit of id_caisse=".substr($n["ID_CAISSE"], 4,1)."<br><br>";
            // echo $site_num."<br>";
            // echo $number[0]." ".$tt."<br>";
            // echo $caisse;
        } else {
            $t = $t + 1;
            $tt = $t;
        }

        if (substr($n["ID_CAISSE"], 4, 2) <= 9) {
            $l = substr($n["ID_CAISSE"], 4, 2) + 1;
            // echo "<br><br>";
            // echo "the new last digit of id_caisse=".$l."<br><br>";
            $id_c = $start . $l;
            // echo $id_c;
        } else {
            $l = substr($n["ID_CAISSE"], 4, 2) + 1;
            $id_c = $start . $l;
        }


        $insert = $conn->prepare("INSERT INTO [dbo].[CAISSE]([ID_CAISSE],[LIBELLE_CAISSE],[STATUT_CAISSE],[NUM_S]) VALUES(:ID_CAISSE,:LIBELLE_CAISSE,:STATUT_CAISSE,:NUM_S)");
        $insert->execute(array(':ID_CAISSE' => $id_c, ':LIBELLE_CAISSE' => $caisse, ':STATUT_CAISSE' => 0, ':NUM_S' => $_POST['site']));
    }
    /*     * *****************************JOURAL ENTRY****************** */
    $login_log = fopen("assets/log/caisses/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
    $log = "*" . date('d-m-Y H:i:s') . ": Création de " . $_POST['caisse'] . " caisse(s) au niveau du site " . $_POST['site'] . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
    fwrite($login_log, $log);
    fclose($login_log);
    /*     * *************************************************************** */
    echo "<script>
                    alert('CAISSE CREE AVEC SUCCES');
                window.location.href='creation_caisse.php';
                </script>";
    /* if(explode("0", $number[1])){

      }
     * *
     */
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

                                            <span class="username"><?php echo $_SESSION['nom_utilisateur']; ?></span>
                                            <i class="clip-chevron-down"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="width: -2px;">
                                            <li>
                                                <a href="#deconnexion" data-toggle = "modal">
                                                    <i class="clip-exit"></i>
                                                    Deconnexion
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <!-- end: TOP NAVIGATION MENU -->
                            </div>
                            <div class="page-header">
                                <h1>
                                    GESTION CAISSE/SITE<small>Afrique pesage S.A</small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                        <div class="col-sm-12" style="margin-top:1.5%;">

                            <!-- start: DYNAMIC TABLE PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Caisses Site
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                        <thead>
                                            <tr>
                                                <th>ID CAISSE</th>
                                                <th>LIBELLE CAISSE</th>
                                                <th>SITE</th>
                                                <th>ETAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($volumes == 0) {
                                                echo'<tr><td colspan="4">AUCUNE CAISSE CREER</td></tr>';
                                            } else {
                                                foreach ($list as $element) {
                                                    ?>
                                                    <tr>
                                                        <td> <?php echo $element['ID_CAISSE']; ?></td>
                                                        <td><?php echo $element['LIBELLE_CAISSE']; ?></td>
                                                        <td><?php echo $element['NOM_S']; ?></td>
                                                        <td><?php
                                                            if ($element['STATUT_CAISSE'] == false) {
                                                                echo'FERMEE';
                                                            } else {
                                                                echo'OUVERTE';
                                                            }
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <table style="float:right;">
                                        <tr >
                                            <td>&nbsp;</td> 
                                            <td>
                                            <td>
                                                <a class="btn btn-red btn-lg" href="intro_admin.php?dyp=*">
                                                    RETOUR &nbsp;
                                                    <i class="clip-home"></i>
                                                </a>   
                                            </td>
                                            <td>&nbsp;</td>
                                            </td> 
                                            <td>
                                                <a class="btn btn-blue btn-lg" href="#caisse" data-toggle="modal">
                                                    NOUVELLE CAISSE &nbsp;
                                                    <i class="clip-cart"></i>
                                                </a>   
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <a class="btn btn-blue btn-lg" href="creation_site.php" >
                                                    NOUVEAU SITE &nbsp;
                                                    <i class="clip-home-2"></i>
                                                </a>   
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <!-- end: DYNAMIC TABLE PANEL -->
                        </div>
                    <div style="width:100px; margin: 0 auto;">

                    </div>
                </div>
            </div>
        </div>
        <div id = "caisse" class = "modal fade" tabindex = "-1" data-width = "300" style = "display: none;">
            <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                    &times;
                </button>
                <h6 class = "modal-title mod">CHOISIR LE SITE ET LE NOMBRE DE CAISSE</h6>
            </div>
            <form method="post" id="search_form" action="">
                <div class = "modal-body">
                    <div class = "row">
                        <div class = "col-md-12">
                            <p >
                            <td> 
                                <select name="site" size="1" id="form-field-1" class="form-control" required="true" >
                                    <option value="">Choisir le site ...</option>
                                    <?php
                                    foreach ($totalsite as $totsite) {
                                        // echo '<option value="'.$totsite['NUM_S'].'"> '.$totsite['NOM_S'].'</option>';
                                        ?>
                                        <option value="<?php echo $totsite['NUM_S']; ?>"> <?php echo $totsite['NOM_S']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="caisse" size="1" id="form-field-1" class="form-control" required="true" >
                                    <option value="">Nombre de Caisse ...</option>
                                    <?php
                                    for ($i = 1; $i < 11; $i++) {
                                        // echo '<option value="'.$totsite['NUM_S'].'"> '.$totsite['NOM_S'].'</option>';
                                        ?>
                                        <option value="<?php echo "" . $i; ?>"> <?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </td>
                            </p>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button type = "button" data-dismiss = "modal" class = "btn btn-blue">
                        FERMER
                    </button>
                    <button type = "submit" class = "btn btn-red" name="caisse_save">
                        CREER
                    </button>
                </div>
            </form>
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
                        DECONNEXION
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