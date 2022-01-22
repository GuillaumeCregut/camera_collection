<?php
  /*
  Version  : 1.1 R1
  Date de modification : 19 d�cembre 2008.
  Valid� fonctionnelle : oui
  Valid� W3C : Oui
  Nom : dodouble.php
  Fonction : Modifie en BDD ce qui est double.
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Gestion de collection-Collection manager</title>
<link rel="stylesheet" type="text/css" href="../include/index.css">
</head>
<body>
<?php
  $DebugMode=False;
  $Action=$_POST["faire"]; //Que faire : add;supp;mod
  $NouvNom=$_POST["Nom_Item"];//Nouveau nom
  if (get_magic_quotes_gpc()==1)
  {
    $NouvNom=addslashes($NouvNom);//Nouveau nom
  }
  $NouvDesc=$_POST["LasDesc"]; //Pour Double
  $OldFile=$_POST["AncienFichier"];
  $Key=$_POST["TheItem"]; //Cle Primaire
  $Type_Page=$_POST["Type_Page"]; //Numero de page
  $Langage=$_POST["Lan"];
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage$Type_Page.php";
  switch ($Langage)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
               $EndGood="Modification correctement effectu�e";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               $EndGood="Item has been changed successfully";
               break;
  }
  switch($Type_Page)
  {
    case 6 : $Repertoire=$EnteteRep."obturateurs/";
             break;
    case 7 : $Repertoire=$EnteteRep."montures/";
             break;
    case 8 : $Repertoire=$EnteteRep."typeapps/";
             break;
  }
//Requetes
//Creation du champ3 :
  $TempChamp3=strtolower($NouvNom);//Passe en minuscule
  $LeChamp3=str_replace(" ","",$TempChamp3);
  $NewFile=$Repertoire.$LeChamp3.".txt";
 //Ajout dans la base
  $SQLAdd="INSERT INTO $NomTable ($Champ2,$Champ3) VALUES ('$NouvNom','$LeChamp3');"; //Valable pour les double
 //Suppression dans la base
 if (isset ($Key))
 {
    $SQLDel="DELETE FROM $NomTable WHERE $Champ1=$Key"; //valable pour tous
  //Modification de la table
    $SQLMod="UPDATE $NomTable SET $Champ2='$NouvNom', $Champ3='$LeChamp3' WHERE $Champ1=$Key"; //valable pour les single
 }
 else
 {
   $SQLDel="";
   $SQLMod="";
 }
  if ($DebugMode)
  {
    $couleur="yellow";
    echo "<div align=\"center\"><table border=\"1\" bgcolor=\"blue\">\n";
    echo "<tr><td bgcolor=\"green\">\n";
    echo "<H1>Debug Mode ON</H1>\n";
    echo "<p>Action : <font color=\"$couleur\">\"$Action\"</font></p>\n";
    echo "<p>Num�ro page : <font color=\"$couleur\">\"$Type_Page\"</font></p>\n";
    echo "<p>SQL add :<font color=\"$couleur\">$SQLAdd</font></p>\n";
    echo "<p>SQL supp :<font color=\"$couleur\">$SQLDel</font></p>\n";
    echo "<p>SQL mod :<font color=\"$couleur\">$SQLMod</font></p>\n";
    echo "<p>Ancien : <font color=\"$couleur\">$LeChamp3</font></p>";
    echo "<p>Old File : <font color=\"$couleur\">$OldFile</font></p>";
    echo "<p>New File : <font color=\"$couleur\">$NewFile</font></p>";
    echo "<p>EndGood : <font color=\"$couleur\">$EndGood</font></p>\n";
  }
//Agir en fonction.
  $SQLS="";
  switch ($Action)
  {
    case 1 : $SQLS=$SQLAdd;//Ajouter
             //Creer fichier
             CreeFichier($NewFile,$NouvDesc);
             break;
    case 2 : $SQLS=$SQLMod;//Modifier
             //Supprimer fichier puis recr�er
             DetruitFichier($OldFile);
             CreeFichier($NewFile,$NouvDesc);
             break;
    case 3 : $SQLS=$SQLDel;//Supprimer
             //Supprimer fichier
             DetruitFichier($OldFile);
             break;
  }
  $OK=FALSE;
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($DebugMode)
  {
    echo "<p>Requete : <font color=\"$couleur\">$SQLS</font></p>\n";
    echo "<p>Fin de debug mode</p>\n";
    echo "</td></tr></table></div>\n";
  }
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
  if ($SQLS!="")
  {
    $query=requete_base($SQLS,$connecter,$BaseType);
    if (!$query)
    {
      echo "<br>$Erreur<br>";
      if ($BaseType==0)
      {
         $ErreurMes=$Erreur." N� ".mysql_errno()." : ".mysql_error();
      }
      else
      {
         $ErreurMes="$Erreur : ibase_errmsg()";
      }
      echo "<p>$ErreurMes<br>\n";
      echo "<p>SQLS =\" $SQLS \".</p>\n";
      die("$DBPb");
    }
    echo "<p>$EndGood</p>\n";
  }
  else
    echo "<p>$NoChoiceMade</p>";
  $CheminBack="double.php?Language=$Langage&NumPage=$Type_Page";
  echo "<p><a href=\"$CheminBack\">$Retour</a></p>\n";
  include "../include/footer.php";
?>