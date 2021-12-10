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
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['contacts']) && isset($_POST['courriel']) && isset($_POST['login']) && isset($_POST['motpasse1']) && /* isset($_POST['motpasse2']) && */ isset($_POST['typeut']) && isset($_POST['site'])) {
            //nbre user
        $nbre = "SELECT *FROM [Afriquepesage].[dbo].[UTILISATEUR] WHERE [LOGIN_UT]='" . $_POST['login'] . "'";
        $nbreuser = $conn->query($nbre);
        $totuser = $nbreuser->fetchAll();
        $volume = sizeof($totuser);
        $nombre = count($totuser);
        //verification login existant
        if ($volume > 0) {
            /*             * *****************************JOURAL ENTRY****************** */
            $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
            $log = "*" . date('d-m-Y H:i:s') . ": Tentative de création d'un nouvel utilisateur avec identifiant déjà utilisé par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
            fwrite($login_log, $log);
            fclose($login_log);
            /*             * *************************************************************** */
            echo
            '<script type="text/javascript" language="javascript">
                    alert("Le login que vous avez entré existe déjà; prière choisir un autre");
                    window.location.href="utilisateurs.php?dyp=*";
                </script>';
        } else {
            //liste des users
            $nbreut = "SELECT *FROM [Afriquepesage].[dbo].[UTILISATEUR]";
            $nbrut = $conn->query($nbreut);
            $totdef = $nbrut->fetchAll();
            $dernier = sizeof($totdef) + 1;
            //
            $id = 'UT' . $_POST['site'] . '0' . $dernier;
            $n = $_POST['nom'];
            $p = $_POST['prenom'];
            $c = $_POST['contacts'];
            $cou = $_POST['courriel'];
            $lo = $_POST['login'];
            $mp = md5(md5($_POST['motpasse1']));
            $tpu = $_POST['typeut'];
            $si = $_POST['site'];
            $stt = 0;
            $req = "INSERT INTO [dbo].[UTILISATEUR]([ID_USER] ,[ID_TYPE_UTILISATEUR] ,[NOM_UT],[PRENOM_UT],[CONTACT_UT],[COURRIEL_UT],[LOGIN_UT],[MP_UT],[NUM_S],[STATUT_UT],[MP_UT_C]) VALUES(:ID_USER,:ID_TYPE_UTILISATEUR,:NOM_UT,:PRENOM_UT,:CONTACT_UT,:COURRIEL_UT,:LOGIN_UT,:MP_UT,:NUM_S,:STATUT_UT,:MP_UT_C)";
            $rq = $conn->prepare($req);
            //$rq->execute(array('[ID_USER]'=>$id,'[ID_TYPE_UTILISATEUR]'=>$tpu,'[NOM_UT]'=>$n,'[PRENOM_UT]'=>$p,'[CONTACT_UT]'=>$c,'[COURRIEL_UT]'=>$cou,'[LOGIN_UT]'=>$login,'[MP_UT]'=>$mp,'[NUM_S]'=>$si));
            $rq->bindParam(':ID_USER', $id);
            $rq->bindParam(':ID_TYPE_UTILISATEUR', $tpu);
            $rq->bindParam(':NOM_UT', $n);
            $rq->bindParam(':PRENOM_UT', $p);
            $rq->bindParam(':CONTACT_UT', $c);
            $rq->bindParam(':COURRIEL_UT', $cou);
            $rq->bindParam(':LOGIN_UT', $lo);
            $rq->bindParam(':MP_UT', $mp);
            $rq->bindParam(':NUM_S', $si);
            $rq->bindParam(':STATUT_UT', $tt);
            $rq->bindParam(':MP_UT_C', $tt);
            $rq->execute();
            if ($rq) {
                /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') . ": Création d'un nouvel utilisateur *" . $n . " *" . $p . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
                echo "<script>alert('UTILISATEUR CREE'); window.location.href='utilisateurs.php';</script>";
            }
        }
        //  }
    }
}
$info = "";


