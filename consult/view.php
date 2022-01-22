<?php
/*
  Version  : 1.2 R3
  Date de modification : 20 Mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : view.php
  Fonction : affichage des détails des catégories.
*/
//include files
  require("../include/smarty.class.php");
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  $Langue=$Langue_Sys;
  if (isset($_GET["NumPage"]))
  {
	$Type_Page=$_GET["NumPage"];  
  }
  else
  {
	  $Type_Page=-1;
  }  
  if($Type_Page==-1)
  {
		switch ($Langue)
		{
		case "F" : include "../include/LangueFR.inc.php";
					break;
		case "E" : include "../include/LangueEN.inc.php";
				   break;
		default:   include "../include/LangueFR.inc.php";
				   $Langue="F";
		}
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit();
  }
  else
  {
//Choisi le fichier language
		include "../include/typepage$Type_Page.php";
		switch ($Langue)
		{
		case "F" : include "../include/LangueFR.inc.php";
				   $Titre1Page=$TitrePageF;
				   break;
		case "E" : include "../include/LangueEN.inc.php";
				   $Titre1Page=$TitrePageE;
				   break;
		default:   include "../include/LangueFR.inc.php";
				   $Langue="F";
		}

		$template->assign('DisplayOf',$DisplayOf);
		$template->assign('Titre1Page',$Titre1Page);
		//Recuperation de la requete du fichier typepage
		$SQLS=$RequeteSelect;
		//Connexion à la base de données
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
		//Affichage
		//Définition du nombre de colonne. a supprimer par la suite
		$MaxColonne=5;
		$HauteurCase="20";
		$sth=$connecter->prepare($SQLS);
		$sth->execute();
		$tabresult= $sth->fetchAll();
		$template->assign('Type_Page',$Type_Page);
		$template->assign('Langue',$Langue);
		$template->assign('liste_infos',$tabresult);
		//Pied de page
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->assign('Icone_View',$Icone_View);
		$template->display($CheminTpl.'view.tpl');
  }
?>
