<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page Periode
  $TitrePageF="p&eacute;riodes";
  $TitrePageE="periods";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $Champ1="Pk_Periode";
  $Champ2="Nom_Periode";
  $NomTable="t_periode";
  $RequeteSelect="SELECT Nom_Periode AS NOM_GEN,PK_Periode AS PK_GEN FROM t_periode ORDER BY Nom_Periode";
  $RequeteAffiche="SELECT NOM_PERIODE FROM t_periode WHERE PK_Periode=";
  $Icone_View="cal.png";
?>