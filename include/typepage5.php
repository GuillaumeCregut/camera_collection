<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page type materiel
  $TitrePageF="types de mat&eacute;riel";
  $TitrePageE="kind of hardware";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $Champ1="Pk_TMat";
  $Champ2="Nom_Mat";
  $NomTable="t_materiel";
  $RequeteSelect="SELECT Nom_Mat AS NOM_GEN,PK_TMat AS PK_GEN FROM t_materiel ORDER BY Nom_Mat";
  $RequeteAffiche="SELECT NOM_MAT FROM t_materiel WHERE PK_TMAT=";
  $Icone_View="type_mat.png";
?>