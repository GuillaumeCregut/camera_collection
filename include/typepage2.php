<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//page Film
  $TitrePageF="type de supports";
  $TitrePageE="kind of support";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $Champ1="Pk_Film";
  $Champ2="Nom_Film";
  $NomTable="t_film";
  $RequeteSelect="SELECT Nom_Film AS NOM_GEN,PK_Film AS PK_GEN FROM t_film ORDER BY Nom_Film";
  $RequeteAffiche="SELECT NOM_FILM FROM t_film WHERE PK_Film=";
  $Icone_View="film.png";
?>