if (isset($_POST['search'])) {
    $num = $_POST['sites'];
    $userscount = "SELECT [Afriquepesage].[dbo].[UTILISATEUR].[ID_TYPE_UTILISATEUR],[ID_USER],[NOM_UT],[PRENOM_UT],[COURRIEL_UT],[LOGIN_UT], [CONTACT_UT],[MP_UT],[STATUT_UT],[LIBELLE_TYPE_UTILISATEUR],[nom_S] "
            . "     FROM [Afriquepesage].[dbo].[UTILISATEUR],[Afriquepesage].[dbo].[TYPE_UTILISATEUR],[Afriquepesage].[dbo].[Site] "
            . "     WHERE [Afriquepesage].[dbo].[UTILISATEUR].ID_TYPE_UTILISATEUR=[Afriquepesage].[dbo].[TYPE_UTILISATEUR].ID_TYPE_UTILISATEUR  "
            . "     AND  [Afriquepesage].[dbo].[UTILISATEUR].[num_S]=[Afriquepesage].[dbo].[Site].[num_S] and [Afriquepesage].[dbo].[Site].[num_S]='$num'";
    $users = $conn->query($userscount);
    $totaluserss = $users->fetchAll();
} else {

    $userscount = "SELECT [Afriquepesage].[dbo].[UTILISATEUR].[ID_TYPE_UTILISATEUR],[ID_USER],[NOM_UT],[PRENOM_UT],[COURRIEL_UT],[LOGIN_UT], [CONTACT_UT],[MP_UT],[STATUT_UT],[LIBELLE_TYPE_UTILISATEUR],[nom_S] "
            . "     FROM [Afriquepesage].[dbo].[UTILISATEUR],[Afriquepesage].[dbo].[TYPE_UTILISATEUR],[Afriquepesage].[dbo].[Site] "
            . "     WHERE [Afriquepesage].[dbo].[UTILISATEUR].ID_TYPE_UTILISATEUR=[Afriquepesage].[dbo].[TYPE_UTILISATEUR].ID_TYPE_UTILISATEUR  "
            . "     AND  [Afriquepesage].[dbo].[UTILISATEUR].[num_S]=[Afriquepesage].[dbo].[Site].[num_S]";
    $users = $conn->query($userscount);
    $totaluserss = $users->fetchAll();
}

//liste des types user
$typeusers = "SELECT [ID_TYPE_UTILISATEUR],[LIBELLE_TYPE_UTILISATEUR] ,[ABREVIATION]FROM [dbo].[TYPE_UTILISATEUR]";
$typ = $conn->query($typeusers);
$totaltype = $typ->fetchAll();

