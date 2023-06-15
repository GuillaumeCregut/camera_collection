<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	index.php	  									 *
 * Date création :	01/05/2018										 *
 * Date Modification :	19/05/2018									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	1.2 R3												 *
 * Objet et notes :	valide											 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start();
	include "include/config.inc.php";
	include("./include/Smarty.class.php");
	$CheminTpl='../templates/';
  //Vérification de la langue utilisée : par défaut, le francais
	$Langue=$Langue_Sys;
	switch ($Langue)
	{
		case "F" : include "include/LangueFR.inc.php";
               break;
		case "E" : include "include/LangueEN.inc.php";
               break;
	}
  //Chargement du module template
	$template=new Smarty(); 
  //Assignation des valeurs
	$template->Assign('LIndex',$LIndex); 
	$template->Assign('GestionColl',$GestionColl);
	$template->Assign('Pays',$Pays);
	$template->Assign('TypeSupp',$TypeSupp);
	$template->Assign('Perio',$Perio);
	$template->Assign('Forma',$Forma);
	$template->Assign('TypeMat',$TypeMat);
	$template->Assign('Obtu',$Obtu);
	$template->Assign('Montu',$Montu);
	$template->Assign('TypeApp',$TypeApp);
	$template->Assign('Mark',$Mark);
	$template->Assign('Appar',$Appar);
	$template->Assign('Display',$Display);
	$template->Assign('Recherche',$Recherche);
	$template->Assign('TitreMarques',$TitreMarques);
	$template->Assign('TypeSupp',$TypeSupp);
	$template->Assign('VersionNum',$VersionNum);
	$template->Assign('Presentation',$Presentation);
	if (isset($_SESSION['InSession_Photo']))
	{
		$InSession=$_SESSION['InSession_Photo'];
	}
	else
		$InSession=false;	
	
	if($InSession)
	{
		$template->Assign('GestionColl',$GestionColl);
		$template->Assign('HomeTitle',$HomeTitle);
		$template->Assign('ConfSys',$ConfSys);
		$template->Assign('Diconnect',$Diconnect);
		$template->display($CheminTpl.'index.tpl');
	}
	else
	{
		$template->display($CheminTpl.'index_free.tpl');
	}
?>
