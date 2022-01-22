<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page Pays
  $TitrePageE="countries";
  $TitrePageF="pays";
  $RequeteAdd="INSERT INTO t_pays(Nom_Pays) VALUES (\"";
  $RequeteSupp="DELETE FROM t_pays WHERE PK_Pays=";
  $RequeteMod="UPDATE t_pays SET ";
  $Champ1="Pk_Pays";
  $Champ2="Nom_Pays";
  $NomTable="t_pays";
  $RequeteSelect="SELECT Nom_Pays AS NOM_GEN,PK_Pays AS PK_GEN FROM t_pays ORDER BY Nom_Pays";
  $RequeteAffiche="SELECT NOM_PAYS FROM t_pays_PAYS WHERE PK_Pays=";
  $Icone_View="drapeau.png";
?>