<?php
  /*
  Version  : 1.2 R3
  Date de modification : 14 Mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : dosingle.php
  Fonction : Modifie en BDD ce qui est single.
*/
session_start();
include "../include/config.inc.php";
include "../include/function.inc.php";
require("../include/smarty.class.php");
$Langage=$Langue_Sys;
$DebugMode=False;
$template=new Smarty(); 
$CheminTpl='../templates/';
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
	$NouvNom=addslashes($NouvNom);//Nouveau nom
}
if(isset($_POST["LasDesc"]))
{
	$NouvDesc=$_POST["LasDesc"]; //Pour Double
}
else
{
  $NouvDesc="";
}
if(isset($_POST["TheItem"]))
{
	$Key=$_POST["TheItem"]; //Cle Primaire
}
else
{
  $Key=-1;
}
if(isset($_POST["Type_Page"]))
{
  $Type_Page=$_POST["Type_Page"]; //Numero de page
}
else
{
  $Type_Page==-1;
}
if (isset($_SESSION['InSession_Photo']))
{
	if ($Type_Page==-1)
	{	
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit();
	}
	$NomPage=$CheminTpl.'dosingle_gest.tpl';
	include "../include/typepage$Type_Page.php";
	switch ($Langage)
	{
		case "F" : include "../include/LangueFR.inc.php";
				$Titre1Page=$TitrePageF;
				$ModGood="Modification correctement effectu&eacute;e";
				$AddGood="Ajout effectu&eacute;";
				$SuppGood="Suppression effectu&eacute;";
				break;
		case "E" : include "../include/LangueEN.inc.php";
				$Titre1Page=$TitrePageE;
				$ModGood="Item has been changed successfully";
				$AddGood="Item successfully added";
				$SuppGood="Item successfully deleted";
				break;
	}
	$template->assign("Mgmt",$Mgmt);
	$template->assign("Titre1Page",$Titre1Page);
	//Requetes
	//Ajout dans la base
	if ($NouvNom!="")
	{
		$SQLAdd="INSERT INTO $NomTable ($Champ2) VALUES ('$NouvNom');"; //Valable pour les single
	}
	else
	{
		$SQLAdd="";  //Mieux gérer cette action !
	}
	//Suppression dans la base	
	$SQLDel="DELETE FROM $NomTable WHERE $Champ1=$Key"; //valable pour les single
	//Modification de la table
	if ($NouvNom!="")
	{
		$SQLMod="UPDATE $NomTable SET $Champ2='$NouvNom' WHERE $Champ1=$Key"; //valable pour les single
	}
	else
	{
		$SQLMod="";  //Mieux g"rer cette action !
	}	
	if ($DebugMode)
	{
		echo "<H1>Debug Mode ON</H1>\n";
		echo "<p>Action : \"$Action\"</p>\n";
		echo "<p>Num&eacute;ro page : \"$Type_Page\"</p>\n";
		echo "<p>SQL add :$SQLAdd</p>\n";
		echo "<p>SQL supp :$SQLDel</p>\n";
		echo "<p>SQL add :$SQLMod</p>\n";
		echo "<p>$EndGood</p>\n";
	}
	//Agir en fonction.
	$SQLS="";
	$SQL_Error=0;
	switch ($Action)
	{
		case 1 : $SQLS=$SQLAdd;//Ajouter
				 $LACTION=$AddGood;
			 break;
		case 2 : $SQLS=$SQLMod;//Modifier
				 $LACTION=$ModGood;
			 break;
		case 3 : $SQLS=$SQLDel;//Supprimer
				 $LACTION=$SuppGood;
			 break;
		default : $SQL_Error=1;
	}
	$OK=FALSE;
	$connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName);
	//Execution de la requete
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
		$template->assign("Message_OK",$LACTION);
	}
	$CheminBack="single.php?NumPage=$Type_Page";
	$Lien=$Retour;
	$LeChemin=$CheminBack;
} //fin du isset session
else
{
	switch ($Langage)
	{
		case "F" : include "../include/LangueFR.inc.php";
				break;
		case "E" : include "../include/LangueEN.inc.php";
				break;
	}
	$NomPage='../templates/protege.tpl';
	$Lien=$LIndex;
	$LeChemin=$CheminIndex;
	$template->assign("Protected_Area",$Protected_Area);
}
$template->assign("CheminIndex",$LeChemin);
$template->assign("LIndex",$Lien);
$template->assign("VersionNum",$VersionNum);
$template->display($NomPage);
?>