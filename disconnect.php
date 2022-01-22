<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	disconnect.php	  								 *
 * Date création :	20/05/2018										 *
 * Date Modification :	20/05/2018									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	1.2 R3												 *
 * Objet et notes :	 fonctionnelle									 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
session_start();
include "include/config.inc.php";
require("include/smarty.class.php");
$CheminTpl='../templates/';
//Chargement du module template
$template=new Smarty(); 
$Langue=$Langue_Sys;
//On verifie qu'on est dans une session 
switch ($Langue)
{
    case "F" : include "include/LangueFR.inc.php";
               break;
    case "E" : include "include/LangueEN.inc.php";
               break;
}
$InSession=false;
unset($_SESSION);
session_destroy();
$template->Assign("Protected_Area",$Disconnected);
$NomPage=$CheminTpl.'deconnecte.tpl';
$template->Assign("VersionNum",$VersionNum);
$template->assign("CheminIndex","index.php");
$template->assign("LIndex",$LIndex);
$template->display($NomPage);
?>
