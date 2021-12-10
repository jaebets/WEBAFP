<?php
session_start();
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
include 'penalite_config.php';
$check_pesee = $_SESSION['num_pesee'];
$site=$_SESSION['num_site'];
$mois=date('m');
$annee=date('y');

//Pesee
$sth_P = $dbh->prepare('SELECT a."Numero_Pesee", a."Id_VP", a."Date_Pesee", a."Heure_Pesee", a."Unite_Mesure_Pesee", a."Vitesse_Moyenne_Pesee", a."Acceleration_Moyenne_Pesee", a."Selectionne_Pesee", a."Photo_Pesee", a."Commentaire_Pesee", a."Utilisateur_Pesee", a."poids_total_vehicule_Pesee", a."surcharge_Vehicule_Pesee", a."Vitesse_Min_Pesee", a."Vitesse_Max_Pesee", a."Erreur_Pesee", a."Type_Pesee", a."position_virgule", a.RDB$DB_KEY FROM "Pesee" a where a."Id_VP" ='.$check_pesee);
$sth_P->execute();
$result_P = $sth_P->fetch();
$num_p=$result_P['Numero_Pesee'].$mois.$annee.$site;
$num_vp=$result_P['Id_VP'].$mois.$annee.$site;
$req = "INSERT INTO [dbo].[Pesee]
           ([Numero_Pesee]
           ,[Id_VP]
           ,[Date_Pesee]
           ,[Heure_Pesee]
           ,[Unite_Mesure_Pesee]
           ,[Vitesse_Moyenne_Pesee]
           ,[Acceleration_Moyenne_Pesee]
           ,[Selectionne_Pesee]
           ,[Photo_Pesee]
           ,[Commentaire_Pesee]
           ,[Utilisateur_Pesee]
           ,[poids_total_vehicule_Pesee]
           ,[surcharge_Vehicule_Pesee]
           ,[Vitesse_Min_Pesee]
           ,[Vitesse_Max_Pesee]
           ,[Erreur_Pesee]
           ,[Type_Pesee]
           ,[position_virgule])
     VALUES
           (:Numero_Pesee,:Id_VP,:Date_Pesee,:Heure_Pesee,:Unite_Mesure_Pesee,:Vitesse_Moyenne_Pesee,:Acceleration_Moyenne_Pesee,:Selectionne_Pesee,:Photo_Pesee,:Commentaire_Pesee,:Utilisateur_Pesee,:poids_total_vehicule_Pesee,:surcharge_Vehicule_Pesee,:Vitesse_Min_Pesee,:Vitesse_Max_Pesee,:Erreur_Pesee,:Type_Pesee,:position_virgule) ";
$rq = $conn->prepare($req);
$rq->bindParam(':Numero_Pesee', $num_p);
$rq->bindParam(':Id_VP', $num_vp);
$rq->bindParam(':Date_Pesee', $result_P['Date_Pesee']);
$rq->bindParam(':Heure_Pesee', $result_P['Heure_Pesee']);
$rq->bindParam(':Unite_Mesure_Pesee', $result_P['Unite_Mesure_Pesee']);
$rq->bindParam(':Vitesse_Moyenne_Pesee', $result_P['Vitesse_Moyenne_Pesee']);
$rq->bindParam(':Acceleration_Moyenne_Pesee', $result_P['Acceleration_Moyenne_Pesee']);
$rq->bindParam(':Selectionne_Pesee', $result_P['Selectionne_Pesee']);
$rq->bindParam(':Photo_Pesee', $result_P['Photo_Pesee']);
$rq->bindParam(':Commentaire_Pesee', $result_P['Commentaire_Pesee']);
$rq->bindParam(':Utilisateur_Pesee', $result_P['Utilisateur_Pesee']);
$rq->bindParam(':poids_total_vehicule_Pesee', $result_P['poids_total_vehicule_Pesee']);
$rq->bindParam(':surcharge_Vehicule_Pesee', $result_P['surcharge_Vehicule_Pesee']);
$rq->bindParam(':Vitesse_Min_Pesee', $result_P['Vitesse_Min_Pesee']);
$rq->bindParam(':Vitesse_Max_Pesee', $result_P['Vitesse_Max_Pesee']);
$rq->bindParam(':Erreur_Pesee', $result_P['Erreur_Pesee']);
$rq->bindParam(':Type_Pesee', $result_P['Type_Pesee']);
$rq->bindParam(':position_virgule', $result_P['position_virgule']);
$rq->execute(); 

