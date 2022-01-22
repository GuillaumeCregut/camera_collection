<?php
/*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : presentation.php
  Fonction : affiche les catégories et les appareils.
*/
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  $Lang=$_GET["Lan"];
  switch ($Lang)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
    default :  include "../include/LangueFR.inc.php";
               $Lang="F";
  }
  if (!isset($_GET["Tri"]))
  {
    $Choix=1;
  }
  else
  {
	  $Choix=$_GET["Tri"];
  }
  switch($Choix)
  {
    case 1 : $SQLS="SELECT PK_APPAREIL AS CLE, NOM_TAPP AS NOM FROM t_appareil ORDER BY NOM_TAPP";
             break;
    case 2 : $SQLS="SELECT PK_PERIODE AS CLE, NOM_PERIODE AS NOM FROM t_periode ORDER BY NOM_PERIODE";
             break;
    case 3 : $SQLS="SELECT PK_MARQUE AS CLE, NOM_MARQUE AS NOM FROM t_marque ORDER BY NOM_MARQUE";
             break;
  }
//Connexion à la base de données
  $OK=FALSE;
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link rel="stylesheet" type="text/css" media="screen" href="../include/presentation.css">
  <title>Affichage de la collection</title>
  </head>
  <body>
<?php
  echo '<h1>'.$MesCams.'</h1>';
  echo '<div id="cadre">';
  echo '<div id="innercadre">';
//Ici on traite
  $query=requete_base($SQLS,$connecter,$BaseType);
//Ici tableau avec les dossiers
  //echo '<table cellpadding="0" cellspacing="0" width="100%" height="100%">';
//A partir d'ici on boucle
  $MaxCol=4;
  $Compte=0;
  foreach($connecter->query($SQLS) as $row)
  {
    $Lien="affiche.php?Lan=$Lang&amp;Cle=".$row["CLE"]."&amp;TypePage=$Choix&amp;LeNom=".$row["NOM"];
    if ($Compte==0)
    {
      echo "<div class=\"enligne\">\n";
    }
    $Compte++;
    echo '<div class="case"><a href="'.$Lien.'"><img src="../include/images/dossier.gif" alt="Dossier"></a><br>';
    echo "\n".'<a href="'.$Lien.'\">'.$row["NOM"].'</a></div>'."\n";
    if ($Compte==$MaxCol)
    {
      echo "</div>\n";
      $Compte=0;
    }
  }

  if (($Compte!=0) AND ($Compte!=$MaxCol))
  {
     echo '</div>';
  }
//Fin de la boucle
//Fin traitement
  echo '</div>';
  echo '</div>';
  echo "\n<p>$DisplayOrdered :</p>\n";
  echo '<form name="form1" method="GET" action="">';
  echo "<p><input type=\"radio\" name=\"Tri\" value=\"1\" checked>$KindCam</p>";
  echo "<p><input type=\"radio\" name=\"Tri\" value=\"2\">$PeriodeC</p>";
  echo "<p><input type=\"radio\" name=\"Tri\" value=\"3\">$BrandDev</p>";
  echo "<input type=\"hidden\" name=\"Lan\" value=\"$Lang\">\n";
  echo " <p><input type=\"submit\" value=\"$Display\"></p>";
  echo '</form>';
  echo "<p><a href=\"../index.php?Lan=$Lang\">$Retour</a></p>";
  include "../include/footer.php";
?>