//liste des sites
$selectsite = "SELECT [NUM_S] ,[NOM_S] ,[ADRESSE_S] ,[CODEPOSTAL_S] ,[VILLE_S] ,[PAYS_S] ,[CONTACT_S] ,[TEL_S] ,[FAX_S] ,[EMAIL_S] ,[LOGO_S] ,[COMMENTAIRE_S] FROM [dbo].[SITE]";
$listsite = $conn->query($selectsite);
$totalsite = $listsite->fetchAll();
if (isset($_POST['password_save'])) {
    //GET INFO OF THE ONE WHOSE PASSWOERD BEEN RESET
    $id = $_POST['user'];
    $user_fetch = "SELECT [NOM_UT],[PRENOM_UT],[LIBELLE_TYPE_UTILISATEUR] FROM [Afriquepesage].[dbo].[UTILISATEUR],[Afriquepesage].[dbo].[TYPE_UTILISATEUR] where [Afriquepesage].[dbo].[UTILISATEUR].ID_TYPE_UTILISATEUR=[Afriquepesage].[dbo].[TYPE_UTILISATEUR].ID_TYPE_UTILISATEUR AND [Afriquepesage].[dbo].[UTILISATEUR].ID_USER='$id'";
    $user = $conn->query($user_fetch);
    $user_info = $user->fetch();
    //crypt the password
    $m_p1 = md5('123456');
    $m_p = md5($m_p1);
    //update field
    $sql = "UPDATE [dbo].[UTILISATEUR]  SET [MP_UT] = ?, [MP_UT_C] = ? WHERE [ID_USER] = ?";
    $q = $conn->prepare($sql);
    $q->execute(array($m_p, 0, $_POST['user']));
    /*     * *****************************JOURAL ENTRY****************** */
    $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
    $log = "*" . date('d-m-Y H:i:s') . ": Re-Initialisation du mot de passe de " . preg_replace('/\s+/', '', $user_info['NOM_UT']) . " " . preg_replace('/\s+/', '', $user_info['PRENOM_UT']) . " " . preg_replace('/\s+/', '', $user_info['LIBELLE_TYPE_UTILISATEUR']) . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
    fwrite($login_log, $log);
    fclose($login_log);
    /*     * *************************************************************** */
    $info = "MOT DE PASSE RE-INITIALISE A 123456";
    echo
    '<script type="text/javascript" language="javascript">
                alert("' . $info . '");
                    window.location.href="utilisateurs.php";
            </script>';
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
                                <h1>GESTION UTILISATEURS <small>Afrique Pesage </small></h1>
                                <img src="assets/images/signature-big-logo.png" alt="log AFP" style="float: right;margin-right: 19%; "/>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['dyp'])) {
                        ?>

                        <div class="col-sm-12" >
                            <form  method="POST" action="utilisateurs.php">
                                <div class="col-sm-4">
                                    <table border="0" >

                                        <tr>
                                            <td><label class="col-sm-10 control-label">NOM </label></td> 
                                            <td><input type="text" name="nom" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"> </input> </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">P&Eacute;NOMS</label> </td>
                                            <td><input type="text" name="prenom" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid2(this)" onblur="valid2(this)"> </input> </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">CELLULAIRE </label></td>
                                            <td><input type="text" name="contacts" id="form-field-1" class="form-control" required placeholder="" onkeyup="valid(this)" onblur="valid(this)"> </input></td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">COURRIEL</label> </td>
                                            <td><input type="email" name="courriel" id="form-field-1" class="form-control" required placeholder="mail@email.com"> </input> </td>
                                        </tr>
                                        <tr>
                                            <td><label class="col-sm-10 control-label">LOGIN </label></td>
                                            <td><input type="text" name="login" id="form-field-1" class="form-control" required placeholder=""onkeyup="valid3(this)" onblur="valid3(this)">  </input>  </td>
                                        </tr> 
                                        <tr>
                                            <td><label class="col-sm-12 control-label">MOT DE PASSE</label> </td>
                                            <td><input type="password" name="motpasse1" id="form-field-1" value="123456" class="form-control" required placeholder="" readonly> </input>  </td>
                                        </tr> 
                                       <!-- <tr>
                                            <td><label class="col-sm-10 control-label">Confirmer le Mot de passe</label> </td>
                                            <td><input type="password" name="motpasse2" id="form-field-1" value="123456" class="form-control" required placeholder="" readonly> </input>  </td>
                                        </tr> -->
                                        <tr>
                                            <td><label class="col-sm-12 control-label">TYPE UTILISATEUR</label> </td>
                                            <td>
                                                <select name="typeut" size="1" id="form-field-1" class="form-control">
                                                    <option value="NULL">&nbsp;</option>
                                                    <?php
                                                    foreach ($totaltype as $tot) {
                                                        //  echo '<option value="'.$tot['ID_TYPE_UTILISATEUR'].'"> '.$tot['LIBELLE_TYPE_UTILISATEUR'].'</option>';
                                                        ?>

                                                        <option value="<?php echo $tot['ID_TYPE_UTILISATEUR']; ?>"> <?php echo $tot['LIBELLE_TYPE_UTILISATEUR']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>

                                        </tr> 
                                        <tr>
                                            <td><label class="col-sm-10 control-label">SITE</label></td>
                                            <td> 
                                                <select name="site" size="1" id="form-field-1" class="form-control">
                                                    <option value="NULL">&nbsp;</option>
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
                                        </tr>
                                    </table> 
                                    <br/><br/>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="submit" value="SAUVER" name="enregistrer" class="btn btn-green btn-lg"/>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <input type="reset" value="ANNULER" class="btn btn-red btn-lg"/>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <a href="intro_admin.php" class="btn btn-blue btn-lg">Retour</a>
                                            </td>

                                        </tr>
                                    </table>
                                </div>
                            </form>
                            <div class="col-sm-8">
                                <!-------------------->

                                <div class="row" style="margin-top:3%;">
                                    <form method="post" action="utilisateurs.php">
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
                                                <td><select name="sites" id="form-field-select-1" class="form-control" >
                                                        <option value="">liste des Sites...</option>
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
                                                        <button type = "submit" class = "btn btn-blue" name="search">
                                                            RECHERCHE
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                                <!-- start: DYNAMIC TABLE PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Liste des utilisateurs
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                            <thead>
                                                <tr>
                                                    <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Nom & Pr&eacute;noms</label> </th> 
                                                    <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Contact</label> </th>
                                                    <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Courriel</label> </th>
                                                    <!--<th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Login</label> </th>-->

                                                    <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Type Utilisateur</label> </th>
                                                    <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Site</label> </th>
                                                    <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Statut</label> </th>
                                                    <th bgcolor="#E8B0C2" ><label class="col-sm-10 control-label">Action</label> </th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($totaluserss == 0) {
                                                    echo '<tr>
                                                        <td colspan="7">Aucun Utilisateurs dans la base de données </td>
                                                    </tr>   ';
                                                } else {
                                                    foreach ($totaluserss as $totalusers) {
                                                        $cle = $totalusers['ID_USER'];
                                                        $nom = $totalusers['NOM_UT'];
                                                        $prenom = $totalusers['PRENOM_UT'];
                                                        $contacts = $totalusers['CONTACT_UT'];
                                                        $courriel = $totalusers['COURRIEL_UT'];
                                                        //    $loginut = $totalusers['LOGIN_UT'];
                                                        $motpasse = $totalusers['MP_UT'];
                                                        $libtype = $totalusers['LIBELLE_TYPE_UTILISATEUR'];
                                                        $idtype = $totalusers['ID_TYPE_UTILISATEUR'];
                                                        $site = $totalusers['nom_S'];
                                                        $stat = $totalusers['STATUT_UT'];
                                                        if ($stat == 0) {
                                                            echo '<tr>
                                                        <td style="padding-left: 5px">' . $nom . ' ' . $prenom . '</td> 
                                                        <td style="padding-left: 5px">' . $contacts . '</td> 
                                                        <td style="padding-left: 5px"> ' . $courriel . '</td> 
                                                        
                                                        <td style="padding-left: 5px">' . $libtype . '</td>  
                                                        <td style="padding-left: 5px">' . $site . '</td>  
                                                        <td style="padding-left: 5px">Inactif</td>    
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="suppuser.php?id=' . $cle . '&s=ac"><img src="assets/images/actif.PNG" width="80"></img></a></td>    
                                                    
                                                    </tr>   ';
                                                        } else {
                                                            echo '<tr>
                                                        <td style="padding-left: 5px">' . $nom . ' ' . $prenom . '</td> 
                                                        <td style="padding-left: 5px">' . $contacts . '</td> 
                                                        <td style="padding-left: 5px"> ' . $courriel . '</td> 
                                                      
                                                        <td style="padding-left: 5px">' . $libtype . '</td> 
                                                        <td style="padding-left: 5px">' . $site . '</td> 
                                                        <td style="padding-left: 5px">Actif</td>
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="suppuser.php?id=' . $cle . '&s=in"><img src="assets/images/inactif.png" width="80"></img></a></td>    
                                                    </tr>   ';
                                                        }
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
                    <?php
                } else {
                    ?>
                    <div class="col-sm-12" style="margin-top:1.5%;">
                        <form method="post" action="utilisateurs.php">
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
                                    <td><select name="sites" id="form-field-select-1" class="form-control" >
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
                                            <button type = "submit" class = "btn btn-blue" name="search">
                                                RECHERCHE
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <!-- start: DYNAMIC TABLE PANEL -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Liste des utilisateurs
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style="margin-top: 2%;">
                                    <thead>
                                        <tr>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Nom & Pr&eacute;noms</label> </th> 
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Contact</label> </th>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Courriel</label> </th>
                                            <!--<th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Login</label> </th>-->

                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Type Utilisateur</label> </th>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Site</label> </th>
                                            <th bgcolor="#E8B0C2"><label class="col-sm-10 control-label">Statut</label> </th>
                                            <th bgcolor="#E8B0C2" ><label class="col-sm-10 control-label">Action</label> </th>
                                            <th bgcolor="#E8B0C2" ><label class="col-sm-10 control-label">Modif</label> </th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($totaluserss == 0) {
                                            echo '<tr>
                                                        <td colspan="7">Aucun Utilisateurs dans la base de données </td>
                                                    </tr>   ';
                                        } else {
                                            foreach ($totaluserss as $totalusers) {
                                                $cle = $totalusers['ID_USER'];
                                                $nom = $totalusers['NOM_UT'];
                                                $prenom = $totalusers['PRENOM_UT'];
                                                $contacts = $totalusers['CONTACT_UT'];
                                                $courriel = $totalusers['COURRIEL_UT'];
                                                // $loginut = $totalusers['LOGIN_UT'];
                                                $motpasse = $totalusers['MP_UT'];
                                                $libtype = $totalusers['LIBELLE_TYPE_UTILISATEUR'];
                                                $idtype = $totalusers['ID_TYPE_UTILISATEUR'];
                                                $site = $totalusers['nom_S'];
                                                $stat = $totalusers['STATUT_UT'];
                                                if ($stat == 0) {
                                                    echo '<tr>
                                                        <td style="padding-left: 5px">' . $nom . ' ' . $prenom . '</td> 
                                                        <td style="padding-left: 5px">' . $contacts . '</td> 
                                                        <td style="padding-left: 5px"> ' . $courriel . '</td> 
                                                        
                                                        <td style="padding-left: 5px">' . $libtype . '</td>  
														<td style="padding-left: 5px">' . $site . '</td>  
                                                        <td style="padding-left: 5px">Inactif</td>    
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="suppuser.php?id=' . $cle . '&s=ac"><img src="assets/images/actif.PNG" width="80"></img></a></td>    
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="modif_utilisateurs.php?id_user=' . $cle . '"><img src="assets/images/crayon.png"/></img></a></td>    

                                                    </tr>   ';
                                                } else {
                                                    echo '<tr>
                                                        <td style="padding-left: 5px">' . $nom . ' ' . $prenom . '</td> 
                                                        <td style="padding-left: 5px">' . $contacts . '</td> 
                                                        <td style="padding-left: 5px"> ' . $courriel . '</td> 
                                                      
                                                        <td style="padding-left: 5px">' . $libtype . '</td>  
														<td style="padding-left: 5px">' . $site . '</td> 
                                                        <td style="padding-left: 5px">Actif</td>
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="suppuser.php?id=' . $cle . '&s=in"><img src="assets/images/inactif.png" width="80"></img></a></td>    
                                                        <td style="padding-top:2px;padding-bottom:2px;padding-left:2px"><a href="modif_utilisateurs.php?id_user=' . $cle . '"><img src="assets/images/crayon.png"/></img></a></td>    

                                                    </tr>   ';
                                                }
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
                                        <td>&nbsp;</td>
                                        <?php
                                        if($_SESSION['m_a']!="admin.master"){
                                            
                                        }else{
                                        ?>
                                        <td>
                                            <a class="btn btn-blue btn-lg" href="#password" data-toggle="modal" >
                                                R&Eacute;-INITIALISATION
                                                <i class="fa fa-refresh"></i>
                                            </a>   
                                        </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- end: DYNAMIC TABLE PANEL -->
                    </div>
                    <?php
                }
                ?>
                <div style="width:100px; margin: 0 auto;">

                </div>
            </div>
            <div style="width:100px; margin: 0 auto;">

                <div id = "password" class = "modal fade" tabindex = "-1" data-width = "300" style = "display: none;">
                    <div class = "modal-header">
                        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                            &times;
                        </button>
                        <center>
                            <h6 class = "modal-title mod">CHOISIR LE NOM DE L'UTILISATEUR ET CLIQUER SUR RE-INITIALISER MOT DE PASSE</h6>
                        </center>
                    </div>
                    <form method="post" id="search_form" action="">
                        <div class = "modal-body">
                            <div class = "row">
                                <div class = "col-md-12">
                                    <p >
                                    <td> 
                                        <select name="user" size="1" id="form-field-1" class="form-control" required="true" >
                                            <option value="">Nom d'utilisateurs ...</option>
                                            <?php
                                            foreach ($totaluserss as $totalusers) {
                                                // echo '<option value="'.$totsite['NUM_S'].'"> '.$totsite['NOM_S'].'</option>';
                                                ?>
                                                <option value="<?php echo $totalusers['ID_USER']; ?>"> <?php echo $totalusers['NOM_UT'] . " " . $totalusers['PRENOM_UT'] . " (" . $totalusers['LIBELLE_TYPE_UTILISATEUR'] . ")"; ?></option>
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
                            <!-- <button type = "button" data-dismiss = "modal" class = "btn btn-blue">
                                 FERMER
                             </button>-->
                            <button type = "submit" class = "btn btn-red" name="password_save">
                                RE-INITALISER MOT DE PASSE
                                <i class="fa fa-exclamation-triangle"></i>
                            </button>
                        </div>
                    </form>
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
<!-- end: BODY -->
</html>