//Champ Pesee
$sth_CP = $dbh->prepare('SELECT a."num_Champs", a."Numero_Pesee", a."valeur_champs", a.RDB$DB_KEY FROM "ChampsPese" a where a."Numero_Pesee" ='.$check_pesee);
$sth_CP->execute();
$result_CP0 = $sth_CP->fetchAll();
 foreach ($result_CP0 as $result_CP) {
$req5 = "INSERT INTO [dbo].[ChampsPese]
           ([num_Champs]
           ,[Numero_Pesee]
           ,[valeur_champs])
     VALUES
           (:num_Champs
           ,:Numero_Pesee
           ,:valeur_champs)";
$rq5 = $conn->prepare($req5);
$rq5->bindParam(':num_Champs',$result_CP['num_Champs']);
$rq5->bindParam(':Numero_Pesee', $num_p);
$rq5->bindParam(':valeur_champs',$result_CP['valeur_champs']);
$rq5->execute(); 
 }

//Pesee_vehicule
$sth_VP = $dbh->prepare('SELECT a."id_VP", a."nom_VP", a."poidsMax_VP", a."distFinMin_VP", a."distFinMax_VP", a."distFin_VP", a."longueurMax_VP", a."longueurMesure_VP", a."baseLongMesure_VP", a."hauteurMax_VP", a."hauteurMesure_VP", a."nbrMobiles_VP", a."image_VP", a."distancedebutMesuree_VP", a."distancedebutMin_VP", a."distancedebutMax_VP", a."erreur_VP", a.RDB$DB_KEY FROM "Vehicule_Pese" a where a."id_VP" ='.$result_P["Id_VP"]);
$sth_VP->execute();
$result_VP = $sth_VP->fetch();
$req1 = "INSERT INTO [dbo].[Vehicule_Pese]
           ([id_VP]
           ,[nom_VP]
           ,[poidsMax_VP]
           ,[distFinMin_VP]
           ,[distFinMax_VP]
           ,[distFin_VP]
           ,[longueurMax_VP]
           ,[longueurMesure_VP]
           ,[baseLongMesure_VP]
           ,[hauteurMax_VP]
           ,[hauteurMesure_VP]
           ,[nbrMobiles_VP]
           ,[image_VP]
           ,[distancedebutMesuree_VP]
           ,[distancedebutMin_VP]
           ,[distancedebutMax_VP]
           ,[erreur_VP])
     VALUES
           (:id_VP
           ,:nom_VP
           ,:poidsMax_VP
           ,:distFinMin_VP
           ,:distFinMax_VP
           ,:distFin_VP
           ,:longueurMax_VP
           ,:longueurMesure_VP
           ,:baseLongMesure_VP
           ,:hauteurMax_VP
           ,:hauteurMesure_VP
           ,:nbrMobiles_VP
           ,:image_VP
           ,:distancedebutMesuree_VP
           ,:distancedebutMin_VP
           ,:distancedebutMax_VP
           ,:erreur_VP)";
$rq1 = $conn->prepare($req1);
$rq1->bindParam(':id_VP',$num_vp );
$rq1->bindParam(':nom_VP',$result_VP['nom_VP'] );
$rq1->bindParam(':poidsMax_VP',$result_VP['poidsMax_VP'] );
$rq1->bindParam(':distFinMin_VP',$result_VP['distFinMin_VP'] );
$rq1->bindParam(':distFinMax_VP',$result_VP['distFinMax_VP'] );
$rq1->bindParam(':distFin_VP', $result_VP['distFin_VP']);
$rq1->bindParam(':longueurMax_VP',$result_VP['longueurMax_VP'] );
$rq1->bindParam(':longueurMesure_VP', $result_VP['longueurMesure_VP']);
$rq1->bindParam(':baseLongMesure_VP', $result_VP['baseLongMesure_VP']);
$rq1->bindParam(':hauteurMax_VP', $result_VP['hauteurMax_VP']);
$rq1->bindParam(':hauteurMesure_VP', $result_VP['hauteurMesure_VP']);
$rq1->bindParam(':nbrMobiles_VP',$result_VP['nbrMobiles_VP'] );
$rq1->bindParam(':image_VP', $result_VP['image_VP']);
$rq1->bindParam(':distancedebutMesuree_VP', $result_VP['distancedebutMesuree_VP']);
$rq1->bindParam(':distancedebutMin_VP',$result_VP['distancedebutMin_VP'] );
$rq1->bindParam(':distancedebutMax_VP',$result_VP['distancedebutMax_VP'] );
$rq1->bindParam(':erreur_VP',$result_VP['erreur_VP'] );
$rq1->execute(); 

