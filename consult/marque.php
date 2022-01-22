<?php
/*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : marque.php
  Fonction : Recherche les marques par pays.
*/
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  require("../include/smarty.class.php");
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  $Langue=$Langue_Sys;
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
//Connexion à la base de données
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
  $template->assign('RechMark',$RechMark);
  $template->assign('Langue',$Langue);
  $template->assign('Pays',$Pays);
  $SQLS="SELECT PK_PAYS, NOM_PAYS FROM t_pays ORDER BY NOM_PAYS";
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('liste_pays',$tabresult); 
  $template->assign('Search',$Search);
  $template->assign('CheminIndex','search.php');
  $template->assign('LIndex',$LIndex);
  $template->assign('VersionNum',$VersionNum);
  $template->display($CheminTpl.'rech_marque.tpl');
