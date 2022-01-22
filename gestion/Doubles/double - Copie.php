<?php
  /*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : double.php
  Fonction : Gere les "Double".
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Gestion de collection-Collection manager</title>
<link rel="stylesheet" type="text/css" href="../include/single.css">
<script type="text/javascript">
<!-- JavaScript
 function Do_That(The_Action)
 {
   document.gest_tables.faire.value=The_Action;
   document.gest_tables.submit();
 }
 function Fenetre(Lien)
 {
   page=Lien;
   window.open(page,'Informations','width=400,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,copyhistory=no,resizable=no');
 }
 function SetOld(OldFile)
 {
   document.gest_tables.AncienFichier.value=OldFile;
 }
// - JavaScript - -->
</script>
</head>
<body>
<?php
  //include files
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  $Type_Page=$_GET["NumPage"];
  $Langue=$_GET["Language"];
  include "../include/typepage$Type_Page.php";
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
               $LeItemPage=$LeItemPageF;
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               $LeItemPage=$LeItemPageE; //concerne le textarea
               break;
  }
  echo "<h1>$Mgmt $Titre1Page</h1>\n";
  //Selection du répertoire.
  $Repertoire=$EnteteRep.$NomRepItem;
  echo "<form name=\"gest_tables\" action=\"dodouble.php\" method=\"POST\">\n";
  echo "<input type=\"hidden\" Name=\"Type_Page\" value=\"$Type_Page\">\n";
  echo "<input type=\"hidden\" Name=\"Lan\" value=\"$Langue\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier\" value=\"\">\n";
?>
<input type="hidden" name="faire" value="0">
<?php
    echo "<p>$StyleExist</p>\n";
    echo "<div id=\"existant\">\n";
    //ici on liste les items présents
    $SQLS=$RequeteSelect;
    $OK=FALSE;
    $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
    foreach($connecter->query($SQLS) as $row)
      {
        $CheminComplet=$Repertoire.$row["DESC_GEN"].".txt";
        echo "<p><input type=\"radio\" name=\"TheItem\" value=\"".$row["PK_GEN"]."\" onclick=\"SetOld('$CheminComplet')\"><a href=\"javascript:Fenetre('$CheminComplet')\">".$row["NOM_GEN"]."</a></p>\n";   //Modifier ici pour le fichier
      }
    echo "</div>\n";
    echo "<div id=\"new_item\">\n";
    echo "<p>$LeNom : <input type=\"text\" name=\"Nom_Item\"></p>\n";
    echo "<p>Informations $Mot1 $LeItemPage : <br>\n";
    echo "<textarea name=\"LasDesc\" rows=\"5\" cols=\"60\"></textarea></p>";
  echo "</div>\n";
  echo"<p id=\"boutons\"><input type=\"button\" value=\"$BoutonSupp\" OnClick=\"Do_That(3)\">\n";
  echo"<input type=\"button\" value=\"$BoutonMod\" OnClick=\"Do_That(2)\">\n";
  echo"<input type=\"button\" value=\"$BoutonAdd\" OnClick=\"Do_That(1)\"></p>\n";
?>
</form>
<?php
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>\n";
  include "../include/footer.php";
?>
