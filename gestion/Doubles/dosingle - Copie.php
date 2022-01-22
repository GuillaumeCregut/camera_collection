<?php
  /*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : dosingle.php
  Fonction : Modifie en BDD ce qui est single.
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
               $EndGood="Modification correctement effectuée";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               $EndGood="Item has been changed successfully";
               break;
  }
//Requetes
 //Ajout dans la base
  $SQLAdd="INSERT INTO $NomTable ($Champ2) VALUES ('$NouvNom');"; //Valable pour les single
 //Suppression dans la base
  $SQLDel="DELETE FROM $NomTable WHERE $Champ1=$Key"; //valable pour les single
 //Modification de la table
  $SQLMod="UPDATE $NomTable SET $Champ2='$NouvNom' WHERE $Champ1=$Key"; //valable pour les single
  if ($DebugMode)
  {
    echo "<H1>Debug Mode ON</H1>\n";
    echo "<p>Action : \"$Action\"</p>\n";
    echo "<p>Numéro page : \"$Type_Page\"</p>\n";
    echo "<p>SQL add :$SQLAdd</p>\n";
    echo "<p>SQL supp :$SQLDel</p>\n";
    echo "<p>SQL add :$SQLMod</p>\n";
    echo "<p>$EndGood</p>\n";
  }
//Agir en fonction.
  $SQLS="";
  switch ($Action)
  {
    case 1 : $SQLS=$SQLAdd;//Ajouter
             break;
    case 2 : $SQLS=$SQLMod;//Modifier
             break;
    case 3 : $SQLS=$SQLDel;//Supprimer
             break;
  }
  $OK=FALSE;
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($DebugMode)
  {
    echo "<p>Requete : $SQLS</p>\n";
  }
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     if ($BaseType==0)
     {
        $ErreurMes=$Erreur." N° ".mysql_errno()." : ".mysql_error();
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
  $CheminBack="single.php?Language=$Langage&NumPage=$Type_Page";
  echo "<p><a href=\"$CheminBack\">$Retour</a></p>\n";
  include "../include/footer.php";
?>