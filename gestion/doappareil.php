<?php
  /*
  Version  : 1.2 R3
  Date de modification : 22 Mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : doappareil.php
  Fonction : Modifie en BDD ce qui les appareils.
*/
session_start();
include "../include/config.inc.php";
include "../include/function.inc.php";
include "../include/typepage10.php";
require("../include/Smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
$DebugMode=false;
$Langage=$Langue_Sys;
if(isset($_POST["faire"]))
{
$Action=$_POST["faire"]; //Que faire : add;supp;mod
}
else
{
  $Action=-1;
}
//Concerne la fiche
if(isset($_POST["NomMat"]))
{
$NouvNom=$_POST["NomMat"];//Nouveau nom
}
else
{
  $NouvNom="";
}
if(isset($_POST["SorteMat"]))
{
$FKMat=$_POST["SorteMat"];
}
else
{
  $FKMat=-1;
}
if(isset($_POST["NumMarque"]))
{
$FKMark=$_POST["NumMarque"];
}
else
{
  $FKMark=-1;
}
if(isset($_POST["NumCate"]))
{
$FKCat=$_POST["NumCate"];
}
else
{
  $FKCat=-1;
}
if(isset($_POST["NumFormat"]))
{
$FKForm=$_POST["NumFormat"];
}
else
{
  $FKForm=-1;
}
if(isset($_POST["NumSupp"]))
{
$FKFilm=$_POST["NumSupp"];
}
else
{
  $FKFilm=-1;
}
if(isset($_POST["AnneeConst"]))
{
$AnneeP=$_POST["AnneeConst"];
}
else
{
  $AnneeP=-1;
}
if(isset($_POST["NumPeriode"]))
{
$FKPer=$_POST["NumPeriode"];
}
else
{
  $FKPer=-1;
}
if(isset($_POST["NumShutter"]))
{
$FKShutter=$_POST["NumShutter"];
}
else
{
  $FKShutter=-1;
}
if(isset($_POST["NumLens"]))
{
$FKLens=$_POST["NumLens"];
}
else
{
  $FKLens=-1;
}
if(isset($_POST["PhotoCam"]))
{
$Photos=$_POST["PhotoCam"];
}
else
{
  $Photos="";
}
if(isset($_POST["PrixAchat"]))
{
$Prix=$_POST["PrixAchat"];
}
else
{
  $Prix="";
}
if(isset($_POST["etatapp"]))
{
$EtatApp=$_POST["etatapp"];
}
else
{
  $EtatApp=-1;
}
if(isset($_POST["InfoApp"]))
{
$InfoApp=$_POST["InfoApp"];
}
else
{
  $InfoApp="";
}
if(isset($_POST["NotePers"]))
{
$NotePerso=$_POST["NotePers"];         //A voir
}
else
{
  $NotePerso="";
}
if(isset($_POST["CodeInv"]))
{
$CodeInv=$_POST["CodeInv"]; //Cle Primaire
}
else
{
  $CodeInv="";
}
//Concerne l'ancien appareil
if(isset($_POST["AncienFichier1"]))
{
$OldFile1=$_POST["AncienFichier1"];
}
else
{
  $OldFile1="";
}
if(isset($_POST["AncienFichier2"]))
{
$OldFile2=$_POST["AncienFichier2"];
}
else
{
  $OldFile2="";
}
if(isset($_POST["OldApp"]))
{
$OldKey=$_POST["OldApp"];
}
else
{
  $OldKey=-1;
}
//Protection
if (get_magic_quotes_gpc()==1)
{
$NouvNom=addslashes($NouvNom);//Nouveau nom
$AnneeP=addslashes($AnneeP);
$Photos=addslashes($Photos);
$Prix=addslashes($Prix);
$CodeInv=addslashes($CodeInv); //Cle Primaire
}
switch ($Langage)
{
case "F" : include "../include/LangueFR.inc.php";
		   $Titre1Page=$TitrePageF;
		   $EndGood="Modification correctement effectu&eacute;e";
		   break;
case "E" : include "../include/LangueEN.inc.php";
		   $Titre1Page=$TitrePageE;
		   $EndGood="Item has been changed successfully";
		   break;
}
if (isset($_SESSION['InSession_Photo']))
{
	$NomFichier=$CheminTpl.'doappareil_gest.tpl';
	if( $Action==-1)
	{
	 //Erreur 
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit(); 
	}
	$template->assign("Mgmt",$Mgmt);
	$template->assign("Titre1Page",$Titre1Page);
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
	$connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName);
	if (!$connecter)
	{
		//Redirection vers page d'erreur******************************************************************************
		$template->assign('Erreur_Base',$Erreur_db_Connexion);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');	
		exit();	
		//fin redirection*********************************************************************************************
	}
	if ($DebugMode)
	{
		$couleur="red";
		echo "<p>Requete : <font color=\"$couleur\">$SQLS</font></p>\n";
		echo "<p>Fin de debug mode</p>\n";
		echo "</td></tr></table></div>\n";
	}
	/*	$query=requete_base($SQLS,$connecter,$BaseType);
	*/
	$sth=$connecter->prepare($SQLS);
	$OK=$sth->execute();
	if (!$OK)
	{
		$template->assign("Error","erreur");
		$template->assign("Erreur",$Erreur);
		$Message=$sth->errorInfo();
		$Erreur_Msg=$Erreur." N° ".$sth->errorCode()." : ".$Message[2];
		$template->assign("Error_msg",$Erreur_Msg);
		$template->assign("SQLS",$SQLS);
	}
	else
	{
		$template->assign("EndGood",$EndGood);
	}
	$LeChemin='appareil.php';
	$Lien=$Retour;

} //fin if session
else
{
	$NomFichier='../templates/protege.tpl';
	$Lien=$LIndex;
	$LeChemin=$CheminIndex;
	$template->assign("Protected_Area",$Protected_Area);
}
$template->assign("CheminIndex",$LeChemin);
$template->assign("VersionNum",$VersionNum);
$template->assign("LIndex",$Lien);
$template->display($NomFichier);	
?>