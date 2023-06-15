<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	connexion.php	  								 *
 * Date création :	20/05/2018										 *
 * Date Modification :	20/05/2018									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	1.2 R3												 *
 * Objet et notes :	 non fonctionnelle								 *
 *	Permet le login de l'utilisateur								 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
session_start();
include "include/config.inc.php";
require("include/Smarty.class.php");
//Chargement du module template
$template=new Smarty(); 
$Langue=$Langue_Sys;
$CheminTpl='../templates/';
switch ($Langue)
{
    case "F" : include "include/LangueFR.inc.php";
               break;
    case "E" : include "include/LangueEN.inc.php";
               break;
}
$OK=true;
if (isset($_POST['NomUser']))
{
	$Lelogin=$_POST['NomUser'];
}
else
{
	$OK=false;
}
if (isset($_POST['Mot_Passe']))
{
	$LePass=$_POST['Mot_Passe'];
}
else
{
	$OK=false;
}
if ($OK)
{
	//Session ouverte
	//On verifie si le login et le mot de passe sont OK
	if(($Lelogin==$User_Gestion)&&($LePass==$Pass_Gestion))
	{
		$_SESSION['InSession_Photo']=1;
		$NomFichier='connexion_ok.tpl';
		$template->assign('Connexion_OK',$Connexion_OK);
		$template->assign('Connection',$UserConnection);
	}
	else
	{
		//Login ou MDP faux
		$NomFichier='connexion1.tpl';
		$template->assign('Erreur',$Erreur.' !');
		$template->assign('Validation',$Validation_Btn);
		$template->assign('Login',$Login_Texte);
		$template->assign('MDP',$Passe_Texte);
		$template->assign('Connection',$UserConnection);
	}
}
else
{
	//On affiche la page de connexion
	$NomFichier='connexion1.tpl';
	$template->assign('Validation',$Validation_Btn);
	$template->assign('Login',$Login_Texte);
	$template->assign('MDP',$Passe_Texte);
	$template->assign('Connection',$UserConnection);
}
$template->assign('VersionNum',$VersionNum);
$template->assign('Retour',$Retour);
$template->display($CheminTpl.$NomFichier);
?>