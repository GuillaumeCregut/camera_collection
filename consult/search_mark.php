<?php
/*
  Version  : 1.2 R2
  Date de modification : 03 Mai 2018.
  Valid� fonctionnelle : Oui
  Valid� W3C : Oui
  Nom : search_mark.php
  Fonction : Affiche les r�sultats de recherche des marques.
*/
  require("../include/Smarty.class.php");
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage9.php";
  $template=new Smarty(); 
  $CheminTpl='../templates/';
//Importation des infos
  $Langue=$Langue_Sys;
  if (isset($_POST["SortePays"]))
  {
	  $EPays=$_POST["SortePays"];
  }
  else
	  $EPays=0;

  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
  //Connexion � la base de donn�es
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
  $SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM t_marque WHERE FK_PAYS=$EPays ORDER BY NOM_MARQUE ";
//
  $template->assign('ResultRechMark',$ResultRechMark);
  $template->assign('Langue',$Langue);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $i=0;
  foreach($tabresult as $row)
  {
	$TabList[$i]['PK_MARQUE']=$row['PK_MARQUE'];
	$TabList[$i]['NOM_MARQUE']=$row['NOM_MARQUE'];
	$TabList[$i]['Icone_View']=$Icone_View;	
	$i++;	
  }
  if (isset($TabList))
	$template->assign('liste_marque',$TabList);
  $template->assign('Retour',$Retour);
  $template->assign('AucunRes',$AucunRes);
  $template->assign("VersionNum",$VersionNum);
  $template->display($CheminTpl.'search_mark.tpl');
?>