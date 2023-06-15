<?php
  /*
  Version  : 1.2 R3
  Date de modification : 14 Mai 2018.
  Valid� fonctionnelle : non
  Valid� W3C : Oui
  Nom : double.php
  Fonction : Gere les "Double".
*/
  //include files
session_start();
include "../include/config.inc.php";
include "../include/function.inc.php";
require("../include/Smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
$Langue=$Langue_Sys;
if (isset($_GET["NumPage"]))
{
	$Type_Page=$_GET["NumPage"];
}
else
{
  $Type_Page=-1;
}
if (isset($_SESSION['InSession_Photo'])) 
{
	if($Type_Page==-1)
	{
	  //Erreur de page
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit();
	}
	include "../include/typepage$Type_Page.php";
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
	$NomPage=$CheminTpl.'double_gest.tpl';
	$template->assign("Mgmt",$Mgmt);
	$template->assign("Titre1Page",$Titre1Page);
	//Selection du r�pertoire.
	$Repertoire=$EnteteRep.$NomRepItem;
	$template->assign("Type_Page",$Type_Page);
	$template->assign("StyleExist",$StyleExist);
	//ici on liste les items pr�sents
	$SQLS=$RequeteSelect;
	$connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName);
	if (!$connecter)
	{
		//Redirection vers page d'erreur******************************************************************************
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
	$i=0;
	foreach($tabresult as $row)
	{
		$CheminComplet=$Repertoire.$row["DESC_GEN"].".txt";
		$tab_item[$i]["PK_GEN"]=$row["PK_GEN"];
		$tab_item[$i]["NOM_GEN"]=$row["NOM_GEN"];
		$tab_item[$i]["Chemin"]=$CheminComplet;
		$i++;
	}
	$template->assign("liste_item",$tab_item);
	$template->assign("LeNom",$LeNom);
	$template->assign("Mot1",$Mot1);
	$template->assign("LeItemPage",$LeItemPage);    
	$template->assign("BoutonSupp",$BoutonSupp);
	$template->assign("BoutonMod",$BoutonMod);
	$template->assign("BoutonAdd",$BoutonAdd);
	
}//Fin du if in session
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
$template->assign('VersionNum',$VersionNum);
$template->display($NomPage);
?>
