<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page  Format
  $TitrePageF="Formats";
  $TitrePageE="Formats";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $Champ1="Pk_Format";
  $Champ2="Nom_Format";
  $NomTable="t_format";
  $RequeteSelect="SELECT Nom_Format AS NOM_GEN,PK_Format AS PK_GEN FROM t_format ORDER BY Nom_Format";
  $RequeteAffiche="SELECT NOM_FORMAT FROM t_format WHERE PK_FORMAT=";
  $Icone_View="format.png";
?>