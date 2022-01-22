<?php
  /*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : modapp.php
  Fonction : Affiche les informations d'un appareil afin de les modifier.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Gestion de collection-Collection manager</title>
<link rel="stylesheet" type="text/css" href="../include/add_app.css">
<script type="text/javascript">
<!-- JavaScript
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
  $valeur=$_POST["ref_app"];
  $Langue=$_POST["Lan"];
//inclusion des fichiers
  $Lapagedemande="../consult/appareil.php";
  //include files
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage10.php";
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
  $Repertoire=$EnteteRep.$NomRepItem;
//Connexion à la base de données
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
  echo "<h1>$ModifApp</h1>";
  //Récupération des valeurs de l'appareil.
  $SQLS="SELECT Ref_inv,FK_Marque,FK_Film,FK_App,FK_Mat,FK_Obtu,FK_Monture,FK_Format,FK_Periode,Annee_Prod,Photos,Nom_ITem, Prix_Achat,Etat,Hist_Item,Notes_Perso FROM t_item WHERE Ref_inv='$valeur'";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  while ($row=get_Objet($query,$BaseType))
  {
        $LaMarque=$row->FK_MARQUE;
        $LeFilm=$row->FK_FILM;
        $LeApp=$row->FK_APP;
        $LeMat=$row->FK_MAT;
        $Lobtu=$row->FK_OBTU;
        $LaMonture=$row->FK_MONTURE;
        $LeFormat=$row->FK_FORMAT;
        $LaPeriode=$row->FK_PERIODE;
        $AnneProd=$row->ANNEE_PROD;
        $LesPhotos=$row->PHOTOS;
        $LeNom=$row->NOM_ITEM;
        $lePrix=$row->PRIX_ACHAT;
        $Letat=$row->ETAT;
        $Hist=$row->HIST_ITEM;
        $NotesP=$row->NOTES_PERSO;
  }
  $DebugMode=False;
  if ($DebugMode)
  {
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
   echo "<p></p>\n";
  }
//Affichage des informations.
  echo "<form name=\"gest_tables\" action=\"doappareil.php\" method=\"POST\">\n";
  echo "<input type=\"hidden\" Name=\"Lan\" value=\"$Langue\">\n";
  echo "<input type=\"hidden\" Name=\"OldApp\" value=\"$valeur\">\n";
  echo "<input type=\"hidden\" Name=\"faire\" value=\"2\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier1\" value=\"\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier2\" value=\"\">\n";
  if ($PrivateUse)
  {
    echo "<p>$RefInv : <input type=\"text\" name=\"CodeInv\" value=\"$valeur\"></p>\n";
  }
  //SQL  Materiel
  $SQLS="SELECT PK_TMAT, NOM_MAT FROM t_materiel ORDER BY NOM_MAT";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$KindMat : <select name=\"SorteMat\" size=\"1\">\n";
  while ($row=get_Objet($query,$BaseType))
  {
     $checked="";
     if ($row->PK_TMAT==$LeMat)
     {
       $checked="selected";
     }
     echo "<option value=\"$row->PK_TMAT\" $checked>$row->NOM_MAT</option>\n";
  }
  echo"</select></p>\n";
  echo "<p>$NameDev : <input type=\"text\" name=\"NomMat\" value=\"$LeNom\">&nbsp;&nbsp;<a href=\"$Lapagedemande?Lan=$Langue\" target=\"_blank\">$ExisteIl</a></p>\n";
  //SQL Marque
  $SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM t_marque ORDER BY NOM_MARQUE";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$BrandDev : <select name=\"NumMarque\" size=\"1\">\n";
  while ($row=get_Objet($query,$BaseType))
  {
    $checked="";
    if ($LaMarque==$row->PK_MARQUE)
    {
      $checked="selected";
    }
    echo "<option value=\"$row->PK_MARQUE\" $checked>$row->NOM_MARQUE</option>\n";
  }
  echo "</select></p>\n";
  //Categorie
  $SQLS="SELECT PK_APPAREIL, NOM_TAPP FROM t_appareil ORDER BY NOM_TAPP";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$KindCam : <select name=\"NumCate\" size=\"1\">\n";
  while ($row=get_Objet($query,$BaseType))
  {
     $checked="";
     if ($row->PK_APPAREIL==$LeApp)
     {
       $checked="selected";
     }
     echo "<option value=\"$row->PK_APPAREIL\" $checked>$row->NOM_TAPP</option>\n";
  }
  echo "</select></p>\n";
  //Format
  $SQLS="SELECT PK_FORMAT, NOM_FORMAT FROM t_format ORDER BY NOM_FORMAT";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$FormatCam : <select name=\"NumFormat\" size=\"1\">\n";
  while ($row=get_Objet($query,$BaseType))
  {
     $checked="";
     if ($row->PK_FORMAT==$LeFormat)
     {
       $checked="selected";
     }
     echo "<option value=\"$row->PK_FORMAT\" $checked>$row->NOM_FORMAT</option>\n";
  }
  echo "</select></p>\n";
  //Film
   $SQLS="SELECT PK_FILM, NOM_FILM FROM t_film ORDER BY NOM_FILM";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$KindFilm : <select name=\"NumSupp\" size=\"1\">\n";
   while ($row=get_Objet($query,$BaseType))
  {
     $checked="";
     if ($row->PK_FILM==$LeFilm)
     {
       $checked="selected";
     }
     echo "<option value=\"$row->PK_FILM\" $checked>$row->NOM_FILM</option>\n";
  }
  echo "</select></p>\n";
  $AnneProd=substr($AnneProd,0,4);
  echo "<p>$YearConst : <input type=\"text\" name=\"AnneeConst\" value=\"$AnneProd\"></p>\n";
  //Periode
  $SQLS="SELECT PK_PERIODE, NOM_PERIODE FROM t_periode ORDER BY NOM_PERIODE";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$PeriodeC : <select name=\"NumPeriode\" size=\"1\">\n";
  while ($row=get_Objet($query,$BaseType))
  {
     $checked="";
     if ($row->PK_PERIODE==$LaPeriode)
     {
       $checked="selected";
     }
     echo "<option value=\"$row->PK_PERIODE\" $checked>$row->NOM_PERIODE</option>\n";
  }
  echo "</select></p>\n";
  //Obturateurs
  $SQLS="SELECT PK_OBTU, NOM_OBTU FROM t_obturateur ORDER BY NOM_OBTU";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$ShutterCam : <select name=\"NumShutter\" size=\"1\">\n";
  while ($row=get_Objet($query,$BaseType))
  {
     $checked="";
     if ($row->PK_OBTU==$Lobtu)
     {
       $checked="selected";
     }
     echo "<option value=\"$row->PK_OBTU\" $checked>$row->NOM_OBTU</option>\n";
  }
  echo "</select></p>\n";
  //Monture
  $SQLS="SELECT PK_MONTURE, NOM_MONTURE FROM t_monture ORDER BY NOM_MONTURE";
  $query=$query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  echo "<p>$LensMount : <select name=\"NumLens\" size=\"1\">\n";
  while ($row=get_Objet($query,$BaseType))
  {
     $checked="";
     if ($row->PK_MONTURE==$LaMonture)
     {
       $checked="selected";
     }
     echo "<option value=\"$row->PK_MONTURE\" $checked>$row->NOM_MONTURE</option>\n";
  }
  echo "</select></p>\n";
  echo "<p>$PhotoCam : <input type=\"text\" name=\"PhotoCam\" value=\"$LesPhotos\"></p>\n";
  if ($PrivateUse)
  {
    echo "<p>$BuyPrice : <input type=\"text\" name=\"PrixAchat\" value=\"$lePrix\"> Euros</p>\n";
    echo "<p>$StateCam : </p>\n";
    $tab_etat[1]=$Mint;
    $tab_etat[2]=$Good;
    $tab_etat[3]=$CLA;
    $tab_etat[4]=$Restore;
    $tab_etat[5]=$Wretch;
    echo "<ul>\n";
    foreach($tab_etat as $cle=>$donneeTab)
    {
      $IsChecked="";
      if ($cle===$Letat)
      {
        $IsChecked="checked";
      }
      echo "<li><input type=\"radio\" name=\"etatapp\" value=\"$cle\" $IsChecked>$donneeTab</li>\n";
    }
    echo "</ul>\n";
  }
  echo "<p>$InfoCam : </p>\n";
  $NomFich=$Repertoire.$Hist.'.txt';
  $fp=file_get_contents($NomFich);
  echo "<p><textarea name=\"InfoApp\" rows=\"5\" cols=\"60\">$fp</textarea></p>\n";
  if ($PrivateUse)
  {
    echo "<p>$PersNote :</p>";
    $NomFich=$Repertoire.$NotesP.'.txt';
    $fp=file_get_contents($NomFich);
    echo "<p><textarea name=\"NotePers\" rows=\"5\" cols=\"60\">$fp</textarea></p>\n";
  }
  echo "<p><input type=\"submit\" value=\"$BoutonMod\"></p>\n";
  echo "</form>\n";
  echo "<p><a href=\"$CheminIndex\">$LIndex</a></p>\n";
  include "../include/footer.php";
?>