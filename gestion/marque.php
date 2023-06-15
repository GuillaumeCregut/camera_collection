<?php
  /*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Valid� fonctionnelle : oui
  Valid� W3C : Oui
  Nom : marque.php
  Fonction : Gere les marques.
*/
session_start();
  //include files
include "../include/config.inc.php";
include "../include/function.inc.php";
include "../include/typepage9.php";
require("../include/Smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
$Langue=$Langue_Sys;
switch ($Langue)
{
case "F" : include "../include/LangueFR.inc.php";
		   $Titre1Page=$TitrePageF;
		 //  $LeItemPage=$LeItemPageF; //Pourquoi en commentaire ?
		   break;
case "E" : include "../include/LangueEN.inc.php";
		   $Titre1Page=$TitrePageE;
		   $LeItemPage=$LeItemPageE; //concerne le textarea
		   break;
}
if (isset($_SESSION['InSession_Photo']))
{ 
	$NomFichier=$CheminTpl.'marque_gest.tpl';
	$Repertoire=$EnteteRep.$NomRepItem;
	$template->assign("Mgmt",$Mgmt);
	$template->assign("TitreMarques",$TitreMarques);
	$template->assign("Langue",$Langue);
	$template->assign("StyleExist",$StyleExist);
	//ici on liste les items pr�sents
	$SQLS="SELECT T_M.PK_MARQUE, T_M.NOM_MARQUE, T_M.HIST_MARQUE, T_P.NOM_PAYS FROM t_marque T_M INNER JOIN t_pays T_P ON T_M.FK_Pays=T_P.PK_Pays ORDER BY Nom_Marque";
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
	$sth->execute();
	$tabresult= $sth->fetchAll();
	//Tableau des marques pour affichage
	$i=0;
	foreach($tabresult as $row)
	{
	  $CheminComplet=$Repertoire.$row["HIST_MARQUE"].".txt";
	  $tabItem[$i]['chemin']=$CheminComplet;
	  $tabItem[$i]["PK_MARQUE"]=$row["PK_MARQUE"];
	  $tabItem[$i]["NOM_MARQUE"]=$row["NOM_MARQUE"];
	  $tabItem[$i]["NOM_PAYS"]=$row["NOM_PAYS"];
	  $i++;
	}
	$template->assign("TabItem",$tabItem);
	$template->assign("LeNom",$LeNom);
	$template->assign("LePaysMarque",$LePaysMarque);
	$SQLS="SELECT PK_PAYS, NOM_PAYS FROM t_pays ORDER BY Nom_Pays";
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabPays",$tabresult);
	$template->assign("Mot1",$Mot1);
	$template->assign("LeMarquePage",$LeMarquePage);
	$template->assign("BoutonSupp",$BoutonSupp);
	$template->assign("BoutonMod",$BoutonMod);
	$template->assign("BoutonAdd",$BoutonAdd);
} //fin if session
else
{
	$NomFichier='../templates/protege.tpl';
	$template->assign("Protected_Area",$Protected_Area);
}
$template->assign("CheminIndex",$CheminIndex);
$template->assign("LIndex",$LIndex);
$template->assign("VersionNum",$VersionNum);
$template->display($NomFichier);
?>
