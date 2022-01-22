<?php
/*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : search_name.php
  Fonction : Recherche un élément par nom.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Recherche/Search</title>
<link rel="stylesheet" type="text/css" href="../include/search.css">
</head>
<body>
<form name="Cherche_nom" action="result_search.php" method="POST">
<?php
  include "../include/config.inc.php";
  $Langue=$_GET["Language"];
  $TypePage=$_GET["NumPage"];
  if (!(isset($Langue)))
  {
     $Langue="F";
  }
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
  echo "<h1>$SearchFor</h1>\n";
  echo "<input type=\"hidden\" Name=\"Lan\" value=\"$Langue\">\n";
  echo "<input type=\"hidden\" Name=\"NumPage\" value=\"$TypePage\">\n";
//
  switch ($TypePage)
  {
    case 1 :  $TitreRech=$Pays;
              break;
    case 2 :  $TitreRech=$TypeSupp;
              break;
    case 3 :  $TitreRech=$Perio;
              break;
    case 4 :  $TitreRech=$Forma;
              break;
    case 5 :  $TitreRech=$TypeMat;
              break;
    case 6 :  $TitreRech=$Obtu;
              break;
    case 7 :  $TitreRech=$Montu;
              break;
    case 8 :  $TitreRech=$TypeApp;
              break;
    case 9 :  $TitreRech=$Mark;
              break;
    case 10 : $TitreRech=$Appar;
              break;
  }
//
  echo "<h2>$TitreRech</h2>\n";
  echo "<p>$LeNom: <input type=\"text\" name=\"nom_rech\"></p>\n";
  echo "<p><input type=\"submit\" value=\"$Search\"></p>\n";
  echo"</form>";
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>";
  include "../include/footer.php";
?>