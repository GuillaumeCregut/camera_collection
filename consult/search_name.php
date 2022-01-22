<?php
/*
  Version  : 1.2 R2
  Date de modification : 3 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : search_name.php
  Fonction : Recherche un élément par nom.
*/
  require("../include/smarty.class.php");
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  include "../include/config.inc.php";
  $Langue=$Langue_Sys;
  if (isset($_GET["NumPage"]))
  {
	  $TypePage=$_GET["NumPage"];
  }
  else
  {
	$template->assign('Erreur_Base',$Erreur_Num_Page);
	$template->assign('CheminIndex',$CheminIndex);
	$template->assign('VersionNum',$VersionNum);
	$template->assign('LIndex',$LIndex);
	$template->display($CheminTpl.'erreur_base.tpl');	
	exit();  
  }  
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
  $template->assign('SearchFor',$SearchFor);
  $template->assign('Langue',$Langue);
  $template->assign('TypePage',$TypePage);
  $Erreur=false;
  switch ($TypePage)
  {
    case 1 :  $TitreRech=$Pays;
              break;
    case 2 :  $TitreRech=$TypeSupp;
              break;
    case 3 :  $TitreRech=$Perio;
              break;
    case 4 :  $TitreRech=$Forma;
              break;
    case 5 :  $TitreRech=$TypeMat;
              break;
    case 6 :  $TitreRech=$Obtu;
              break;
    case 7 :  $TitreRech=$Montu;
              break;
    case 8 :  $TitreRech=$TypeApp;
              break;
    case 9 :  $TitreRech=$Mark;
              break;
    case 10 : $TitreRech=$Appar;
              break;
	default : $Erreur=true;
  }
  if ($Erreur)
  {
	$template->assign('Erreur_Base',$Erreur_Num_Page);
	$template->assign('CheminIndex',$CheminIndex);
	$template->assign('VersionNum',$VersionNum);
	$template->assign('LIndex',$LIndex);
	$template->display($CheminTpl.'erreur_base.tpl');	  
	exit();	
  }
//
  $template->assign('TitreRech',$TitreRech);
  $template->assign('LeNom',$LeNom);
  $template->assign('Search',$Search);
  $template->assign('CheminIndex','search.php');
  $template->assign('LIndex',$LIndex);
  $template->assign("VersionNum",$VersionNum);
  $template->display($CheminTpl.'search_name.tpl');
?>