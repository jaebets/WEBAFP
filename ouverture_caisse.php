<?php
/*
 * Author: c.nguessan@afriquepesage.com
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
?>
<?php
include 'connections/AfriquepesageConnection.php';
?>
<?php
if (isset($_POST['valider'])) {
    $datetoday = date("Ymd");
    $autredt = date("dmy");
    $heureOuv = date("H:i:s");
    $t = rand(1, 10);
	$tim=date("Hi");
    $idsess = "SESS" . $autredt .$tim.$_SESSION['num_site'];
    $reqinsert = "INSERT INTO [dbo].[SESSION]
           ([ID_SESSION],[DEBUT_SESSION],[FIN_SESSION],[STATUT_SESSION]
           ,[DATE_SESSION],[ID_USER],[num_S])
     VALUES (:ID_SESSION,:DEBUT_SESSION,:FIN_SESSION,:STATUT_SESSION,:DATE_SESSION,:ID_USER,:num_S)";
    $ins = $conn->prepare($reqinsert);
    $ins->execute(array(':ID_SESSION' => $idsess, ':DEBUT_SESSION' => $heureOuv, ':FIN_SESSION' => NULL, ':STATUT_SESSION' => 1, 'DATE_SESSION' => $datetoday, ':ID_USER' => $_SESSION['userid'] , ':num_S' => $_SESSION['num_site']));

    if ($ins) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s').": Nouvelle Session Caisse Ouverte par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('SESSION CAISSE CREEE ET OUVERTE');
                window.location.href='ouverture_caisse.php';
                </script>";
    } else {
        
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/session_caisse/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s').": Tentative Echouée de l'ouverture d'une Nouvelle Session Caisse par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "<script>
                    alert('Echec Ouverture');
                </script>";
    }
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
        <!----> <style>
/*
            html,body {
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
            */
            .col-sm-4 {
                width: 33.333%;
            }
            .mod  {
                color:  #8C001A;
                font-weight: bold;
                /* border-style: solid;*/
                /*border-bottom: thick solid #861D20;*/
            }
        </style><!---->
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
                                                    &nbsp;Site: <?php echo $_SESSION['site']; //$_SESSION['login_utilisateur'];                                                                                    ?></a></li>
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
                                <h1>
                                    Tableau de Bord <small>Responsable Caisse </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- start: RESPONSIVE ICONS BUTTONS PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="clip-menu-3 "></i>
                                    CREATION ET OUVERTURE DES SESSIONS
                                </div>
                                <div class="panel-body">

                                    <?php
                                    $datejour = date("Ymd");
                                    $reqs = $conn->query("SELECT [ID_SESSION],[DEBUT_SESSION],[FIN_SESSION],[STATUT_SESSION],[DATE_SESSION]FROM [dbo].[SESSION] WHERE [STATUT_SESSION]=1 and [num_S]=". $_SESSION['num_site']);
                                    $reqs->execute();
                                    $listsession = $reqs->fetchAll();
                                    $taille = sizeof($listsession);
//Si il n'ya pas de session alors afficher formulaire d'ouverture de session
                                    if ($taille == 0) {
                                        ?>
                                        <span style="font-size:15px;color: red"> Aucune session ouverte   </span><br/> 
                                        <form method="post" action="">                                 
                                            <table width="500" border="0">
                                                <tr>
                                                    <td width='200'>DATE :</td>
                                                    <td><?php echo date("d/m/Y"); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>HEURE D'OUVERTURE :</td>
                                                    <td><input type="time" size="10" name="heureou" value="<?php echo date("H:i"); ?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> <input type="submit" value="OUVRIR" class="btn btn-green btn-lg" name="valider"/></td>
                                                    <td><a class="btn btn-red btn-lg" href="intro_respo_caisse.php" class = "btn btn-blue">ANNULER</a></td>

                                                </tr>
                                            </table>
                                        </form>  
                                        <?php
                                    }
