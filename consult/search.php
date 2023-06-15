<?php
/*
  Version  : 1.2 R3
  Date de création : 21 Mai 2018.
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : consult/search.php
  Fonction : Recherche des informations.
*/
	include "../include/config.inc.php";
	include "../include/function.inc.php";
	require("../include/Smarty.class.php");
	$template=new Smarty(); 
	$CheminTpl='../templates/';
	$Lang=$Langue_Sys;
	switch ($Lang)
	{
		case "F" : include "../include/LangueFR.inc.php";
				   break;
		case "E" : include "../include/LangueEN.inc.php";
				   break;
		default :  include "../include/LangueFR.inc.php";
				   $Lang="F";
	}
	$template->assign("Pays",$Pays);
	$template->assign("ParCritere",$ParCritere);
	$template->assign("TypeSupp",$TypeSupp);
	$template->assign("Perio",$Perio);
	$template->assign("Forma",$Forma);
	$template->assign("TypeMat",$TypeMat);
	$template->assign("Obtu",$Obtu);
	$template->assign("Montu",$Montu);
	$template->assign("TypeApp",$TypeApp);
	$template->assign("Mark",$Mark);
	$template->assign("Appar",$Appar);
	$template->assign("HomeTitle",$Display);
	$template->assign("VersionNum",$VersionNum);
	$template->assign("CheminIndex","../index.php");
	$template->assign("LIndex",$LIndex);
	$template->display($CheminTpl.'consult_search.tpl');
?>