<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page Montures
  $TitrePageF="montures";
  $TitrePageE="Lens mount";
  $LeItemPageF="la monture";
  $LeItemPageE="the monture ???";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $RequeteSelect="SELECT PK_Monture AS PK_GEN, Nom_Monture AS NOM_GEN, Desc_Monture AS DESC_GEN FROM t_monture ORDER BY Nom_Monture";
  $Champ1="Pk_Monture";
  $Champ2="Nom_Monture";
  $Champ3="Desc_Monture";
  $NomTable="t_monture";
  $NomRepItem="montures/";
  $RequeteAffiche="SELECT NOM_MONTURE, DESC_MONTURE FROM t_monture WHERE PK_MONTURE=";
  $Icone_View="objectif.png";
?>