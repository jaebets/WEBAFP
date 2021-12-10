<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include 'connections/AfriquepesageConnection.php';
//liste des sites
$selectsite = "SELECT [NUM_S] ,[NOM_S] ,[ADRESSE_S] ,[CODEPOSTAL_S] ,[VILLE_S] ,[PAYS_S] ,[CONTACT_S] ,[TEL_S] ,[FAX_S] ,[EMAIL_S] ,[LOGO_S] ,[COMMENTAIRE_S] FROM [dbo].[SITE]";
$listsite = $conn->query($selectsite);
$totalsite = $listsite->fetchAll();
if (isset($_POST['research'])) {
    $users = $_POST['users'];
    //liste des types user
    $type_users = "SELECT TOP 1000 [ID_USER]
      ,a.[ID_TYPE_UTILISATEUR] 
      ,[NOM_UT]
      ,[PRENOM_UT]
      ,[CONTACT_UT]
      ,[COURRIEL_UT]
      ,[LOGIN_UT]
      ,[MP_UT]
      ,a.[NUM_S]
      ,[STATUT_UT]
      ,[MP_UT_C]
	  ,b.[nom_S] as [site_name]
	  ,c.[LIBELLE_TYPE_UTILISATEUR] as [TITLE]
  FROM [Afriquepesage].[dbo].[UTILISATEUR] a,[Afriquepesage].[dbo].[Site] b, [Afriquepesage].[dbo].[TYPE_UTILISATEUR] c where a.[NUM_S]='$users' and a.[ID_TYPE_UTILISATEUR]= b.[num_S] and a.[ID_TYPE_UTILISATEUR]= c.[ID_TYPE_UTILISATEUR]";
    //$type_users = "SELECT [ID_USER],[ID_TYPE_UTILISATEUR] ,[NOM_UT],[PRENOM_UT],[CONTACT_UT],[COURRIEL_UT],[LOGIN_UT] ,a.[NUM_S],[STATUT_UT],[MP_UT_C] FROM [dbo].[UTILISATEUR] a,[Afriquepesage].[dbo].[Site] b WHERE a.[ID_TYPE_UTILISATEUR]= b.[num_S] and [NUM_S]= '$users'";
    $types = $conn->query($type_users);
    $total_type = $types->fetchAll();
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
        <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
        <link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
        <!-- start: CSS REQUIRED FOR MODAL PAGE ONLY -->
        <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="shortcut icon" href="favicon.ico" />
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
                                <h1>GESTION UTILISATEURS <small>Afrique Pesage </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top:1.5%;">
                            <form method="post" action="">
                                <table width="100%" border="0">
                                    <tr>
                                        <td>
                                            &nbsp;
                                        </td>
                                        <td>
                                            &nbsp;
                                        </td>

                                        <td>
                                            &nbsp;
                                        </td>
                                        <td>
                                            <div align="center">
                                                <h5><label style="color:#8C001A;font-weight:bold;">RECHERCHE PAR SITE:</label></h5>
                                            </div>
                                        </td>
                                        <td>
                                            &nbsp;
                                        </td>
                                        <td><select name="users" id="form-field-select-1" class="form-control" >
                                                <option value="">Liste de SITE ...</option>
                                                <?php
                                                foreach ($totalsite as $key) {
                                                    ?>
                                                    <option value="<?php echo $key['NUM_S']; ?>"><?php echo $key['NOM_S']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <button type = "submit" class = "btn btn-blue" name="research">
                                                    RECHERCHE
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Liste des utilisateurs
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                    <thead>
                                        <tr>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Nom & Pr&eacute;noms</label> </th> 
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Contact</label> </th>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Courriel</label> </th>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Type Utilisateur</label> </th>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">SITE</label> </th>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Statut</label> </th>
                                            <th bgcolor="#E8B0C2" ><label class="col-sm-10 control-label">Action</label> </th>
                                            <th bgcolor="#E8B0C2" ><label class="col-sm-10 control-label">Modif</label> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($total_type) && (sizeof($total_type) != 0)) {
                                            foreach ($total_type as $totalusers) {
                                                if ($totalusers['STATUT_UT'] == 0) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo preg_replace('/\s+/', '', $totalusers['NOM_UT']) . " " . preg_replace('/\s+/', '', $totalusers['PRENOM_UT']); ?></td>
                                                        <td><?php echo preg_replace('/\s+/', '', $totalusers['CONTACT_UT']); ?></td>
                                                        <td><?php echo preg_replace('/\s+/', '', $totalusers['COURRIEL_UT']); ?></td>
                                                        <td><?php echo $totalusers['TITLE']; ?></td>
                                                        <td><?php echo $totalusers['site_name']; ?></td>

                                                        <td>INACTIF</td>
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="suppuser.php?id=<?php echo preg_replace('/\s+/', '', $totalusers['ID_USER']); ?>&s=ac"><img src="assets/images/actif.png" width="80"></img></a></td>    
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="modif_utilisateurs.php?id_user=<?php echo preg_replace('/\s+/', '', $totalusers['ID_USER']); ?>"><img src="assets/images/crayon.png"/></img></a></td>    

                                                    </tr>
                                                    <?php
                                                }else{
                                                    ?>
                                                     <tr>
                                                        <td><?php echo preg_replace('/\s+/', '', $totalusers['NOM_UT']) . " " . preg_replace('/\s+/', '', $totalusers['PRENOM_UT']); ?></td>
                                                        <td><?php echo preg_replace('/\s+/', '', $totalusers['CONTACT_UT']); ?></td>
                                                        <td><?php echo preg_replace('/\s+/', '', $totalusers['COURRIEL_UT']); ?></td>
                                                        <td><?php echo $totalusers['TITLE']; ?></td>
                                                        <td><?php echo $totalusers['site_name']; ?></td>

                                                        <td>ACTIF</td>
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="suppuser.php?id=<?php echo preg_replace('/\s+/', '', $totalusers['ID_USER']); ?>&s=in"><img src="assets/images/inactif.png" width="80"></img></a></td>    
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="modif_utilisateurs.php?id_user=<?php echo preg_replace('/\s+/', '', $totalusers['ID_USER']); ?>"><img src="assets/images/crayon.png"/></img></a></td>    

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="7">Aucun Utilisateurs dans la base de données </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <br><br>
                                <table style="float:right;">
                                    <tr >
                                        <td>&nbsp;</td> 
                                        <td>
                                        <td>
                                            <a class="btn btn-red btn-lg" href="intro_admin.php?dyp=*">
                                                RETOUR
                                                <i class="clip-close"></i>
                                            </a>   
                                        </td>
                                        <td>&nbsp;</td>
                                        </td> 
                                        <td>
                                            <a class="btn btn-blue btn-lg" href="utilisateurs.php?dyp=*">
                                                NOUVEAU
                                                <i class="clip-user-plus"></i>
                                            </a>   
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
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
            <div class="footer clearfix">
                <div class="footer-inner">
                    AFRIQUE PESAGE S.A c&ocirc;te d'ivoire - Abidjan - Zone 4C, Rue du docteur CALMETTE - Adresse:16
                </div>
                <div class="footer-items">
                    <span class="go-top"><i class="clip-chevron-up"></i></span>
                </div>
            </div>
        </div>
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
        <script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.users.min.js"></script>
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
</html>