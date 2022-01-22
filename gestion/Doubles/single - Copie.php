<?php
  /*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
  Validé fonctionnelle : non
  Validé W3C : Oui
  Nom : single.php
  Fonction : Gere ce qui est single.
*/
  //include files
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  if(isset($_GET["NumPage"]))
  {
     $Type_Page=$_GET["NumPage"];
  }
  else
  {
	 $Type_Page=0;  
  }
  if(isset($_GET["Language"]))
  {
	  $Langue=$_GET["Language"];
  }
  else
  {	  
	$Langue="F";
  }
  if ($Type_Page==0)
  {
	  //Gestion page d'erreur
  }
  else
  {
  include "../include/typepage$Type_Page.php";
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               break;
  }
  echo "<h1>$Mgmt $Titre1Page</h1>\n";
  echo "<form name=\"gest_tables\" action=\"dosingle.php\" method=\"POST\">\n";
  echo "<input type=\"hidden\" name=\"Type_Page\" value=\"$Type_Page\">\n";
  echo "<input type=\"hidden\" name=\"Lan\" value=\"$Langue\">\n";
?>
<input type="hidden" name="faire" value="0">
<?php
	echo "<p>$StyleExist</p>\n";
?>
<div id="existant">
<?php
    //ici on liste les items présents
    $SQLS=$RequeteSelect;
$OK=FALSE;
    $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
    foreach($connecter->query($SQLS) as $row)
    {
	echo "<p><input type=\"radio\" name=\"TheItem\" value=\"".$row["PK_GEN"]."\">".$row["NOM_GEN"]."</p>\n";
    }
  echo "</div>\n";
  echo "<div id=\"new_item\">\n";
  echo "<p>$LeNom : <input type=\"text\" name=\"Nom_Item\"></p>\n";
  echo "</div>\n";
  echo"<p id=\"boutons\"><input type=\"button\" value=\"$BoutonSupp\" OnClick=\"Do_That(3)\">\n";
  echo"<input type=\"button\" value=\"$BoutonMod\" OnClick=\"Do_That(2)\">\n";
  echo"<input type=\"button\" value=\"$BoutonAdd\" OnClick=\"Do_That(1)\"></p>\n";
?>
</form>
<?php
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>\n";
  include "../include/footer.php";
  } //fin du else
?>