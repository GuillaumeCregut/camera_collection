<?php
  /*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
  Validé fonctionnelle : Non
  Validé W3C : Non
  Nom : m_appareil-utile.php
  Fonction : Ancienne page, plus d'actualité. Reste pour savoir si il y a un pb.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Gestion de collection-Collection manager</title>
<link rel="stylesheet" type="text/css" href="../include/index.css">
<script type="text/javascript">
<!-- JavaScript
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
  $Langue=$_POST["Language"];
  $LaCle=$_POST["Cle"];
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

//
  echo "<H1>$Mgmt $TitreAppareils</H1>\n";
  echo "<form name=\"gest_tables\" action=\"doappareil.php\" method=\"POST\">\n"; /**/
  echo "<input type=\"hidden\" Name=\"OldApp\" value=\"$LaCle\">\n";
  echo "<input type=\"hidden\" Name=\"faire\" value=\"2\">\n";
  echo "<input type=\"hidden\" Name=\"Lan\" value=\"$Langue\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier1\" value=\"\">\n";
  echo "<input type=\"hidden\" Name=\"AncienFichier2\" value=\"\">\n";
  echo "<TABLE BORDER=\"0\">\n<TR>\n<TD valign=\"top\">\n";
  //Selectionne l'appareil photo
  $SQLS="SELECT REF_INV,NOM_ITEM,FK_MARQUE,FK_FILM,FK_APP,FK_MAT,FK_OBTU,FK_MONTURE,FK_FORMAT,FK_PERIODE,ANNEE_PROD,PHOTOS,PRIX_ACHAT,ETAT,HIST_ITEM,NOTES_PERSO FROM T_ITEM WHERE REF_INV='$LaCle'";    //a modifier
