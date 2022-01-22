<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page Obturateur
  $TitrePageF="obturateurs";
  $TitrePageE="shutters";
  $LeItemPageF="l'obturateur";
  $LeItemPageE="the shutter";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $RequeteSelect="SELECT PK_Obtu AS PK_GEN, Nom_Obtu AS NOM_GEN, Desc_Obtu AS DESC_GEN FROM t_obturateur ORDER BY Nom_Obtu";
  $Champ1="Pk_Obtu";
  $Champ2="Nom_Obtu";
  $Champ3="Desc_Obtu";
  $NomTable="t_obturateur";
  $NomRepItem="obturateurs/";
  $RequeteAffiche="SELECT NOM_OBTU, DESC_OBTU FROM t_obturateur WHERE PK_OBTU=";
  $Icone_View="obtu.png";
?>