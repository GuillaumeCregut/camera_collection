<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
*/
//Squelette de la page marque
  $TitrePageE="brands";
  $TitrePageF="marques";
  $RequeteAdd="";
  $RequeteSupp="";
  $RequeteMod="";
  $RequeteSelect="SELECT PK_Marque As PK_GEN, Nom_Marque AS NOM_GEN FROM t_marque ORDER BY Nom_Marque";
  $RequeteAffiche="SELECT T_M.NOM_MARQUE,T_M.HIST_MARQUE,T_P.NOM_PAYS FROM t_marque T_M INNER JOIN t_pays T_P ON T_M.FK_Pays=T_P.PK_Pays WHERE T_M.PK_MARQUE=";
  $NomRepItem="marques/";
  $Icone_View="marque.png";
?>