<?php
/*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
  Validé fonctionnelle : non
  Validé W3C : Oui
  Nom : view.php
  Fonction : affichage des détails des catégories.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Collection appareils photos /Camera collection</title>
<link rel="stylesheet" type="text/css" href="../include/view.css">
</head>
<body>
<?php
  //include files
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  $Type_Page=$_GET["NumPage"];
  $Langue=$_GET["Language"];
  include "../include/typepage$Type_Page.php";
//Choisi le fichier language
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               break;
    default:   include "../include/LangueFR.inc.php";
               $Langue="F";
  }
//Affichage de la page
  echo "<h1>$DisplayOf $Titre1Page</h1>\n";
//Recuperation de la requete du fichier typepage
  $SQLS=$RequeteSelect;
//Connexion à la base de données
  $OK=FALSE;
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
//Execution de la requete
  if (!$connecter)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "<p>SQLS =\" $SQLS \".</p>\n";
     die("$DBPb");
  }
//Affichage
  //Définition du nombre de colonne.
  $MaxColonne=5;
  $HauteurCase="20";
  $Compte=1;
  echo '<div id="centre">';
  echo "<p>\n";
  foreach($connecter->query($SQLS) as $row)
  {
    $LeNomAfficher=$row["NOM_GEN"];
  $LaCleAfficher=$row["PK_GEN"];
    if ($LeNomAfficher=="")
    {
      $VraimentAfficher="&nbsp;";
    }
    else
    {
      $VraimentAfficher="<a href=\"voir.php?CleAff=$LaCleAfficher&amp;TypePage=$Type_Page&amp;Lan=$Langue\" target=\"_blank\">$LeNomAfficher</a>";
    }
    echo "<span class=\"info\">$VraimentAfficher</span>\n";
    $Compte++;
    if ($Compte==6)
    {
      echo "</p><p>\n";
      $Compte=1;
    }
  }
  echo "</p>";
  echo "</div>\n";
//Pied de page
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>\n";
  if ($BaseType==0)
  {
    $UsedBase="Mysql";
  }
  else
  {
    $UsedBase="Interbase/FireBird";
  }
  echo "<p>$UsedDBase $UsedBase</p>\n";
  include "../include/footer.php";
?>
