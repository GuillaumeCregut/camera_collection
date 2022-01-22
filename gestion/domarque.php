<?php
  /*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : domarque.php
  Fonction : Effectue les modifications en BDD sur les marques.
*/
session_start();
$DebugMode=false;
//Include files
include "../include/config.inc.php";
include "../include/function.inc.php";
require("../include/smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
$Langage=$Langue_Sys;
if (isset($_POST["faire"]))
{
$Action=$_POST["faire"]; //Que faire : add;supp;mod
}
else
{
  $Action=-1;
}
if (isset($_POST["Nom_Item"]))
{
$NouvNom=$_POST["Nom_Item"];//Nouveau nom
}
else
{
  $NouvNom="";
}
if (get_magic_quotes_gpc()==1)
{
$NouvNom=addslashes($NouvNom);
}
if (isset($_POST["LasDesc"]))
{
$NouvDesc=$_POST["LasDesc"]; //Pour Double
}
else
{
  $NouvDesc="";
}
if (isset($_POST["NumPays"]))
{
$FKPays=$_POST["NumPays"];
}
else
{
  $FKPays="";
}
if (isset($_POST["AncienFichier"]))
{
$OldFile=$_POST["AncienFichier"];
}
else
{
  $OldFile="";
}
if (isset($_POST["TheItem"]))
{
$Key=$_POST["TheItem"]; //Cle Primaire
}
else
{
  $Key=-1;
}
include "../include/typepage9.php";
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
	if($Action==-1)
	{
	//Erreur
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit(); 
	}
	$NomFichier=$CheminTpl.'domarque_gest.tpl';
	$template->assign("Mgmt",$Mgmt);
	$template->assign("Titre1Page",$Titre1Page);
	$Repertoire=$EnteteRep.$NomRepItem;
//Requetes
//Creation du champ3  : Description:
	$TempChamp3=strtolower($NouvNom);//Passe en minuscule
	$LeChamp3=str_replace(" ","",$TempChamp3);
	$LeChamp3=preg_replace( '#[^A-Za-z0-9-]+#' ,'',$LeChamp3);
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
		echo "<p>Description :<br> <font color=\"$couleur\">\"".nl2br($NouvDesc)."\"</font></p>\n";
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
	/////////////////////////////////////////////////////////////////////////////////////
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
	if ($DebugMode)
	{
		echo "<p>Requete : <font color=\"$couleur\">$SQLS</font></p>\n";
		echo "<p>Fin de debug mode</p>\n";
		echo "</td></tr></table></div>\n";
	}
	$LeChemin='marque.php';
	$Lien=$Retour;
} //Fin if isset session
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