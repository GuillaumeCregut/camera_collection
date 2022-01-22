<?php
  /*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
  Validé fonctionnelle : non
  Validé W3C : Oui
  Nom : marque.php
  Fonction : Gere les marques.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
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
  include "../include/typepage9.php";
  $Langue=$_GET["Language"];
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
             //  $LeItemPage=$LeItemPageF;
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               $LeItemPage=$LeItemPageE; //concerne le textarea
               break;
  }
  $Repertoire=$EnteteRep.$NomRepItem;
  echo "<h1>$Mgmt $TitreMarques</h1>\n";
  echo "<form name=\"gest_tables\" action=\"domarque.php\" method=\"POST\">\n";
  echo "<input type=\"hidden\" Name=\"Lan\" value=\"$Langue\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier\" value=\"\">\n";
?>
<input type="hidden" name="faire" value="0">
<?php
  echo "<p>$StyleExist</p>\n";
  echo "<div id=\"existant\">\n";
    //ici on liste les items présents
  $SQLS="SELECT T_M.PK_MARQUE, T_M.NOM_MARQUE, T_M.HIST_MARQUE, T_P.NOM_PAYS FROM t_marque T_M INNER JOIN t_pays T_P ON T_M.FK_Pays=T_P.PK_Pays ORDER BY Nom_Marque";
  $OK=FALSE;
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
 foreach($connecter->query($SQLS) as $row)
  {
    $CheminComplet=$Repertoire.$row["HIST_MARQUE"].".txt";
    echo "<p><input type=\"radio\" name=\"TheItem\" value=\"".$row["PK_MARQUE"]."\" onclick=\"SetOld('$CheminComplet')\"><a href=\"javascript:Fenetre('$CheminComplet')\">".$row["NOM_MARQUE"]."</a>-".$row["NOM_PAYS"]."</p>\n";
  }
?>
 </div>
 <div id="new_item">
<?php
  echo "                <p>$LeNom : <input type=\"text\" name=\"Nom_Item\"></p>\n";
  echo "              <p>$LePaysMarque : <select name=\"NumPays\" size=\"1\">\n";
  $SQLS="SELECT PK_PAYS, NOM_PAYS FROM t_pays ORDER BY Nom_Pays";
  foreach($connecter->query($SQLS) as $row)
      {
	  echo "<option value=\"".$row["PK_PAYS"]."\">".$row["NOM_PAYS"]."</option>\n";
      }
       echo "         </select></p>";
       echo "         <p>Informations $Mot1 $LeMarquePage : <br>";
?>
  <textarea name="LasDesc" rows="5" cols="60"></textarea></p>
  </div>
<?php
  echo "<p id=\"boutons\"><input type=\"button\" value=\"$BoutonSupp\" OnClick=\"Do_That(3)\">\n";
  echo "<input type=\"button\" value=\"$BoutonMod\" OnClick=\"Do_That(2)\">\n";
  echo "<input type=\"button\" value=\"$BoutonAdd\" OnClick=\"Do_That(1)\"></p>\n";
?>
</form>
<?php
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>\n";
  include "../include/footer.php";
?>
