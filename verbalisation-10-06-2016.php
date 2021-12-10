<?php

/*
 * Author: y.dago@afriquepesage.com
 * Session Initialization 
 * Initialisation de session
 */
session_start();
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
if ($_SESSION['ApplicationExtSurcharge'] == 1) {
    $req = "INSERT INTO [dbo].[VERBALISATION] ([ID_VERB],[ID_USER],[NUMERO_PESE],[DATE_VERB],[DATE_PESEE_WIM],[NATIONALITE],[TRANSIT],[PDPUIT_DANGE],[LOGIN_OP],[AMENDE_TOTAL],[EXPORTATEUR],[IMMAT_VEHICULE],[PRODUIT_TRANSPORTE],[PROV_DEST],[NOM_STE],[POIDS_TOTAL],[CLASSE_VEHICULE],[PAIMENT_VERBA],[NOM_CLIENT],[SILHOUETTE_VEHICULE],[NUM_PESEE_WIM],[POIDS_MAX_VEHICULE],[EXCEDENT_ENREGISTRE],[SEUIL_EXTREME_SURCHARGE],[EXTREME_SURCHARGE],[SURCHARGE],[OVERLOAD_NAME],[OVERLOAD_MASS],[OVERLOAD_FINE],[COMPTE_CLIENT],[TRAITE]) 
		 VALUES(:ID_VERB,:ID_USER,:NUMERO_PESE,:DATE_VERB,:DATE_PESEE_WIM,:NATIONALITE,:TRANSIT,:PDPUIT_DANGE,:LOGIN_OP,:AMENDE_TOTAL,:EXPORTATEUR,:IMMAT_VEHICULE,:PRODUIT_TRANSPORTE,:PROV_DEST,:NOM_STE,:POIDS_TOTAL,:CLASSE_VEHICULE,:PAIMENT_VERBA,:NOM_CLIENT,:SILHOUETTE_VEHICULE,:NUM_PESEE_WIM,:POIDS_MAX_VEHICULE,:EXCEDENT_ENREGISTRE,:SEUIL_EXTREME_SURCHARGE,:EXTREME_SURCHARGE,:SURCHARGE,:OVERLOAD_NAME,:OVERLOAD_MASS,:OVERLOAD_FINE,:COMPTE_CLIENT,:TRAITE)";

    $q = $conn->prepare($req);
    $q->execute(array(':ID_VERB' => $_SESSION['num_verb'],
        ':ID_USER' => $_SESSION['userid'],
        ':NUMERO_PESE' => $_SESSION['num_pesee_webafp'],
        ':DATE_VERB' => date('d-m-Y H:i:s'),
        ':DATE_PESEE_WIM' => $_SESSION['date_wim_pesee'],
        ':NATIONALITE' => $_SESSION['nationalite'],
        ':TRANSIT' => $_SESSION['transport'],
        ':PDPUIT_DANGE' => $_SESSION['produit_dangereux'],
        ':LOGIN_OP' => $_SESSION['login_utilisateur'],
        ':AMENDE_TOTAL' => $_SESSION['bill'],
        ':EXPORTATEUR' => $_SESSION['exportateur'],
        ':IMMAT_VEHICULE' => $_SESSION['immatriculation'],
        ':PRODUIT_TRANSPORTE' => $_SESSION['produit_transporte'],
        ':PROV_DEST' => $_SESSION['prov_dest'],
        ':NOM_STE' => $_SESSION['site'],
        ':POIDS_TOTAL' => $_SESSION['poid_total'],
        ':CLASSE_VEHICULE' => $_SESSION['class_vehicule'],
        ':PAIMENT_VERBA' => 0,
        ':NOM_CLIENT' => $_SESSION['nom_client'],
        ':SILHOUETTE_VEHICULE' => $_SESSION['photo'],
        ':NUM_PESEE_WIM' => $_SESSION['num_pesee_wim'],
        ':POIDS_MAX_VEHICULE' => $_SESSION['poidsMax_VP'],
        ':EXCEDENT_ENREGISTRE' => $_SESSION['surcharge_Vehicule_Pesee'],
        ':SEUIL_EXTREME_SURCHARGE' => $_SESSION['seuil_ext_surc'],
        ':EXTREME_SURCHARGE' => $_SESSION['value_extreme_surcharge'],
        ':SURCHARGE' => $_SESSION['value_surcharge'],
        ':OVERLOAD_NAME' => $_SESSION['overload_name'],
        ':OVERLOAD_MASS' => $_SESSION['overload_mass'],
        ':OVERLOAD_FINE' => $_SESSION['prix_pesee_simple'],
        ':COMPTE_CLIENT' => $_POST['dyp'],
        ':TRAITE' => 0));

    if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
        //echo sizeof($_SESSION['LIBELLE_TYPE_INF']);

        for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
            //echo $_SESSION['LIBELLE_TYPE_INF'][$i].' '.$_SESSION['CODE_TYPE_INF'][$i].' '.$_SESSION['LIBELLE_TYPE_INF'][$i].' '.$_SESSION['LIBELLE_CODE_INF'][$i].' '.$_SESSION['MONTANT_INF'][$i].'<br>';
            /**/
            $req2 = "INSERT INTO [dbo].[VERBALISATION_INFRACTION] ([CODE_TYPE_INF],[LIBELLE_TYPE_INF],[ID_VERB],[LIBELLE_CODE_INF],[MONTANT_AMENDE]) 
		 VALUES(:CODE_TYPE_INF,:LIBELLE_TYPE_INF,:ID_VERB,:LIBELLE_CODE_INF,:MONTANT_AMENDE)";
            $q2 = $conn->prepare($req2);
            $q2->execute(array(':CODE_TYPE_INF' => $_SESSION['CODE_TYPE_INF'][$i],
                ':LIBELLE_TYPE_INF' => $_SESSION['LIBELLE_TYPE_INF'][$i],
                ':ID_VERB' => $_SESSION['num_verb'],
                ':LIBELLE_CODE_INF' => $_SESSION['LIBELLE_CODE_INF'][$i],
                ':MONTANT_AMENDE' => $_SESSION['MONTANT_INF'][$i]));
        }
    } else {
        $q2 = $q;
    }

    if ($q && $q2) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/verbalisation/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Verbalisation Nº " . $_SESSION['num_verb'] . " effectué sur la *" . $_SESSION['site']. " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "VERBALISATION ENREGISTREE";
    } else {
        echo "Error";
    }
} else {
    $req = "INSERT INTO [dbo].[VERBALISATION] ([ID_VERB],[ID_USER],[NUMERO_PESE],[DATE_VERB],[DATE_PESEE_WIM],[NATIONALITE],[TRANSIT],[PDPUIT_DANGE],[LOGIN_OP],[AMENDE_TOTAL],[EXPORTATEUR],[IMMAT_VEHICULE],[PRODUIT_TRANSPORTE],[PROV_DEST],[NOM_STE],[POIDS_TOTAL],[CLASSE_VEHICULE],[PAIMENT_VERBA],[NOM_CLIENT],[SILHOUETTE_VEHICULE],[NUM_PESEE_WIM],[POIDS_MAX_VEHICULE], [SEUIL_EXTREME_SURCHARGE], [SURCHARGE],[OVERLOAD_NAME],[OVERLOAD_MASS],[OVERLOAD_FINE],[COMPTE_CLIENT],[TRAITE]) 
		 VALUES(:ID_VERB,:ID_USER,:NUMERO_PESE,:DATE_VERB,:DATE_PESEE_WIM,:NATIONALITE,:TRANSIT,:PDPUIT_DANGE,:LOGIN_OP,:AMENDE_TOTAL,:EXPORTATEUR,:IMMAT_VEHICULE,:PRODUIT_TRANSPORTE,:PROV_DEST,:NOM_STE,:POIDS_TOTAL,:CLASSE_VEHICULE,:PAIMENT_VERBA,:NOM_CLIENT,:SILHOUETTE_VEHICULE,:NUM_PESEE_WIM,:POIDS_MAX_VEHICULE,:SEUIL_EXTREME_SURCHARGE, :SURCHARGE,:OVERLOAD_NAME,:OVERLOAD_MASS,:OVERLOAD_FINE,:COMPTE_CLIENT,:TRAITE)";

    $q = $conn->prepare($req);
    $q->execute(array(':ID_VERB' => $_SESSION['num_verb'],
        ':ID_USER' => $_SESSION['userid'],
        ':NUMERO_PESE' => $_SESSION['num_pesee_webafp'],
        ':DATE_VERB' => date('d-m-Y H:i:s'),
        ':DATE_PESEE_WIM' => $_SESSION['date_wim_pesee'],
        ':NATIONALITE' => $_SESSION['nationalite'],
        ':TRANSIT' => $_SESSION['transport'],
        ':PDPUIT_DANGE' => $_SESSION['produit_dangereux'],
        ':LOGIN_OP' => $_SESSION['login_utilisateur'],
        ':AMENDE_TOTAL' => $_SESSION['bill'],
        ':EXPORTATEUR' => $_SESSION['exportateur'],
        ':IMMAT_VEHICULE' => $_SESSION['immatriculation'],
        ':PRODUIT_TRANSPORTE' => $_SESSION['produit_transporte'],
        ':PROV_DEST' => $_SESSION['prov_dest'],
        ':NOM_STE' => $_SESSION['site'],
        ':POIDS_TOTAL' => $_SESSION['poid_total'],
        ':CLASSE_VEHICULE' => $_SESSION['class_vehicule'],
        ':PAIMENT_VERBA' => 0,
        ':NOM_CLIENT' => $_SESSION['nom_client'],
        ':SILHOUETTE_VEHICULE' => $_SESSION['photo'],
        ':NUM_PESEE_WIM' => $_SESSION['num_pesee_wim'],
        ':POIDS_MAX_VEHICULE' => $_SESSION['poidsMax_VP'],
        ':SEUIL_EXTREME_SURCHARGE' => 'NONE',
        ':SURCHARGE' => $_SESSION['surcharge_Vehicule_Pesee'],
        ':OVERLOAD_NAME' => $_SESSION['overload_name'],
        ':OVERLOAD_MASS' => $_SESSION['overload_mass'],
        ':OVERLOAD_FINE' => $_SESSION['prix_pesee_simple'], 
        ':COMPTE_CLIENT' => $_POST['dyp'], 
        ':TRAITE' => 0));

    if (isset($_SESSION['LIBELLE_TYPE_INF'])) {
        //echo sizeof($_SESSION['LIBELLE_TYPE_INF']);

        for ($i = 0; $i < sizeof($_SESSION['LIBELLE_TYPE_INF']); $i++) {
            //echo $_SESSION['LIBELLE_TYPE_INF'][$i].' '.$_SESSION['CODE_TYPE_INF'][$i].' '.$_SESSION['LIBELLE_TYPE_INF'][$i].' '.$_SESSION['LIBELLE_CODE_INF'][$i].' '.$_SESSION['MONTANT_INF'][$i].'<br>';
            /**/
            $req2 = "INSERT INTO [dbo].[VERBALISATION_INFRACTION] ([CODE_TYPE_INF],[LIBELLE_TYPE_INF],[ID_VERB],[LIBELLE_CODE_INF],[MONTANT_AMENDE]) 
		 VALUES(:CODE_TYPE_INF,:LIBELLE_TYPE_INF,:ID_VERB,:LIBELLE_CODE_INF,:MONTANT_AMENDE)";
            $q2 = $conn->prepare($req2);
            $q2->execute(array(':CODE_TYPE_INF' => $_SESSION['CODE_TYPE_INF'][$i],
                ':LIBELLE_TYPE_INF' => $_SESSION['LIBELLE_TYPE_INF'][$i],
                ':ID_VERB' => $_SESSION['num_verb'],
                ':LIBELLE_CODE_INF' => $_SESSION['LIBELLE_CODE_INF'][$i],
                ':MONTANT_AMENDE' => $_SESSION['MONTANT_INF'][$i]));
        }
    } else {
        $q2 = $q;
    }

    if ($q && $q2) {
        /*         * *****************************JOURAL ENTRY****************** */
        $login_log = fopen("assets/log/verbalisation/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
        $log = "*" . date('d-m-Y H:i:s') .": Verbalisation Nº " . $_SESSION['num_verb'] . " effectué sur la *" . $_SESSION['site']. " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . "\n\n";
        fwrite($login_log, $log);
        fclose($login_log);
        /*         * *************************************************************** */
        echo "VERBALISATION ENREGISTREE";
    } else {
        echo "Error";
    }
}