//Mobile peseee
$sth_MP = $dbh->prepare('SELECT a."id_MP", a."id_VP", a."nom_MP", a."poidsMax_MP", a."nbrGroupes_MP", a."poidsMesure_MP", a."positionMobile_MP", a."distMinMobile_MP", a."distMaxMobile_MP", a."positionMobileMesure_MP", a."distMobileMesure_MP", a."erreur_MP", a.RDB$DB_KEY FROM "Mobile_Pese" a where a."id_VP" ='.$result_P["Id_VP"]);
$sth_MP->execute();
$result_MP0 = $sth_MP->fetchAll();
 foreach ($result_MP0 as $result_MP) {
$num_mp=$result_MP['id_MP'].$mois.$annee.$site;
$req2 = "INSERT INTO [dbo].[Mobile_Pese]
           ([id_MP]
           ,[id_VP]
           ,[nom_MP]
           ,[poidsMax_MP]
           ,[nbrGroupes_MP]
           ,[poidsMesure_MP]
           ,[positionMobile_MP]
           ,[distMinMobile_MP]
           ,[distMaxMobile_MP]
           ,[positionMobileMesure_MP]
           ,[distMobileMesure_MP]
           ,[erreur_MP])
     VALUES
           (:id_MP
           ,:id_VP
           ,:nom_MP
           ,:poidsMax_MP
           ,:nbrGroupes_MP
           ,:poidsMesure_MP
           ,:positionMobile_MP
           ,:distMinMobile_MP
           ,:distMaxMobile_MP
           ,:positionMobileMesure_MP
           ,:distMobileMesure_MP
           ,:erreur_MP)";
$rq2 = $conn->prepare($req2);
$rq2->bindParam(':id_MP', $num_mp);
$rq2->bindParam(':id_VP', $num_vp);
$rq2->bindParam(':nom_MP', $result_MP['nom_MP']);
$rq2->bindParam(':poidsMax_MP', $result_MP['poidsMax_MP']);
$rq2->bindParam(':nbrGroupes_MP', $result_MP['nbrGroupes_MP']);
$rq2->bindParam(':poidsMesure_MP', $result_MP['poidsMesure_MP']);
$rq2->bindParam(':positionMobile_MP', $result_MP['positionMobile_MP']);
$rq2->bindParam(':distMinMobile_MP', $result_MP['distMinMobile_MP']);
$rq2->bindParam(':distMaxMobile_MP', $result_MP['distMaxMobile_MP']);
$rq2->bindParam(':positionMobileMesure_MP', $result_MP['positionMobileMesure_MP']);
$rq2->bindParam(':distMobileMesure_MP', $result_MP['distMobileMesure_MP']);
$rq2->bindParam(':erreur_MP', $result_MP['erreur_MP']);
$rq2->execute(); 

//Groupe peseee
$sth_GP = $dbh->prepare('SELECT a."id_GP", a."id_MP", a."nom_GP", a."poidsMax_GP", a."nbrEssieux_GP", a."image_GP", a."poids_GP", a."distMinGroupe_GP", a."distMaxGroupe_GP", a."distGroupeMesure_GP", a."position_GP", a."erreur_GP", a.RDB$DB_KEY
FROM "Group_Pese" a WHERE a."id_MP" ='.$result_MP["id_MP"]);
$sth_GP->execute();
$result_GP1 = $sth_GP->fetchAll();
 foreach ($result_GP1 as $result_GP) {
$num_gp=$result_GP['id_GP'].$mois.$annee.$site;
$req3 = "INSERT INTO [dbo].[Group_Pese]
           ([id_GP]
           ,[id_MP]
           ,[nom_GP]
           ,[poidsMax_GP]
           ,[nbrEssieux_GP]
           ,[image_GP]
           ,[poids_GP]
           ,[distMinGroupe_GP]
           ,[distMaxGroupe_GP]
           ,[distGroupeMesure_GP]
           ,[position_GP]
           ,[erreur_GP])
     VALUES
           (:id_GP
           ,:id_MP
           ,:nom_GP
           ,:poidsMax_GP
           ,:nbrEssieux_GP
           ,:image_GP
           ,:poids_GP
           ,:distMinGroupe_GP
           ,:distMaxGroupe_GP
           ,:distGroupeMesure_GP
           ,:position_GP
           ,:erreur_GP)";
$rq3 = $conn->prepare($req3);
$rq3->bindParam(':id_GP', $num_gp);
$rq3->bindParam(':id_MP', $num_mp);
$rq3->bindParam(':nom_GP', $result_GP['nom_GP']);
$rq3->bindParam(':poidsMax_GP', $result_GP['poidsMax_GP']);
$rq3->bindParam(':nbrEssieux_GP', $result_GP['nbrEssieux_GP']);
$rq3->bindParam(':image_GP', $result_GP['image_GP']);
$rq3->bindParam(':poids_GP', $result_GP['poids_GP']);
$rq3->bindParam(':distMinGroupe_GP', $result_GP['distMinGroupe_GP']);
$rq3->bindParam(':distMaxGroupe_GP', $result_GP['distMaxGroupe_GP']);
$rq3->bindParam(':distGroupeMesure_GP', $result_GP['distGroupeMesure_GP']);
$rq3->bindParam(':position_GP', $result_GP['position_GP']);
$rq3->bindParam(':erreur_GP', $result_GP['erreur_GP']);
$rq3->execute(); 

//Essieu peseee
$sth_EP = $dbh->prepare('SELECT a."id_EP", a."id_GP", a."nom_EP", a."poidsMax_EP", a."poidsMesure_EP", a."distMinEssieu_EP", a."distMaxEssieu_EP", a."positionEssieuMesuree_EP", a."distEssieuMesuree_EP", a."vitesse_EP", a."acceleration_EP", a."erreur_EP", a.RDB$DB_KEY
FROM "Essieu_Pese" a  WHERE a."id_GP" ='.$result_GP["id_GP"]);
$sth_EP->execute();
$result_EP1 = $sth_EP->fetchAll();
 foreach ($result_EP1 as $result_EP) {
$num_ep=$result_EP['id_EP'].$mois.$annee.$site;
$req4 = "INSERT INTO [dbo].[Essieu_Pese]
           ([id_EP]
           ,[id_GP]
           ,[nom_EP]
           ,[poidsMax_EP]
           ,[poidsMesure_EP]
           ,[distMinEssieu_EP]
           ,[distMaxEssieu_EP]
           ,[positionEssieuMesuree_EP]
           ,[distEssieuMesuree_EP]
           ,[vitesse_EP]
           ,[acceleration_EP]
           ,[erreur_EP])
     VALUES
           (:id_EP
           ,:id_GP
           ,:nom_EP
           ,:poidsMax_EP
           ,:poidsMesure_EP
           ,:distMinEssieu_EP
           ,:distMaxEssieu_EP
           ,:positionEssieuMesuree_EP
           ,:distEssieuMesuree_EP
           ,:vitesse_EP
           ,:acceleration_EP
           ,:erreur_EP)";
$rq4 = $conn->prepare($req4);
$rq4->bindParam(':id_EP',$num_ep );
$rq4->bindParam(':id_GP',$num_gp );
$rq4->bindParam(':nom_EP',$result_EP['nom_EP'] );
$rq4->bindParam(':poidsMax_EP',$result_EP['poidsMax_EP'] );
$rq4->bindParam(':poidsMesure_EP',$result_EP['poidsMesure_EP'] );
$rq4->bindParam(':distMinEssieu_EP',$result_EP['distMinEssieu_EP'] );
$rq4->bindParam(':distMaxEssieu_EP',$result_EP['distMaxEssieu_EP'] );
$rq4->bindParam(':positionEssieuMesuree_EP',$result_EP['positionEssieuMesuree_EP'] );
$rq4->bindParam(':distEssieuMesuree_EP',$result_EP['distEssieuMesuree_EP'] );
$rq4->bindParam(':vitesse_EP',$result_EP['vitesse_EP'] );
$rq4->bindParam(':acceleration_EP',$result_EP['acceleration_EP'] );
$rq4->bindParam(':erreur_EP',$result_EP['erreur_EP'] );
$rq4->execute();
}
}
}
Header('location:intro_operateur.php')

 ?>