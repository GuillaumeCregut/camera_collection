<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	gestion/index.php								 *
 * Date création :	19/05/2018										 *
 * Date Modification :	19/05/2018									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	1.2 R2/3											 *
 * Objet et notes :	 fonctionnelle									 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
session_start();
include "../include/config.inc.php";
require("../include/smarty.class.php");
//Chargement du module template
$template=new Smarty(); 
$Langue=$Langue_Sys;
switch ($Langue)
{
    case "F" : include "../include/LangueFR.inc.php";
			   $Checked1="checked";
			   $Checked2="";
               break;
    case "E" : include "../include/LangueEN.inc.php";
			   $Checked1="";
			   $Checked2="checked";
               break;
}
//On verifie qu'on est dans une session 
if (isset($_SESSION['InSession_Photo']))
{
	$InSession=$_SESSION['InSession_Photo'];
	$NomPage='../templates/gest_index.tpl';
	$template->assign("Pays",$Pays);
	$template->assign("TypeSupp",$TypeSupp);
	$template->assign("Perio",$Perio);
	$template->assign("Forma",$Forma);
	$template->assign("TypeMat",$TypeMat);
	$template->assign("Obtu",$Obtu);
	$template->assign("Montu",$Montu);
	$template->assign("TypeApp",$TypeApp);
	$template->assign("Mark",$Mark);
	$template->assign("Appar",$Appar);
	$template->assign("Lettre",$Langue);
	$template->assign('GenereCat',$Genere_Catalogue);
	$template->assign('ExportDB',$Export_Datas);
	$template->assign('Stats',$StatistiquesPage);
}//Fin if session
else  
{
	//On est pas en session
	$NomPage='../templates/protege.tpl';
	$template->assign("Protected_Area",$Protected_Area);
}
//On affiche la page
$template->assign("HomeTitle",$HomeTitle);
$template->assign("VersionNum",$VersionNum);
$template->assign("CheminIndex","../index.php");
$template->assign("LIndex",$LIndex);
$template->display($NomPage);
?>