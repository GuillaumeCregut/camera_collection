<?php
  /*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : dodouble.php
  Fonction : Modifie en BDD ce qui est double.
*/
session_start();
$DebugMode=false;
//include files
include "../include/config.inc.php";
include "../include/function.inc.php";
require("../include/smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
$Langage=$Langue_Sys;
if (isset($_POST["faire"]))
{
$Action=$_POST["faire"]; //Que faire : add;supp;mod
}
else 
{
  $Action=-1;
}
if (isset($_POST["Nom_Item"]))
{
$NouvNom=$_POST["Nom_Item"];//Nouveau nom
}
else
{
  $NouvNom="";
}
if (get_magic_quotes_gpc()==1)
{
$NouvNom=addslashes($NouvNom);//Nouveau nom
}
if(isset($_POST["LasDesc"]))
{
$NouvDesc=$_POST["LasDesc"]; //Pour Double
}
else
{
  $NouvDesc="";
}
if(isset($_POST["AncienFichier"]))
{
$OldFile=$_POST["AncienFichier"];
}
else
{
  $OldFile="";
}
if(isset($_POST["TheItem"]))
{
$Key=$_POST["TheItem"]; //Cle Primaire
}
else
{
  $Key=-1;
}
if(isset($_POST["Type_Page"]))
{
$Type_Page=$_POST["Type_Page"]; //Numero de page
}
else
{
  $Type_Page=-1;
}



if (isset($_SESSION['InSession_Photo']))
{ 
	if($Type_Page==-1)
	{
	  //Gestion page d'erreur
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit(); 
	  //
	}
	$NomPage=$CheminTpl.'dodouble_gest.tpl';
	include "../include/typepage$Type_Page.php";
	switch ($Langage)
	{
	case "F" : include "../include/LangueFR.inc.php";
			   $Titre1Page=$TitrePageF;
			   $EndGood="Modification correctement effectu&eacute;e";
			   break;
	case "E" : include "../include/LangueEN.inc.php";
			   $Titre1Page=$TitrePageE;
			   $EndGood="Item has been changed successfully";
			   break;
	}
	$template->assign("Mgmt",$Mgmt);
	$template->assign("Titre1Page",$Titre1Page);
	switch($Type_Page)
	{
		case 6 : $Repertoire=$EnteteRep."obturateurs/";
			 break;
		case 7 : $Repertoire=$EnteteRep."montures/";
			 break;
		case 8 : $Repertoire=$EnteteRep."typeapps/";
			 break;
	}
	//Requetes
	//Creation du champ3, chemin vers le fichier :
	$TempChamp3=strtolower($NouvNom);//Passe en minuscule
	$LeChamp3=str_replace(" ","",$TempChamp3);
	//Ajout 1.2R2 : Suppression des accents et des caractères spéciaux.
	$LeChamp3=preg_replace( '#[^A-Za-z0-9-]+#' ,'',$LeChamp3);
	/// 
	$NewFile=$Repertoire.$LeChamp3.".txt";
	//Ajout dans la base
	$SQLAdd="INSERT INTO $NomTable ($Champ2,$Champ3) VALUES ('$NouvNom','$LeChamp3');"; //Valable pour les double
	//Suppression dans la base
	if (isset ($Key))
	{
		$SQLDel="DELETE FROM $NomTable WHERE $Champ1=$Key"; //valable pour tous
	//Modification de la table
		$SQLMod="UPDATE $NomTable SET $Champ2='$NouvNom', $Champ3='$LeChamp3' WHERE $Champ1=$Key"; //valable pour les single
	}
	else
	{
	$SQLDel="";
	$SQLMod="";
	}
	if ($DebugMode)
	{
		$couleur="yellow";
		echo "<div align=\"center\"><table border=\"1\" bgcolor=\"blue\">\n";
		echo "<tr><td bgcolor=\"green\">\n";
		echo "<H1>Debug Mode ON</H1>\n";
		echo "<p>Langage : <font color=\"$couleur\">\"$Langage\"</font></p>\n";
		echo "<p>Action : <font color=\"$couleur\">\"$Action\"</font></p>\n";
		echo "<p>Numéro page : <font color=\"$couleur\">\"$Type_Page\"</font></p>\n";
		echo "<p>Description : <br><font color=\"$couleur\">\"".nl2br($NouvDesc)."\"</font></p>\n";
		echo "<p>SQL add :<font color=\"$couleur\">$SQLAdd</font></p>\n";
		echo "<p>SQL supp :<font color=\"$couleur\">$SQLDel</font></p>\n";
		echo "<p>SQL mod :<font color=\"$couleur\">$SQLMod</font></p>\n";
		echo "<p>Ancien nom de fichier : <font color=\"$couleur\">$LeChamp3</font></p>";
		echo "<p>Old File : <font color=\"$couleur\">$OldFile</font></p>";
		echo "<p>New File : <font color=\"$couleur\">$NewFile</font></p>";
		echo "<p>EndGood : <font color=\"$couleur\">$EndGood</font></p>\n";
	}
	//Agir en fonction.
	$SQLS="";
	switch ($Action)
	{
		case 1 : $SQLS=$SQLAdd;//Ajouter
			 //Creer fichier
			 CreeFichier($NewFile,$NouvDesc);
			 break;
		case 2 : $SQLS=$SQLMod;//Modifier
			 //Supprimer fichier puis recréer
			 DetruitFichier($OldFile);
			 CreeFichier($NewFile,$NouvDesc);
			 break;
		case 3 : $SQLS=$SQLDel;//Supprimer
			 //Supprimer fichier
			 DetruitFichier($OldFile);
			 break;
	}
	$OK=FALSE;
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
	$sth=$connecter->prepare($SQLS);
	$OK=$sth->execute();
	if (!$OK)
	{
		$template->assign("Error","erreur");
		$template->assign("Erreur",$Erreur);
		$Message=$sth->errorInfo();
		$Erreur_Msg=$Erreur." N° ".$sth->errorCode()." : ".$Message[2];
		$template->assign("Error_msg",$Erreur_Msg);
		$template->assign("SQLS",$SQLS);
	}
	else
	{
		$template->assign("EndGood",$EndGood);
	}
	if ($DebugMode)
	{
		echo "<p>Requete : <font color=\"$couleur\">$SQLS</font></p>\n";
		echo "<p>Fin de debug mode</p>\n";
		echo "</td></tr></table></div>\n";
	}
	$CheminBack="double.php?NumPage=$Type_Page";
	$Lien=$Retour;
	$LeChemin=$CheminBack;
}//Fin if session
else
{
	switch ($Langage)
	{
		case "F" : include "../include/LangueFR.inc.php";
				break;
		case "E" : include "../include/LangueEN.inc.php";
				break;
	}
	$NomPage='../templates/protege.tpl';
	$Lien=$LIndex;
	$LeChemin=$CheminIndex;
	$template->assign("Protected_Area",$Protected_Area);
}
$CheminBack="double.php?Language=$Langage&NumPage=$Type_Page";
$template->assign('VersionNum',$VersionNum);
$template->assign("CheminIndex",$LeChemin);
$template->assign("LIndex",$Lien);
$template->display($NomPage);

?>