//
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   //Initialisation des toggles
   $IsType=False;
   $IsMarque=False;
   $IsApp=False;
   $IsFormat=False;
   $IsSurface=False;
   $IsPeriode=False;
   $IsObtu=False;
   $IsMont=False;
   $IsEtat=False;
   while ($row=get_Objet($query,$BaseType))
  {
       //Charger les variables
       $LeNomApp=$row->NOM_ITEM;
       $PKMARQUE=$row->FK_MARQUE;
       $PKFILM=$row->FK_FILM;
       $PKAPP=$row->FK_APP;
       $PKMAT =$row->FK_MAT;
       $PKOBTU=$row->FK_OBTU;
       $PKMONTURE=$row->FK_MONTURE;
       $PKFORMAT=$row->FK_FORMAT;
       $PKPERIODE=$row->FK_PERIODE;
       $ANNEEPROD=$row->ANNEE_PROD;
       $LESPHOTOS=$row->PHOTOS;
       $PRIXACHAT=$row->PRIX_ACHAT;
       $LETAT=$row->ETAT;
       $HISTITEM=$row->HIST_ITEM;
       $NOTESPERSO=$row->NOTES_PERSO;
  }
  if ($PrivateUse)
  {
    echo "<p>$RefInv : <input type=\"text\" name=\"CodeInv\" value=\"$LaCle\"></p>\n";
  }
  //SQL  Materiel
  $SQLS="SELECT PK_TMAT, NOM_MAT FROM T_Materiel ORDER BY NOM_MAT";
  $query=requete_base($SQLS,$connecter,$BaseType);
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
     $Tip="";
     if (($row->PK_TMAT)==$PKMAT)
     {
       $Tip="selected";
     }
     echo "<option  $Tip value=\"$row->PK_TMAT\">$row->NOM_MAT</option>\n";

  }
  echo"</select></p>\n";
  echo "<p>$NameDev : <input type=\"text\" name=\"NomMat\"value=\"$LeNomApp\"></p>\n";
  //SQL Marque
  $SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM T_Marque ORDER BY NOM_MARQUE";
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
    $Tip="";
     if (($row->PK_MARQUE)==$PKMARQUE)
     {
       $Tip="selected";
     }
    echo "<option $Tip value=\"$row->PK_MARQUE\">$row->NOM_MARQUE</option>\n";
  }
  echo "</select></p>\n";
  //Categorie
  $SQLS="SELECT PK_APPAREIL, NOM_TAPP FROM T_APPAREIL ORDER BY NOM_TAPP";
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
     $Tip="";
     if (($row->PK_APPAREIL)==$PKAPP)
     {
       $Tip="selected";
     }
     echo "<option $Tip value=\"$row->PK_APPAREIL\">$row->NOM_TAPP</option>\n";
  }
  echo "</select></p>\n";
  //Format
  $SQLS="SELECT PK_FORMAT, NOM_FORMAT FROM T_FORMAT ORDER BY NOM_FORMAT";
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
     $Tip="";
     if (($row->PK_FORMAT)==$PKFORMAT)
     {
       $Tip="selected";
     }
     echo "<option $Tip value=\"$row->PK_FORMAT\">$row->NOM_FORMAT</option>\n";
  }
  echo "</select></p>\n";
  //Film
   $SQLS="SELECT PK_FILM, NOM_FILM FROM T_FILM ORDER BY NOM_FILM";
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
     $Tip="";
     if (($row->PK_FILM)==$PKFILM)
     {
       $Tip="selected";
     }
     echo "<option $Tip value=\"$row->PK_FILM\">$row->NOM_FILM</option>\n";
  }
  echo "</select></p>\n";
  $LANNEPROD=substr($ANNEEPROD, 0, 4);
  echo "<p>$YearConst : <input type=\"text\" name=\"AnneeConst\" value=\"$LANNEPROD\"></p>\n";    // a changer
  //Periode
  $SQLS="SELECT PK_PERIODE, NOM_PERIODE FROM T_PERIODE ORDER BY NOM_PERIODE";
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
    $Tip="";
     if (($row->PK_PERIODE)==$PKPERIODE)
     {
       $Tip="selected";
     }
     echo "<option $Tip value=\"$row->PK_PERIODE\">$row->NOM_PERIODE</option>\n";
  }
  echo "</select></p>\n";
  //Obturateurs
  $SQLS="SELECT PK_OBTU, NOM_OBTU FROM T_OBTURATEUR ORDER BY NOM_OBTU";
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
     $Tip="";
     if (($row->PK_OBTU)==$PKOBTU)
     {
       $Tip="selected";
     }
     echo "<option $Tip value=\"$row->PK_OBTU\">$row->NOM_OBTU</option>\n";
  }
  echo "</select></p>\n";
  //Monture
  $SQLS="SELECT PK_MONTURE, NOM_MONTURE FROM T_MONTURE ORDER BY NOM_MONTURE";
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
     $Tip="";
     if (($row->PK_MONTURE)==$PKMONTURE)
     {
       $Tip="selected";
     }
     echo "<option $Tip value=\"$row->PK_MONTURE\">$row->NOM_MONTURE</option>\n";
  }
  echo "</select></p>\n";
  echo "<p>$PhotoCam : <input type=\"text\" name=\"PhotoCam\" value=\"$LESPHOTOS\"></p>\n";
  if ($PrivateUse)
  {
    echo "<p>$BuyPrice : <input type=\"text\" name=\"PrixAchat\" value=\"$PRIXACHAT\"> Euros</p>\n";
    echo "<p>$StateCam : <br>\n";
    //
    $TabEtat=array(1=>$Mint,2=>$Good,3=>$CLA,4=>$Restore,5=>$Wretch);
    for ($i=1;$i<6;$i++)
    {
      if ($i==$LETAT)
      {
        echo "<ul><input type=\"radio\" name=\"etatapp\" value=\"$i\" checked>$TabEtat[$i]</ul>\n";
      }
      else
      {
        echo "<ul><input type=\"radio\" name=\"etatapp\" value=\"$i\">$TabEtat[$i]</ul>\n";
      }
    }
  }
  echo "$InfoCam : <br>\n";
  $fd = @fopen ($EnteteRep.$NomRepItem.$HISTITEM.".txt", "r");
  $buffer="";
  if ($fd)
  {
    while (!feof($fd))
    {
       $buffer = $buffer.fgets($fd, 4096)."<br>";
    }
    fclose ($fd);
  }
  $buffer=strip_tags($buffer);
  $buffer=str_replace("<br>","",$buffer);
  echo "<textarea name=\"InfoApp\" rows=\"5\" cols=\"60\">$buffer</textarea><br>\n"; //a modifier
  if ($PrivateUse)
  {
    echo "$PersNote :<br>";
    $fd = @fopen ($EnteteRep.$NomRepItem.$NOTESPERSO.".txt", "r");
    $buffer="";
    if ($fd)
    {
      while (!feof($fd))
      {
         $buffer = $buffer.fgets($fd, 4096)."<br>";
      }
      fclose ($fd);
    }
    $buffer=strip_tags($buffer);
    $buffer=str_replace("<br>","",$buffer);
    echo "<textarea name=\"NotePers\" rows=\"5\" cols=\"60\">$buffer</textarea>\n";  //a modifier
  }
  echo "</p>\n";
  echo "</TD></TR><TABLE>\n";
  echo "<p>&nbsp;</p>\n";
  echo "<p align\"center\"><input type=\"submit\" value=\"$BoutonMod\">\n";
  echo "</form>\n";
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