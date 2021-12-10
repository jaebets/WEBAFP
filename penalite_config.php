<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 $nbreut = "SELECT TOP 1 * FROM [dbo].[ADMIN_PARAM]";
            $nbrut = $conn->query($nbreut);
            $tablparam = $nbrut->fetch(); 

  $devisePARAM=$tablparam['devisePARAM'];
  $INFPoidsTotalsAmNAT=$tablparam['INFPoidsTotalsAmNAT'];
  $INFPoidsTotalsAmINT=$tablparam['INFPoidsTotalsAmINT'];
  $INFRECAmNAT=$tablparam['INFRECAmNAT'];
  $INFRECAmINT= $tablparam['INFRECAmINT'];
  $INFRECPlafond=$tablparam['INFRECPlafond'];
  $INFESSAmNAT=$tablparam['INFESSAmNAT'];
  $INFESSAmINT=$tablparam['INFESSAmINT'];
  $INFGABAmNAT=$tablparam['INFGABAmNAT'];
  $INFGABAmINT=$tablparam['INFGABAmINT'];
  $LOGOGAUCHE=$tablparam['LOGOGAUCHE'];
  $LOGODROITE=$tablparam['LOGODROITE'];
  $BDWIM=$tablparam['BDWIM'];
  $SITE=$tablparam['SITE'];
  $IMLOGOGAUCHE=$tablparam['IMLOGOGAUCHE'];
  $IMLOGODROITE=$tablparam['IMLOGODROITE'];
  $fraisPESAGENAT=$tablparam['fraisPESAGENAT'];
  $fraisPESAGEINT=$tablparam['fraisPESAGEINT'];
  $fraisPESAGEACTIF=$tablparam['fraisPESAGEACTIF'];
  $paysPARAM=$tablparam['paysPARAM'];
  $entreprisePARAM=$tablparam['entreprisePARAM'];
  $info_refus=$tablparam['info_refus'];
  $AmendeExtremeSurNat=$tablparam['AmendeExtremeSurNat'];
  $AmendeExtremeSurInt=$tablparam['AmendeExtremeSurInt'];
  $tolerance = $tablparam['TOLERANCE'];
  $app_tol = $tablparam['ApplicationTolerance'];
  $type_tolerance = $tablparam['type_tolerance'];
  $tonnage = $tablparam['Tonnage'];
  $ratio = $tablparam['Ratio'];
