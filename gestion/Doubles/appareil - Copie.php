<?php
  /*
  Version  : 1.2 R1
  Date de modification : 20 Avril 2018.
  Validé fonctionnelle : non
  Validé W3C : Oui
  Nom : appareil.php
  Fonction : gere les appareils.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Gestion de collection-Collection manager</title>
<link rel="stylesheet" type="text/css" href="../include/add_app.css">
<script type="text/javascript">
<!-- JavaScript
 function Do_That(The_Action)
 {
   if (The_Action!=2)
   {
     document.gest_tables.faire.value=The_Action;
     document.gest_tables.submit();
   }
   else
   {
     var toto;
     toto=document.gest_tables.OldApp.value;
     document.change_app.ref_app.value=toto;
     document.change_app.submit();
   }
 }
 function Fenetre(Lien)
 {
   page=Lien;
   window.open(page,'Informations','width=400,height=200,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,copyhistory=no,resizable=no');
 }
 function SetOld(OldFile1,OldFile2)
 {
   document.gest_tables.AncienFichier1.value=OldFile1;
   document.gest_tables.AncienFichier2.value=OldFile2;
 }
// - JavaScript - -->
</script>
</head>
<body>
<?php
  $Lapagedemande="../consult/appareil.php";
  //include files
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage10.php";
  $Langue=$_GET["Language"];
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
               //$LeItemPage=$LeItemPageF;
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               //$LeItemPage=$LeItemPageE; //concerne le textarea
               break;
  }
  $Repertoire=$EnteteRep.$NomRepItem;
//Connexion à la base de données
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
//
  echo "<h1>$Mgmt $TitreAppareils</h1>\n";
  echo '<form name="change_app" action="mod_app.php" method="POST">';
  echo "<input type=\"hidden\" Name=\"Lan\" value=\"$Langue\">\n";
  echo '<input type="hidden" name="ref_app" value="-1">';
  echo "</form>\n";
  echo "<form name=\"gest_tables\" action=\"doappareil.php\" method=\"POST\">\n";
  echo "<input type=\"hidden\" Name=\"Lan\" value=\"$Langue\">\n";
  echo "<input type=\"hidden\" Name=\"faire\" value=\"0\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier1\" value=\"\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier2\" value=\"\">\n";
  //Liste
  echo "<p>$StyleExist</p>\n";
  echo "<div id=\"existant\">\n";
  echo "<SELECT Name=\"OldApp\" size=\"10\">\n";
  $SQLS="SELECT REF_INV, NOM_ITEM,HIST_ITEM,NOTES_PERSO FROM t_item ORDER BY NOM_ITEM";
//
  foreach($connecter->query($SQLS) as $row)
      {
        $CheminComplet1=$Repertoire.$row["HIST_ITEM"].".txt";
        $CheminComplet2=$Repertoire.$row["NOTES_PERSO"].".txt";
        echo "<option value=\"".$row["REF_INV"]."\" onclick=\"SetOld('$CheminComplet1','$CheminComplet2')\">".$row["NOM_ITEM"]."</option>\n";
      }
//
  echo "</select>\n";
  echo "</div>";
  echo "<div id=\"new_item\">\n";
  if ($PrivateUse)
  {
    echo "<p>$RefInv : <input type=\"text\" name=\"CodeInv\">&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../gen_num.php\" target=\"_blank\">$GenID</a></p>\n";
  }
  //SQL  Materiel
  $SQLS="SELECT PK_TMAT, NOM_MAT FROM t_materiel ORDER BY NOM_MAT";
  
  echo "<p>$KindMat : <select name=\"SorteMat\" size=\"1\">\n";
  foreach($connecter->query($SQLS) as $row)
  {
     echo "<option value=\"".$row["PK_TMAT"]."\">".$row["NOM_MAT"]."</option>\n";
  }
  echo"</select></p>\n";
  echo "<p>$NameDev : <input type=\"text\" name=\"NomMat\">&nbsp;&nbsp;<a href=\"$Lapagedemande?Lan=$Langue\" target=\"_blank\">$ExisteIl</a></p>\n";
  //SQL Marque
  $SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM t_marque ORDER BY NOM_MARQUE";
  echo "<p>$BrandDev : <select name=\"NumMarque\" size=\"1\">\n";
 foreach($connecter->query($SQLS) as $row)
  {
    echo "<option value=\"".$row["PK_MARQUE"]."\">".$row["NOM_MARQUE"]."</option>\n";
  }
  echo "</select></p>\n";
  //Categorie
  $SQLS="SELECT PK_APPAREIL, NOM_TAPP FROM t_appareil ORDER BY NOM_TAPP";

  echo "<p>$KindCam : <select name=\"NumCate\" size=\"1\">\n";
 foreach($connecter->query($SQLS) as $row)
  {
     echo "<option value=\"".$row["PK_APPAREIL"]."\">".$row["NOM_TAPP"]."</option>\n";
  }
  echo "</select></p>\n";
  //Format
  $SQLS="SELECT PK_FORMAT, NOM_FORMAT FROM t_format ORDER BY NOM_FORMAT";
  echo "<p>$FormatCam : <select name=\"NumFormat\" size=\"1\">\n";
  foreach($connecter->query($SQLS) as $row)
  {
  echo "<option value=\"".$row["PK_FORMAT"]."\">".$row["NOM_FORMAT"]."</option>\n";
  }
  echo "</select></p>\n";
  //Film
   $SQLS="SELECT PK_FILM, NOM_FILM FROM t_film ORDER BY NOM_FILM";
  
  echo "<p>$KindFilm : <select name=\"NumSupp\" size=\"1\">\n";
   foreach($connecter->query($SQLS) as $row)
  {
     echo "<option value=\"".$row["PK_FILM"]."\">".$row["NOM_FILM"]."</option>\n";
  }
  echo "</select></p>\n";
  echo "<p>$YearConst : <input type=\"text\" name=\"AnneeConst\"></p>\n";
  //Periode
  $SQLS="SELECT PK_PERIODE, NOM_PERIODE FROM t_periode ORDER BY NOM_PERIODE";

  echo "<p>$PeriodeC : <select name=\"NumPeriode\" size=\"1\">\n";
 foreach($connecter->query($SQLS) as $row)
  {
     echo "<option value=\"".$row["PK_PERIODE"]."\">".$row["OM_PERIODE"]."</option>\n";
  }
  echo "</select></p>\n";
  //Obturateurs
  $SQLS="SELECT PK_OBTU, NOM_OBTU FROM t_obturateur ORDER BY NOM_OBTU";
  
  echo "<p>$ShutterCam : <select name=\"NumShutter\" size=\"1\">\n";
  foreach($connecter->query($SQLS) as $row)
  {
     echo "<option value=\"".$row["PK_OBTU"]."\">".$row["NOM_OBTU"]."</option>\n";
  }
  echo "</select></p>\n";
  //Monture
  $SQLS="SELECT PK_MONTURE, NOM_MONTURE FROM t_monture ORDER BY NOM_MONTURE";
  
  echo "<p>$LensMount : <select name=\"NumLens\" size=\"1\">\n";
 foreach($connecter->query($SQLS) as $row)
  {
     echo "<option value=\"".$row["PK_MONTURE"]."\">".$row["NOM_MONTURE"]."</option>\n";
  }
  echo "</select></p>\n";
  echo "<p>$PhotoCam : <input type=\"text\" name=\"PhotoCam\"></p>\n";
  if ($PrivateUse)
  {
    echo "<p>$BuyPrice : <input type=\"text\" name=\"PrixAchat\"> Euros</p>\n";
    echo "<p>$StateCam : </p>\n";
    echo "<ul>\n";
    echo "<li><input type=\"radio\" name=\"etatapp\" value=\"1\">$Mint</li>\n";
    echo "<li><input type=\"radio\" name=\"etatapp\" value=\"2\">$Good</li>\n";
    echo "<li><input type=\"radio\" name=\"etatapp\" value=\"3\">$CLA</li>\n";
    echo "<li><input type=\"radio\" name=\"etatapp\" value=\"4\">$Restore</li>\n";
    echo "<li><input type=\"radio\" name=\"etatapp\" value=\"5\">$Wretch</li>\n";
    echo "</ul>\n";
  }
  echo "<p>$InfoCam : </p>\n";
  echo "<p><textarea name=\"InfoApp\" rows=\"5\" cols=\"60\"></textarea></p>\n";
  if ($PrivateUse)
  {
    echo "<p>$PersNote :</p>";
    echo "<p><textarea name=\"NotePers\" rows=\"5\" cols=\"60\"></textarea></p>\n";
  }
  echo "</div>\n";
  echo "<p id=\"boutons\"><input type=\"button\" value=\"$BoutonSupp\" OnClick=\"Do_That(3)\">\n";
  echo "<input type=\"button\" value=\"$BoutonMod\" OnClick=\"Do_That(2)\">\n";
  echo "<input type=\"button\" value=\"$BoutonAdd\" OnClick=\"Do_That(1)\"></p>\n";
  echo "</form>\n";
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>\n";
  include "../include/footer.php";
?>