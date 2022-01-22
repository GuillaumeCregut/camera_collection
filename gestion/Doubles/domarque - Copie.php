<?php
  /*
  Version  : 1.1 R1
  Date de modification : 11 décembre 2008.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : domarque.php
  Fonction : Effectue les modifications en BDD sur les marques.
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
    $NouvNom=addslashes($NouvNom);
  }
  $NouvDesc=$_POST["LasDesc"]; //Pour Double
  $FKPays=$_POST["NumPays"];
  $OldFile=$_POST["AncienFichier"];
  $Key=$_POST["TheItem"]; //Cle Primaire
  $Langage=$_POST["Lan"];
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage9.php";
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

  $Repertoire=$EnteteRep.$NomRepItem;
  //Requetes
//Creation du champ3 :
  $TempChamp3=strtolower($NouvNom);//Passe en minuscule
  $LeChamp3=str_replace(" ","",$TempChamp3);
  $NewFile=$Repertoire.$LeChamp3.".txt";
 //Ajout dans la base
  $SQLAdd="INSERT INTO t_marque (FK_Pays,Nom_Marque, Hist_Marque) VALUES ($FKPays,'$NouvNom','$LeChamp3')"; //Valable pour les double
  if (isset($Key))
  {
 //Suppression dans la base
    $SQLDel="DELETE FROM t_marque WHERE PK_Marque=$Key"; //valable pour tous
 //Modification de la table
    $SQLMod="UPDATE t_marque SET FK_Pays=$FKPays, Nom_Marque='$NouvNom', Hist_Marque='$LeChamp3' WHERE PK_Marque=$Key"; //valable pour les single
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
    echo "<p>Numéro page : <font color=\"$couleur\">\"$Type_Page\"</font></p>\n";
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
             //Supprimer fichier puis recréer
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
         $ErreurMes=$Erreur." N° ".mysql_errno()." : ".mysql_error();
       }
       else
       {
          $ErreurMes="$Erreur : ".ibase_errmsg();
       }
       echo "<p>$ErreurMes<br>\n";
       echo "<p>SQLS =\" $SQLS \".</p>\n";
       die("$DBPb");
    }
    echo "<p>$EndGood</p>\n";
  }
  else
    echo "<p>$NoChoiceMade</p>\n";
  $CheminBack="marque.php?Language=$Langage";
  echo "<p><a href=\"$CheminBack\">$Retour</a></p>\n";
  include "../include/footer.php";
?>