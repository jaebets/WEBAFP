<?php
session_start();

include('phpqrcode/qrlib.php');
include 'connections/FirebirdConnection.php';
include 'connections/AfriquepesageConnection.php';
$sql = $dbh->query('select max(e."poidsMesure_EP"-e."poidsMax_EP") as "high" from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"= ' . $_SESSION['num_pesee']);
$sql->execute();
$result = $sql->fetch();
echo $result['high'];


$info = $dbh->query('select e."nom_EP",e."poidsMesure_EP",e."poidsMax_EP",(e."poidsMesure_EP"-e."poidsMax_EP") surch from "Mobile_Pese" a,"Essieu_Pese" e,"Group_Pese" g,"Vehicule_Pese" v,"Pesee" p where e."id_GP"=g."id_GP" and g."id_MP"=a."id_MP" and a."id_VP"=v."id_VP" and p."Id_VP"=v."id_VP" and p."Numero_Pesee"=' .$_SESSION['num_pesee'].' order by surch desc rows 1 to 1');
$info->execute();
$essieux = $info->fetch();
echo $essieux['surch'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Document sans nom</title>
        <style>
            section {
                width: 100%;
                height: 200px;
            }
            div#one {
                width: 15%;
                height: 200px;
                margin-left: 55%;
                position: absolute;
               
            }
            div#two {
                height: 200px;
                 float: left;
            }

        </style>
    </head>

    <body >
        
        <section style="width:950px; margin:0 auto;">
            <div id="two">
                <table width="85%" border="0">
                    <tr>
                        <td colspan="5">
                            <div align="center">
                                R&Eacute;PUBLIQUE DE C&Ocirc;TE D'IVOIRE - MINIST&Egrave;RE DES INFRASTRUTURES
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div align="center">
                                STATION DE PESAGE FIXE D'ALLOKOI
                            </div>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="5">
                            <div align="center">
                                FONDS D'ENTRETIEN ROUTIER
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="left">
                                Nº FICHE DE VERBALISATION :
                            </div>
                        </td>
                        <td><div align="left">2060402SM0067878 </div></td>
                        <td><div align="left">DATE / HEURE : </div></td>
                        <td>
                            <div align="left">02/04/2016 </div></td>
                        <td>
                            <div align="center">
                                02:04:26
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="left">
                                Nº PES&Eacute;E :
                            </div>
                        </td>
                        <td><div align="left">878965 </div></td>
                        <td><div align="left">PROV/DEST
                            </div></td>
                        <td><div align="left">ABIDJAN-MALI
                            </div></td>
                        <td>
                            <div align="center">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="left">
                                IMMATRICULATION :
                            </div>
                        </td>
                        <td>
                            <div align="left">
                                N6886MD/N6887MD
                            </div>
                        </td>
                        <td>
                            <div align="left">
                                NATIONALIT&Eacute; :
                            </div>
                        </td>
                        <td>
                            <div align="left">
                                IVOIRIENNE

                            </div></td>
                        <td>
                            <div align="center">
                                IMAGE VEHICULE
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="left">
                                SOCI&Eacute;T&Eacute;/PROP
                                :</div>
                        </td>
                        <td>
                            <div align="left">ETS ALPHA/R3408
                            </div>
                        </td>
                        <td>
                            <div align="left">TYPE DE TRANSPORT
                            </div>
                        </td>
                        <td>
                            <div align="left">INTERNATIONAL
                            </div>
                        </td>
                        <td>
                            <div align="center">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="left">PRODUIT :
                            </div>
                        </td>
                        <td>
                            <div align="left">HYDROCARBURE</div>
                        </td>
                        <td>
                            <div align="left">
                            </div>
                        </td>
                        <td>
                            <div align="left">
                            </div>
                        </td>
                        <td>
                            <div align="center">
                            </div>
                        </td>
                    </tr>
                </table>
                <table width="80%" border="1">
                    <tr>
                        <th scope="col">VEHICULE | GROUPE ESSIEUX | ESSIEUX</th>
                        <th scope="col">POIDS</th>
                        <th scope="col">POIDS MAX</th>
                        <th scope="col">SURCHARGE</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
                <table width="80%" border="1">
                    <tr>
                        <th scope="col">TYPE D'INFRACTION(S)</th>
                        <th scope="col">AMANDE(S)</th>
                    </tr>
                    <tr>
                        <td>FRAIS DE PESAGE</td>
                        <td><div align="right">2000</div></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><div align="right">5500</div></td>
                    </tr>
                </table>
                <table width="80%" border="0">
                    <tr>
                        <td><div align="right">TOTAL &amp;Aacute; PAYER :</div></td>
                        <td><div align="right">7500</div></td>
                    </tr>
                </table>
            </div>


            <div id="one">
                <?php
// outputs image directly into browser, as PNG stream
                echo '<img src="duplicata.php" style="width:100px;"/>';
                ?>
            </div>
        </section>
    </body>
</html>

