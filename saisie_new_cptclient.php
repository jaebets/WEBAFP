<?php
session_start();
include 'connections/AfriquepesageConnection.php';
//enregistrement des données dans la table UT
//if (isset($_POST['enregistrer'])){
//echo $_POST['nom'];
if (isset($_POST['enregistrer'])) {
    if (isset($_POST['ID_COMPTE_CLIENT']) && isset($_POST['SOLDE_COMPTE_CLIENT']) && isset($_POST['NOM_RAISON_SOCIAL'])) {
       // $nbrecli = "SELECT [ID_COMPTE_CLIENT] ,[ID_CLIENT] ,[SOLDE_COMPTE_CLIENT],[NOM_RAISON_SOCIAL],[TELEPHONE],[EMAIL],[RESPONSABLE],[SOCIETE],[ACTIVITE],[FAX],[LOCALISATION],[PREFERENTIEL] FROM [Afriquepesage].[dbo].[COMPTE_CLIENT]";
       // $cptclit = $conn->query($nbrecli);
       // $cptcli = $cptclit->fetchAll();
        //$saicli = count($cptcli);

        $cpt = $_POST['ID_COMPTE_CLIENT'];
        $sld = $_POST['SOLDE_COMPTE_CLIENT'];
        $rais = $_POST['NOM_RAISON_SOCIAL'];
        $tel = $_POST['TELEPHONE'];
        $email = $_POST['EMAIL'];
        $resp = $_POST['RESPONSABLE'];
        $soc = $_POST['SOCIETE'];
        $act = $_POST['ACTIVITE'];
        $fax = $_POST['FAX'];
        $loca = $_POST['LOCALISATION'];

        if (isset($_POST['PREFERENTIEL'])) {
            $pref = 1;
        } else {
            $pref = 0;
        }
       // echo "<script>alert($pref);</script>";
       // $cptclit = $conn->query($nbrecli);
       // $cptcli = $cptclit->fetchAll();
        //   $saicli=count($cptcli);

        $cptclit1 = $conn->query("SELECT COUNT([ID_CLIENT])+ 1 as ID_CLIENT FROM [Afriquepesage].[dbo].[COMPTE_CLIENT]");
        $cptclit1->execute();
        $cptcli1 = $cptclit1->fetch();
        $idcli = $cptcli1['ID_CLIENT'];

        $req = "INSERT INTO [dbo].[COMPTE_CLIENT]([ID_COMPTE_CLIENT],[ID_CLIENT],[SOLDE_COMPTE_CLIENT],[NOM_RAISON_SOCIAL],[TELEPHONE],[EMAIL],[RESPONSABLE],[SOCIETE],[ACTIVITE],[FAX],[LOCALISATION],[PREFERENTIEL])"
                . " VALUES(:ID_COMPTE_CLIENT ,:ID_CLIENT,:SOLDE_COMPTE_CLIENT,:NOM_RAISON_SOCIAL,:TELEPHONE,:EMAIL,:RESPONSABLE,:SOCIETE,:ACTIVITE,:FAX,:LOCALISATION,:PREFERENTIEL)";
        $rp = $conn->prepare($req);
        $rp->bindParam(':ID_COMPTE_CLIENT', $cpt);
        $rp->bindParam(':ID_CLIENT', $idcli);
        $rp->bindParam(':SOLDE_COMPTE_CLIENT', $sld);
        $rp->bindParam(':NOM_RAISON_SOCIAL', $rais);
        $rp->bindParam(':TELEPHONE', $tel);
        $rp->bindParam(':EMAIL', $email);
        $rp->bindParam(':RESPONSABLE', $resp);
        $rp->bindParam(':SOCIETE', $soc);
        $rp->bindParam(':ACTIVITE', $act);
        $rp->bindParam(':FAX', $fax);
        $rp->bindParam(':LOCALISATION', $loca);
        $rp->bindParam(':PREFERENTIEL', $pref);
        $rp->execute();
        if ($rp) {
            /*             * *****************************JOURAL ENTRY****************** */
            $login_log = fopen("assets/log/compte_clients/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
            $log = "*" . date('d-m-Y H:i:s') . ": Nouveau Compte Client Nº " . $cpt . " Créé par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
            fwrite($login_log, $log);
            fclose($login_log);
            /*             * *************************************************************** */
            echo "<script>alert('COMPTE CLIENT ENREGISTRE'); window.location.href='saisie_cptclient.php';</script>";
        }
    }
    
}
$info = "";
$saiclient = "SELECT [ID_COMPTE_CLIENT],[ID_CLIENT],[SOLDE_COMPTE_CLIENT],[NOM_RAISON_SOCIAL],[TELEPHONE],[EMAIL],[RESPONSABLE],[SOCIETE],[ACTIVITE],[FAX],[LOCALISATION],[PREFERENTIEL] FROM [Afriquepesage].[dbo].[COMPTE_CLIENT];";
$saicli = $conn->query($saiclient);
$caiscptcli = $saicli->fetchAll();
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
            !(/^[0-9&#209;&#241;]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9&#209;&#241;]/ig,''):null;
        }
        function valid2(f) {
            !(/^[A-z0-9&#209;&#241; ]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9&#209;&#241; ]/ig,''):null;
        }
        function valid3(f) {
            !(/^[A-z0-9#209;&#241;@;.;]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z0-9#209;&#241;@;.;]/ig,''):null;
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
                                                <a href="#"><i class="clip-home-2"></i>
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                      ?></a></li>
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
                                <h1>COMPTE CLIENT<small>Responsable Caisse </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="row" style="margin-top:3%;">
                        <div class="col-sm-12" >
                            <form  method="POST" action="saisie_new_cptclient.php">
                                <div class="col-sm-4">
                                    <table border="0" >

                                        <tr>
                                            <td><label class="col-sm-12 control-label">Nº DE COMPTE </label></td> 
                                            <td><input type="text" name="ID_COMPTE_CLIENT" id="form-field-1" class="form-control" value=" <?php echo mt_rand(1000000000, 9999999999) . $_SESSION['num_site']; ?>" readonly ></input> </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-12 control-label">NOM DU CLIENT</label></td>
                                            <td><input type="text" name="SOCIETE" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"> </input></td>
                                        </tr> 
                                        <tr>
                                            <td><label class="col-sm-10 control-label">RESPONSABLE</label></td>
                                            <td><input type="text" name="RESPONSABLE" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"> </input></td>
                                        </tr> 
                                        <tr>
                                            <td><label class="col-sm-10 control-label">CELLULAIRE </label></td>
                                            <td><input type="text" name="TELEPHONE" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid(this)" onblur="valid(this)"> </input></td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">COURRIEL</label></td>
                                            <td><input type="email" name="EMAIL" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid3(this)" onblur="valid3(this)"> </input></td>
                                        </tr> 
                                        <tr>
                                            <td><label class="col-sm-10 control-label">ACTIVITE</label></td>
                                            <td><input type="text" name="ACTIVITE" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"> </input></td>

                                        </tr> 
                                        <tr>
                                            <td><label class="col-sm-10 control-label">LOCALISATION</label></td>
                                            <td><input type="text" name="LOCALISATION" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"> </input></td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">EXPLOITANT</label></td>
                                            <td><input type="text" name="NOM_RAISON_SOCIAL" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"> </input></td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-12 control-label">TEL FIXE / FAX</label></td>
                                            <td><input type="text" name="FAX" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid(this)" onblur="valid(this)"> </input></td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-12 control-label">SOLDE CLIENT</label> </td>
                                            <td><input type="text" name="SOLDE_COMPTE_CLIENT" id="form-field-1" value="0" class="form-control" required placeholder="" readonly> </input> </td>
                                        </tr>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td colspan="1">
                                                    <div align="left">
                                                        <label class="checkbox-inline" for="form-field-5">
                                               <!--             <input type="checkbox" name="PREFERENTIEL" class="flat-red" checked="true" id="ch" onClick="changes('ch','cpt');"/>  -->
                                                            <input type="checkbox" name="PREFERENTIEL" class="flat-red"  id="ch" value="1"/>
                                                            <td><label class="control-label" for="form-field-5" style="width: 50%;">
                                                                    PREFERENTIEL
                                                                </label></td>                                                            
                                                        </label>                                                                                                                  
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                  <!-- <tr>
                       <td><input type="submit" value="Enregistrer" name="enregistrer" class="btn btn-green btn-lg"/></td>
                       <td><input type="reset" value="annuler" class="btn btn-red btn-lg"/></td>
                       <td><a href="intro_admin.php" class="btn btn-blue btn-lg">Retour</a></td>
                   </tr> <!---->
                                    </table> 
                                    <br/><br/>
                                    <input type="submit" value="Enregistrer" name="enregistrer" class="btn btn-green btn-lg"/>
                                    <input type="reset" value="ANNULER" class="btn btn-red btn-lg"/>
                                    <a href="intro_respo_caisse.php" class="btn btn-blue btn-lg">Retour</a>
                                </div>
                            </form>
                            <div class="col-sm-8">

                                <!-- start: DYNAMIC TABLE PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        CLIENTS
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                            <thead>
                                                <tr>
                                                    <th align="center" bgcolor="#E8B0C2"><label class="col-sm-10 control-label">COMPTES</label> </th> 
                                                    <th align="center" bgcolor="#E8B0C2"><label class="col-sm-10 control-label">SOLDE </label></th>
                                                    <th align="center" bgcolor="#E8B0C2"><label class="col-sm-10 control-label">EXPLOITANT</label> </th>
                                                    <th align="center" bgcolor="#E8B0C2"><label class="col-sm-10 control-label">TELEPHONE</label> </th>
                                    <!--            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">EMAIL</label> </th>--> 
                                                    <th align="center" bgcolor="#E8B0C2"><label class="col-sm-10 control-label">RESPONSABLE</label> </th>
                                                    <th align="center" bgcolor="#E8B0C2"><label class="col-sm-10 control-label">SOCIETE</label> </th> 
                                     <!--           <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">ACTIVITE</label> </th> -->
                                    <!--            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">FAX</label> </th>   -->                                             
                                     <!--           <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">LOCALISATION</label> </th>  -->
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($caiscptcli == 0) {
                                                    echo '<tr>
                                                            <td colspan="7">Aucun Compte Client dans la base de données </td>
                                                         </tr>   ';
                                                } else {
                                                    foreach ($caiscptcli as $sc) {
                                                        $cptclient = $sc['ID_COMPTE_CLIENT'];
                                                        $sldcptcli = $sc['SOLDE_COMPTE_CLIENT'];
                                                        $nomrais = $sc['NOM_RAISON_SOCIAL'];
                                                        $tele = $sc['TELEPHONE'];
                                                        //      $mail=$sc['EMAIL'];
                                                        $respo = $sc['RESPONSABLE'];
                                                        $soci = $sc['SOCIETE'];
                                                        //       $acti=$sc['ACTIVITE'];
                                                        //       $faxx=$sc['FAX'];
                                                        //       $loc=$sc['LOCALISATION'];
                                                        echo '<tr> 
                                                        <td align="center">' . $cptclient . '</td> 
                                                        <td align="center">' . $sldcptcli . '</td>
                                                        <td align="center">' . $nomrais . '</td> 
                                                        <td align="center">' . $tele . '</td> 
                                                        <td align="center">' . $respo . '</td> 
                                                        <td align="center">' . $soci . '</td> 
                                                    </tr>   '
                                                        /*          <td align="center">'.$mail.'</td> 
                                                          <td align="center">'.$acti.'</td>
                                                          <td align="center">'.$faxx.'</td>
                                                          <td align="center">'.$loc.'</td> */
                                                        ;
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
        <script language="JavaScript" type="text/javascript">
            function changes(ch)
            {
                var champ = document.getElementById(ch);
                if (check.checked == true)
                {
                    champ.value = 1;
                }
                if (check.checked == false)
                {
                    alert("Vous allez retirer le tarif préféretiel à ce client");
                    champ.value = 0;
                }
            }
        </script>
    </body>
    <!-- end: BODY -->
</html>