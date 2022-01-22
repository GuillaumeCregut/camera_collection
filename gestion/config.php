<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	config.php	  									 *
 * Date création :	19/05/2018										 *
 * Date Modification :	19/05/2018									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	1.2 R3												 *
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
//On récupère les infos.
if (isset($_SESSION['InSession_Photo']))
{
	$InSession=$_SESSION['InSession_Photo'];
	$NomPage='../templates/gest_config.tpl';


	if (isset($_POST["ConfDone"]))
	{
	//On agit sur la configuration
		if (!(isset($_POST["Gest_Langue"])))
		{
			 $Langue=$Langue_Sys;
		}
		else
		{
			  $Langue=$_POST["Gest_Langue"];
		}	
		//Vérification des données
		if (isset($_POST["NomUtilisateur"]))
		{
			$DBUser=$_POST["NomUtilisateur"];
		}
		//
		if (isset($_POST["MotPasse"]))
		{
			 $DBPass=$_POST["MotPasse"];
		}
		//
		if (isset($_POST["Nom_Serveur"]))
		{
			 $DBServer=$_POST["Nom_Serveur"];
		}
		//
		if (isset($_POST["Nom_Base"]))
		{
			$DBName=$_POST["Nom_Base"];
		}
		//
		if (isset($_POST["Gest_User"]))
		{
			 $User_Gestion=$_POST["Gest_User"];
		}
		//
		if (isset($_POST["Gest_Pass"]))
		{
			 $Pass_Gestion=$_POST["Gest_Pass"];
		}
		//
		
		//Fin de la vérification des données
		switch ($Langue)
		{
		case "F" : $Checked1="checked";
				   $Checked2="";
				   include "../include/LangueFR.inc.php";
				   break;
		case "E" : $Checked1="";
				   $Checked2="checked";
				   include "../include/LangueEN.inc.php";
				   break;
		}
		//On créé le nouveau fichier de configuration
		$OK=false;
		$fichier=fopen("../include/config.inc.php","w");
		fputs($fichier,"<?php\n");
		fputs($fichier,"/*\nVersion  : $VersionNum\n*/\n");
		fputs($fichier,"\$DBUser=\"$DBUser\";\n");
		fputs($fichier,"\$DBPass=\"$DBPass\";\n");
		fputs($fichier,"\$DBName=\"$DBName\";\n");
		fputs($fichier,"\$DBServer=\"$DBServer\";\n");
		fputs($fichier,"\$EnteteRep=\"../texts/\";\n");
		fputs($fichier,"\$PrivateUse =true;\n");
		fputs($fichier,"\$VersionNum=\"$VersionNum\";\n");
		fputs($fichier,"\$User_Gestion=\"$User_Gestion\";\n");
		fputs($fichier,"\$Pass_Gestion=\"$Pass_Gestion\";\n");
		fputs($fichier,"\$BaseType=0;\n");
		fputs($fichier,"\$Langue_Sys=\"$Langue\";");
		fputs($fichier,"\n?>");
		//Enregistrement du fichier
		$OK=fclose($fichier);
		if ($OK)
		{
			$Message_Creation=$Creation_Message;
		}
		else
		{
			$Message_Creation=$Creation_Message_failed;
		}
		$template->Assign("Le_Message",$Message_Creation);
	}//Fin if "on modifie"
	/*$template->Assign("",);*/
	$template->Assign("Pass_Gest",$Pass_Gestion);
	$template->Assign("User_Gest",$User_Gestion);
	$template->Assign("ValBase",$DBName);
	$template->Assign("ValServ",$DBServer);
	$template->Assign("ValPass",$DBPass);
	$template->Assign("ValUser",$DBUser);
	$template->Assign("MotPasse",$Passe_Texte);
	$template->Assign("Base",$Base_Text);
	$template->Assign("Serveur",$Serveur_Texte);
	$template->Assign("Lan",$Langue);
	$template->Assign("NomUser",$Login_Texte);
	$template->Assign("TitreLogin",$TitreLogin);
	$template->Assign("TitreSQL",$TitreSQL);
	$template->Assign("Page_Titre",$Config_Titre);
	$template->Assign("Ppal_Titre",$Config_Titre);
	$template->Assign("TitreBouton",$BoutonMod);
	$template->assign("Langue_Used",$Langue_Used);
	$template->assign("Langue1",$Langue1);
	$template->assign("Langue2",$Langue2);
	$template->assign("Checked1",$Checked1);
	$template->assign("Checked2",$Checked2);
}  //Fin InSession
else
{
//On est pas en session
	$NomPage='../templates/protege.tpl';
	$template->assign("Protected_Area",$Protected_Area);
}	
//On affiche la page
$template->Assign("VersionNum",$VersionNum);
$template->assign("CheminIndex","../index.php");
$template->assign("LIndex",$LIndex);
$template->display($NomPage);
?>