<?php
  /*
  Version  : 1.2 R2
  Date de modification : 14 Mai 2018.
  Valid� fonctionnelle : oui
  Valid� W3C : Oui
  Nom : single.php
  Fonction : Gere ce qui est single.
*/
  //include files
session_start();
include "../include/config.inc.php";
include "../include/function.inc.php";
require("../include/Smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
if(isset($_GET["NumPage"]))
{
 $Type_Page=$_GET["NumPage"];
}
else
{
 $Type_Page=-1;  
} 
$Langue=$Langue_Sys;
if (isset($_SESSION['InSession_Photo'])) 
{
		//On est dans la session
	if ($Type_Page==-1)
	{
	  //Gestion page d'erreur
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit();
	}
	else
	{
		$NomPage=$CheminTpl.'single_gest.tpl';
		include "../include/typepage$Type_Page.php";
		switch ($Langue)
		{
			case "F" : include "../include/LangueFR.inc.php";
				   $Titre1Page=$TitrePageF;
				   break;
			case "E" : include "../include/LangueEN.inc.php";
				   $Titre1Page=$TitrePageE;
				   break;
		}
		$template->assign("Mgmt",$Mgmt);
		$template->assign("Titre1Page",$Titre1Page);
		$template->assign("Type_Page",$Type_Page);
		$template->assign("Langue",$Langue);
		$template->assign("StyleExist",$StyleExist);
		//ici on liste les items pr�sents
		$SQLS=$RequeteSelect;
		$OK=FALSE;
		//Connexion � la base de donn�es
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
		$sth->execute();
		$tabresult= $sth->fetchAll();
		$template->assign("liste_item",$tabresult);
		$template->assign("LeNom",$LeNom);
		$template->assign("BoutonSupp",$BoutonSupp);
		$template->assign("BoutonMod",$BoutonMod);
		$template->assign("BoutonAdd",$BoutonAdd);
	}
} //fin if in session
else
{
	switch ($Langue)
	{
		case "F" : include "../include/LangueFR.inc.php";
			   break;
		case "E" : include "../include/LangueEN.inc.php";
			   break;
	}
	$NomPage='../templates/protege.tpl';
	$template->assign("Protected_Area",$Protected_Area);
}
$template->assign("CheminIndex",$CheminIndex);
$template->assign("LIndex",$LIndex);
$template->assign("VersionNum",$VersionNum);
$template->display($NomPage);
?>