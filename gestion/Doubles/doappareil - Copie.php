<?php
  /*
  Version  : 1.1 R1
  Date de modification : 19 décembre 2008.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : doappareil.php
  Fonction : Modifie en BDD ce qui les appareils.
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
  $DebugMode=FALSE;
  $Action=$_POST["faire"]; //Que faire : add;supp;mod
  $Langage=$_POST["Lan"];
//Concerne la fiche
  $NouvNom=$_POST["NomMat"];//Nouveau nom
  $FKMat=$_POST["SorteMat"];
  $FKMark=$_POST["NumMarque"];
  $FKCat=$_POST["NumCate"];
  $FKForm=$_POST["NumFormat"];
  $FKFilm=$_POST["NumSupp"];
  $AnneeP=$_POST["AnneeConst"];
  $FKPer=$_POST["NumPeriode"];
  $FKShutter=$_POST["NumShutter"];
  $FKLens=$_POST["NumLens"];
  $Photos=$_POST["PhotoCam"];
  $Prix=$_POST["PrixAchat"];
  $EtatApp=$_POST["etatapp"];
  $InfoApp=$_POST["InfoApp"];
  $NotePerso=$_POST["NotePers"];         //A voir
  $CodeInv=$_POST["CodeInv"]; //Cle Primaire
//Concerne l'ancien appareil
  $OldFile1=$_POST["AncienFichier1"];
  $OldFile2=$_POST["AncienFichier2"];
  $OldKey=$_POST["OldApp"];
//Protection
  if (get_magic_quotes_gpc()==1)
  {
    $NouvNom=addslashes($NouvNom);//Nouveau nom
    $AnneeP=addslashes($AnneeP);
    $Photos=addslashes($Photos);
    $Prix=addslashes($Prix);
    $CodeInv=addslashes($CodeInv); //Cle Primaire
  }
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage10.php";
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
  if (!($PrivateUse))
  {
    $Prix=0;
    $EtatApp=0;
  }
  $Repertoire=$EnteteRep.$NomRepItem;
  //Requetes
//Creation des champs textes :
  $TempChamp3=strtolower($NouvNom);//Passe en minuscule
  $LeChamp3=str_replace(" ","",$TempChamp3);
  $ChpNotes=$LeChamp3."N";
  $ChpHist=$LeChamp3."H";
  $NoteFile=$Repertoire.$ChpNotes.".txt";
  $HistFile=$Repertoire.$ChpHist.".txt";
//Creation champs RefInv s'il n'existe pas :
  if ($CodeInv=="")
  {
    srand((float) microtime()*1000000);
    $randval = rand(1,20);
    $CodeInv=$NouvNom."$randval";
  }

  //Formattage de la date
  $Annee=$AnneeP."-01-01";
 //Ajout dans la base
 //Requete

  $SQLAdd="INSERT INTO t_item (Ref_inv,FK_Marque,FK_Film,FK_App,FK_Mat,FK_Obtu,FK_Monture,FK_Format,FK_Periode,Annee_Prod,Photos,Nom_ITem, Prix_Achat,Etat,Hist_Item,Notes_Perso)";
  $SQLAdd=$SQLAdd." VALUES ('$CodeInv',$FKMark,$FKFilm,$FKCat,$FKMat,$FKShutter,$FKLens,$FKForm,$FKPer,'$Annee','$Photos','$NouvNom',$Prix,$EtatApp,'$ChpHist','$ChpNotes');";
 //Suppression dans la base
  $SQLDel="DELETE FROM t_item WHERE Ref_Inv='$OldKey';"; //valable pour tous
 //Modification de la table
  $SQLMod="UPDATE t_item SET ";
  $C1="Ref_Inv='$CodeInv',";
  $C2="FK_Marque=$FKMark,";
  $C3="FK_Film=$FKFilm,";
  $C4="FK_App=$FKCat,";
  $C5="FK_Mat=$FKMat,";
  $C6="FK_Obtu=$FKShutter,";
  $C7="FK_Monture=$FKLens,";
  $C8="FK_Format=$FKForm,";
  $C9="FK_Periode=$FKPer,";
  $C10="Annee_Prod='$Annee',";
  $C11="Photos='$Photos',";
  $C12="Nom_Item='$NouvNom',";
  $C13="Prix_Achat=$Prix,";
  $C14="Etat=$EtatApp,";
  $C15="Hist_Item='$ChpHist',";
  $C16="Notes_Perso='$ChpNotes'";
  $SQLMod=$SQLMod.$C1.$C2.$C3.$C4.$C5.$C6.$C7.$C8.$C9.$C10.$C11.$C12.$C13.$C14.$C15.$C16;
  $SQLMod=$SQLMod." WHERE Ref_Inv='$OldKey'";
//Agir en fonction.
  $SQLS="";
  switch ($Action)
  {
    case 1 : $SQLS=$SQLAdd;//Ajouter
             //Creer fichier
             CreeFichier($HistFile,$InfoApp);
             CreeFichier($NoteFile,$NotePerso);
             break;
    case 2 : $SQLS=$SQLMod;//Modifier
            // Supprimer fichier puis recréer
             DetruitFichier($OldFile1);
             DetruitFichier($OldFile2);
             CreeFichier($HistFile,$InfoApp);
             CreeFichier($NoteFile,$NotePerso);
             break;
    case 3 : $SQLS=$SQLDel;//Supprimer
             // Supprimer fichier
              DetruitFichier($OldFile1);
              DetruitFichier($OldFile2);
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
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br />$Erreur<br />";
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
  $CheminBack="appareil.php?Language=$Langage";
  echo "<p><a href=\"$CheminBack\">$Retour</a></p>\n";
  include "../include/footer.php";
?>