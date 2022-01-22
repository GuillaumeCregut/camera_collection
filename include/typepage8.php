<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page type d'appareil
  $TitrePageF="types d'appareils";
  $TitrePageE="kind of cameras";
  $LeItemPageF="Le type d'appareil";
  $LeItemPageE="the kind of camera";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $RequeteSelect="SELECT PK_Appareil AS PK_GEN, Nom_TApp AS NOM_GEN, Desc_App AS DESC_GEN FROM t_appareil ORDER BY Nom_TApp";
  $Champ1="Pk_Appareil";
  $Champ2="Nom_TApp";
  $Champ3="Desc_App";
  $NomTable="t_appareil";
  $NomRepItem="typeapps/";
  $RequeteAffiche="SELECT NOM_TAPP, DESC_APP FROM t_appareil WHERE PK_APPAREIL=";
  $Icone_View="type_app.png";
?>