//si il ya une session ouverte alors afficher les infos de cette session avec un bouton fermer
                                    else {
                                        ?>
                                        <table>
                                            <tr>
                                                <th> SESSION </th>
                                                <th> DATE </th>
                                                <th> HEURE DEBUT </th>
                                                <th> ETAT </th>
                                                
                                            </tr>  
                                            <tr> 
                                                <?php
                                                foreach ($listsession as $lst) {
                                                    ?>
                                                <form method="Post" action="majsession.php">
                                                    <td><input type="text" value="<?php echo $lst['ID_SESSION']; ?>" name="sess" readonly="true"/> </td>
                                                    <td><input type="text" value="<?php echo date_format(date_create($lst['DATE_SESSION']), 'd-m-Y'); ?>"  readonly="true"/> </td>
                                                    <td><input type="text" value="<?php echo date_format(date_create($lst['DEBUT_SESSION']), 'H:i:s'); ?>"  readonly="true"/> </td>

                                                    <?php
                                                    if ($lst['STATUT_SESSION'] == 1) {
                                                        ?>
                                                        <td><input type="text" value="Ouverte" style="color: green;font-weight: bold" readonly="true"/> </td>

                                                        <td><input type="submit" value="fermer session"/> </td>
                                                        <?php
                                                    }
                                                    ?>
                                                </form>
                                                </tr>
                                            </table> 
                                            <br/>
                                            <strong><span style="color: red"> OUVERTURE DES CAISSES ET AFFECTATION DES OPERATEURS AUX DIFFERENTES CAISSES</span></strong>
                                            <table border="1" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr style="background-color:#E8B0C2;">
                                                    <th>ID CAISSE </th>
                                                    <th>CAISSE</th>
                                                    <th>UTILISATEUR</th>
                                                    <th>MONTANT APPROVISIONNEMENT</th>
        <!--                                             <th>STATUT CAISSE</th>-->
                                                    <th>ACTION</th>
                                                </tr>
                                                <?php
                                                //on affiche la liste des caisses non affecté et leur statut
                                                $caisse = $conn->query("SELECT [ID_CAISSE],[ID_TYPE_CAISSE],[LIBELLE_CAISSE],[STATUT_CAISSE],[NUM_S]FROM [dbo].[CAISSE] WHERE [NUM_S]='" . $_SESSION['num_site'] . "' AND [ID_CAISSE] NOT IN
	(SELECT [ID_CAISSE] FROM [dbo].[AFFECTER] WHERE [ID_SESSION]='" . $lst['ID_SESSION'] . "')");
                                                $caisse->execute();
                                                $l = $caisse->fetchAll();
                                                ?>   
                                                <?php
                                                foreach ($l as $l1) {
                                                    //Liste des caisses et leur statut
                                                    ?>
                                                    <form method="Post" action="affectation.php">
                                                        <input type="hidden" value="<?php echo$lst['ID_SESSION']; ?>" name="idsession"/>
                                                        <tr>
                                                            <td> <input type="text" value="<?php echo $l1['ID_CAISSE']; ?>" readonly="true" name="idcaisse"/> </td>
                                                            <td> <input type="text" value="<?php echo $l1['LIBELLE_CAISSE']; ?>" readonly="true" name="libcaisse"/></td>
                                                            <td>  
                                                                <select name="iduser" required="true">
                                                                    <option value=""> choisir un(e) caissier(e)...</option>
                                                                    <?php
                                                                    //on va afficher la liste des utilisateurs Caisses, actif et non affectés dans la session en cours
                                                                    $listcaisse = $conn->query("Select [ID_USER],[NOM_UT],[PRENOM_UT],[STATUT_UT],[NUM_S] FROM [Afriquepesage].[dbo].[TYPE_UTILISATEUR],[Afriquepesage].[dbo].[UTILISATEUR] where [Afriquepesage].[dbo].[UTILISATEUR].ID_TYPE_UTILISATEUR=[Afriquepesage].[dbo].[TYPE_UTILISATEUR].ID_TYPE_UTILISATEUR AND [Afriquepesage].[dbo].[UTILISATEUR].[STATUT_UT]=1 AND [Afriquepesage].[dbo].[UTILISATEUR].[NUM_S]='" . $_SESSION['num_site'] . "' AND [Afriquepesage].[dbo].[TYPE_UTILISATEUR].ABREVIATION='CA' AND [ID_USER] NOT IN(SELECT [ID_USER] FROM [dbo].[AFFECTER] WHERE [ID_SESSION]='" . $lst['ID_SESSION'] . "')");
                                                                    $listcaisse->execute();
                                                                    $listecaisses = $listcaisse->fetchAll();
                                                                    foreach ($listecaisses as $lcaisse) {
                                                                        ?>
                                                                        <option value="<?php echo$lcaisse['ID_USER']; ?>"> <?php echo $lcaisse['NOM_UT'] . $lcaisse['PRENOM_UT']; ?></option>
                                                                    <?php } ?>    
                                                                </select>
                                                            </td>
                                                            <td> <input type="text" value="" name="montantappro" placeholder="Montant en FCFA" required onkeyup="valid(this)"/></td>
                                                            <td><input type="submit" value="AFFECTER"> </td>

                                                        </tr> 

                                                    </form>

                                                    <?php
                                                }
                                                ?>
                                            </table>
                                            <br/>
                                            <!--                                    verification des affectations-->



                                            <br/>
                                            <!--                                  ICI la liste des differentes caissières affectées  -->
                                            <strong><span style="color: red">SESSION CAISSIER(E) / CAISSE</span></strong>
                                            <table border="1" class="table table-striped table-bordered table-hover table-full-width">
                                                <tr style="background-color:#E8B0C2;">
                                                    <th style="padding-left: 5px;padding-right: 5px;"> NOM OPERATEUR CAISSE</th>
                                                    <th style="padding-left: 5px;padding-right: 5px;">CAISSE</th>
                                                    <th style="padding-left: 5px;padding-right: 5px;">MONTANT POURVU</th>
                                                    <th style="padding-left: 5px;padding-right: 5px;">MONTANT ENCAISSE</th>
                                                    <th style="padding-left: 5px;padding-right: 5px;">MONTANT ENLEVEMENT</th>
                                                    <th style="padding-left: 5px;padding-right: 5px;">SOLDE EN CAISSE</th>

                                                </tr>
                                                <?php
                                                //on verra maintenant si pour la session ouverte des caissières ont été affecter aux différentes caisses
                                                $reaf = $conn->query("SELECT [DATE_AFFECTATION],[Afriquepesage].[dbo].[UTILISATEUR].[ID_USER],[NOM_UT],[PRENOM_UT],[LIBELLE_CAISSE],[MONTANT_POURVU],[MONTANT_ENCAISSE],[MONTANT_POURVU_RESTANT],[Afriquepesage].[dbo].[AFFECTER].[ID_CAISSE] FROM [Afriquepesage].[dbo].[AFFECTER],[Afriquepesage].[dbo].[CAISSE],[Afriquepesage].[dbo].[UTILISATEUR],[Afriquepesage].[dbo].[SESSION]  WHERE [Afriquepesage].[dbo].[AFFECTER].ID_USER=[Afriquepesage].[dbo].[UTILISATEUR].ID_USER AND [Afriquepesage].[dbo].[AFFECTER].ID_CAISSE=[Afriquepesage].[dbo].[CAISSE].ID_CAISSE AND [Afriquepesage].[dbo].[AFFECTER].ID_SESSION=[Afriquepesage].[dbo].[SESSION].ID_SESSION AND [Afriquepesage].[dbo].[AFFECTER].[ID_SESSION]='" . $lst['ID_SESSION'] . "'");
                                                $reaf->execute();
                                                $listaf = $reaf->fetchAll();
                                                $tailleaf = sizeof($listaf);
                                                if ($tailleaf == 0) {
                                                    ?>
                                                    <tr>
                                                        <td colspan="7"><strong>Aucune affectation effectuée</strong></td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    foreach ($listaf as $laf) {
                                                        ?>

                                                        <tr>
                                                            <td><?php echo $laf['NOM_UT'] . $laf['PRENOM_UT']; ?></td>
                                                            <td><?php echo $laf['LIBELLE_CAISSE']; ?></td>
                                                            <td><?php echo $laf['MONTANT_POURVU']; ?></td>
                                                            <td><?php echo $laf['MONTANT_ENCAISSE']; ?></td>
                                                            <td><?php echo $laf['MONTANT_POURVU_RESTANT']; ?></td>
                                                            <td><?php echo $laf['MONTANT_ENCAISSE'] + $laf['MONTANT_POURVU']-$laf['MONTANT_POURVU_RESTANT']; ?></td>
                                                            <td><a href="suivi_caisse.php?id_user=<?php echo $laf['ID_USER']; ?>&id_session=<?php echo $lst['ID_SESSION']; ?>&id_caisse=<?php echo $laf['ID_CAISSE']; ?>"><img src='assets/images/loupe.jpg' width="30" height="20" title="afficher"/></a></td>
                                                            <td><a href="maj_affectation.php?id_user=<?php echo $laf['ID_USER']; ?>&id_session=<?php echo $lst['ID_SESSION']; ?>&id_caisse=<?php echo $laf['ID_CAISSE']; ?>"><img src='assets/images/crayon.png' title="modifier"/></a></td>
                                                            <td><a href="enlevement.php?id_user=<?php echo $laf['ID_USER']; ?>&id_session=<?php echo $lst['ID_SESSION']; ?>&id_caisse=<?php echo $laf['ID_CAISSE']; ?>"><img src='assets/images/retrait_caisse.jpg' width="30" height="20" title="enlèvement"/></a></td>

                                                        </tr>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </table>
                                            <br/>
                                            <?php
                                            $nouv = $conn->query("SELECT SUM([MONTANT_ENCAISSE]) AS [TOTAL_ENCAISSE] from [Afriquepesage].[dbo].[AFFECTER] where [AFFECTER].[ID_SESSION]='" . $lst['ID_SESSION'] . "'");
                                            $nouv->execute();
                                            $lnouv = $nouv->fetch();
                                            ?>
                                            <strong><span style="color: red">TOTAL DES ENCAISSEMENTS : </span><?php
                                                if (empty($lnouv['TOTAL_ENCAISSE'])) {
                                                    echo "Aucun encaissement";
                                                } else {
                                                    echo $lnouv['TOTAL_ENCAISSE'];
                                                }
                                                ?></strong>
                                            <br/> <br/>
											
                                            <?php
                                            //fin procedure session     
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
							<table style="float:right">
											<tr>
											<td>
                                            <a class="btn btn-red btn-lg" href="intro_respo_caisse.php">
                                                RETOUR
                                                <i class="fa fa-times fa fa-white"></i>
                                            </a>
											</td>
											<td>
											&nbsp;&nbsp;
											</td>
                                            <td>
											<a class="btn btn-blue btn-lg" HREF="javascript:history.go(0)">
                                                ACTUALISER
                                                <i class="	clip-refresh "></i>
                                            </a>
											
											
											</td>
											</tr>
											</table><br/>
                            <!-- end: RESPONSIVE ICONS BUTTONS PANEL -->
                        </div>
                    </div>
                    <!-- end: PAGE CONTENT-->
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
        <script>
            jQuery(document).ready(function () {
                Main.init();
                UIButtons.init();
            });
        </script>
 <script type="text/JavaScript" language="JavaScript">
function valid(f) {
!(/^[0-9#209#241]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9#209#241]/ig,''):null;
} 
function valid2(f) {
!(/^[A-z]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z]/ig,''):null;
} 
</script>
    </body>
    <!-- end: BODY -->
</html>