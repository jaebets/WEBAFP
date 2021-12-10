 
   
<?php
include 'connections/AfriquepesageConnection.php';
 $idt=$_GET['id'];
 $action=$_GET['s'];
 session_start();
 //CHECK IF REQUEST COMES FROM RESPO SITE
 if(isset($_GET['dyp'])){
if($action=="ac"){
    //ouvrir   
    $reqmajs="UPDATE [dbo].[UTILISATEUR] SET [STATUT_UT]=? WHERE [ID_USER]='".$idt."'";
    $requps=$conn->prepare($reqmajs);
    $requps->execute(array(1));
    $st = "SELECT [NOM_UT],[PRENOM_UT] FROM [Afriquepesage].[dbo].[UTILISATEUR] where [ID_USER]='".$idt."'";
    $st_user = $conn->query($st);
    $st_info = $st_user->fetch();
    /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') .": Activation de l'utilisateur *" .  preg_replace('/\s+/', '', $st_info['NOM_UT'])  . " *" .  preg_replace('/\s+/', '', $st_info['PRENOM_UT'])  . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
    echo "<script>
                    alert('UTILISATEUR ACTIVE');
                window.location.href='utilisateur_site.php';
                </script>"; 
}
if ($action=="in"){
    //suspendre  
    $reqmajs="UPDATE [dbo].[UTILISATEUR] SET [STATUT_UT]=? WHERE [ID_USER]='".$idt."'";
    $requps=$conn->prepare($reqmajs);
    $requps->execute(array(0));
    $st = "SELECT [NOM_UT],[PRENOM_UT] FROM [Afriquepesage].[dbo].[UTILISATEUR] where [ID_USER]='".$idt."'";
    $st_user = $conn->query($st);
    $st_info = $st_user->fetch();
    
    /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') .": Suspension de l'utilisateur *" .  preg_replace('/\s+/', '', $st_info['NOM_UT'])  . " *" .  preg_replace('/\s+/', '', $st_info['PRENOM_UT'])  . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
    echo "<script>
                    alert('UTILISATEUR SUSPENDU');
                window.location.href='utilisateur_site.php';
                </script>"; 
}

 }
 //THE REQUEST COMES FROM THE ADMIN
 else{
   if($action=="ac"){
    //ouvrir   
    $reqmajs="UPDATE [dbo].[UTILISATEUR] SET [STATUT_UT]=? WHERE [ID_USER]='".$idt."'";
    $requps=$conn->prepare($reqmajs);
    $requps->execute(array(1));
    $st = "SELECT [NOM_UT],[PRENOM_UT] FROM [Afriquepesage].[dbo].[UTILISATEUR] where [ID_USER]='".$idt."'";
    $st_user = $conn->query($st);
    $st_info = $st_user->fetch();
    /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') .": Activation de l'utilisateur *" .  preg_replace('/\s+/', '', $st_info['NOM_UT'])  . " *" .  preg_replace('/\s+/', '', $st_info['PRENOM_UT'])  . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
    echo "<script>
                    alert('UTILISATEUR ACTIVE');
                window.location.href='utilisateurs.php';
                </script>"; 
}
if ($action=="in"){
    //suspendre  
    $reqmajs="UPDATE [dbo].[UTILISATEUR] SET [STATUT_UT]=? WHERE [ID_USER]='".$idt."'";
    $requps=$conn->prepare($reqmajs);
    $requps->execute(array(0));
    $st = "SELECT [NOM_UT],[PRENOM_UT] FROM [Afriquepesage].[dbo].[UTILISATEUR] where [ID_USER]='".$idt."'";
    $st_user = $conn->query($st);
    $st_info = $st_user->fetch();
    
    /*                 * *****************************JOURAL ENTRY****************** */
                $login_log = fopen("assets/log/utilisateurs/journal" . date('d-m-Y'), "a+") or die("Unable to open file!");
                $log = "*" . date('d-m-Y H:i:s') .": Suspension de l'utilisateur *" .  preg_replace('/\s+/', '', $st_info['NOM_UT'])  . " *" .  preg_replace('/\s+/', '', $st_info['PRENOM_UT'])  . " par *" . preg_replace('/\s+/', '', $_SESSION['nom']) . ' *' . preg_replace('/\s+/', '', $_SESSION['prenoms']) . ' *' . $_SESSION['libelle'] . "\n\n";
                fwrite($login_log, $log);
                fclose($login_log);
                /*                 * *************************************************************** */
    echo "<script>
                    alert('UTILISATEUR SUSPENDU');
                window.location.href='utilisateurs.php';
                </script>"; 
}  
 }
?>

