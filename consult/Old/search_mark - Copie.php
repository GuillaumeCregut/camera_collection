<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : search_mark.php
  Fonction : Affiche les résultats de recherche des marques.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Identification des marques/Brand identification</title>
<link rel="stylesheet" type="text/css" href="../include/marque.css">
</head>
<body>
<?php
//Importation des infos
  $Langue=$_POST["Lan"];
  $EPays=$_POST["SortePays"];
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
  $SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM t_marque WHERE FK_PAYS=$EPays ORDER BY NOM_MARQUE ";
//
  echo "<h1>$ResultRechMark</h1>\n";
  $query=requete_base($SQLS,$connecter,$BaseType);
  while ($row=get_Objet($query,$BaseType))
  {
    $LeNomAfficher=$row->NOM_MARQUE;
    $LaCleAfficher=$row->PK_MARQUE;
    if ($LeNomAfficher=="")
    {
      $VraimentAfficher="&nbsp;";
    }
    else
    {
      $VraimentAfficher="<a href=\"voir.php?CleAff=$LaCleAfficher&amp;TypePage=9&amp;Lan=$Langue\" target=\"_blank\">$LeNomAfficher</a>";
    }
    echo "<p>- $VraimentAfficher</p>\n";
  }
//
  echo "<p>$FinResultApp</p>\n";
  echo "<p><a href=\"marque.php?Lan=$Langue\">$Retour</a></p>\n";
  include "../include/footer.php";
?>