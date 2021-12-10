<?php

/*
 * Author: y.dago@afriquepesage.com
 * This File is used to Access Each Dashboard 
 * Ce Fichier est utilisé pour Acceder aux différents tableau de bord
 */
session_start();

include 'AfriquepesageConnection.php';
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    
} else {
    /*
     *  $login = $_POST['username'];
     *  $password = $_POST['password'];
     * echo $login . '' . $password;
     */
    if (isset($_POST['connexion'])) {
        $login = $_POST['username'];
        $pwd = md5( $_POST['password']);
        $passwd = md5($pwd);
        /*
         * Check If user exists 
         * Verifier si l'utilisateur exists
         */
        $userscount = "SELECT [ID_USER],[ID_TYPE_UTILISATEUR],[NOM_UT],[PRENOM_UT],[COURRIEL_UT],[LOGIN_UT],[NUM_S], COUNT(*) OVER (PARTITION BY 1) as RowCnt FROM [Afriquepesage].[dbo].[UTILISATEUR] where [LOGIN_UT] ='$login' AND [MP_UT] = '$passwd'";
        $users = $conn->query($userscount);
        $totalusers = $users->fetch();
        /*
         * get site key
         * recuperer la cle de la table site
         */
        $info_site = $totalusers['NUM_S'];
        //echo $info_site;
        /*
         * Check user Site 
         * Chercher le Site de l'utilisateur 
         */
        $site_info_query = "SELECT [NUM_S] ,[NOM_S] FROM [Afriquepesage].[dbo].[SITE] where [NUM_S] ='$info_site'";
        $infos = $conn->query($site_info_query);
        $site_info = $infos->fetch();
        $_SESSION['site'] = $site_info['NOM_S'];
         $_SESSION['num_site'] = $info_site;
        
        /*
         * Get user's infos
         * Recuperer les infos de l'utilisateur
         */
        $_SESSION['nom_utilisateur'] = $totalusers['NOM_UT'] . '&nbsp;' . $totalusers['PRENOM_UT'];
        $_SESSION['login_utilisateur'] = $totalusers['LOGIN_UT'];
        $_SESSION['id_user'] = $totalusers['ID_TYPE_UTILISATEUR'];
        $_SESSION['userid'] = $totalusers['ID_USER'];
        if ($totalusers > 0) {
            $id_type = $totalusers['ID_TYPE_UTILISATEUR'];
            $user_info = $conn->query("SELECT [ABREVIATION] FROM [Afriquepesage].[dbo].[TYPE_UTILISATEUR] WHERE [ID_TYPE_UTILISATEUR] ='$id_type'");
            $libele_type = $user_info->fetch();
            //echo $libele_type['ABREVIATION'];
            $libele = preg_replace('/\s+/', '', $libele_type['ABREVIATION']);
            if (strcmp($libele, 'OP') == 0) {
                header("location: intro_operateur.php");
                die;
            } else if (strcmp($libele, 'CA') == 0) {
                header("location: intro_caissiere.php");
                die;
            } else if (strcmp($libele, 'RS') == 0) {
                //$_SESSION['id_admin'] = $nom_membre['id_admin'];
                header("location: intro_respo_site.php");
                die;
            } else if (strcmp($libele, 'RC') == 0) {
                header("location: intro_respo_caisse.php");
                die;
            } else if (strcmp($libele, 'AD') == 0) {
                header("location: intro_admin.php");
                die;
            } else {
            }
        } else {
            echo "<script>alert('MOT DE PASSE INCORECT VEUILLEZ RECOMMENECER')</script>";
        }
    }
}
?>
