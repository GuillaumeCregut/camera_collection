<?php
  /*
  Version  : 1.2 R3
  Date de modification : 22 Mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : appareil.php
  Fonction : gere les appareils.
*/
session_start();
$Lapagedemande="../consult/appareil.php";
//include files
include "../include/config.inc.php";
include "../include/function.inc.php";
include "../include/typepage10.php";
require("../include/smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
$Langue=$Langue_Sys;
switch ($Langue)
{
case "F" : include "../include/LangueFR.inc.php";
		   $Titre1Page=$TitrePageF;
		   break;
case "E" : include "../include/LangueEN.inc.php";
		   $Titre1Page=$TitrePageE;
		   break;
}
if (isset($_SESSION['InSession_Photo']))
{
	$NomFichier=$CheminTpl.'appareil_gest.tpl';
	$Repertoire=$EnteteRep.$NomRepItem;
	$template->assign("Mgmt",$Mgmt);
	$template->assign("TitreAppareils",$TitreAppareils);
	$template->assign("Langue",$Langue);
	$template->assign("StyleExist",$StyleExist);
	//Connexion à la base de données
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
	//Récupération de la liste des appareils existant et affichage
	$SQLS="SELECT REF_INV, NOM_ITEM,HIST_ITEM,NOTES_PERSO FROM t_item ORDER BY NOM_ITEM";  //$TabApp
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$i=0;
	foreach($tabresult as $row)
	{
	 $TabApp[$i]['CheminComplet1']=$Repertoire.$row["HIST_ITEM"].".txt";
	 $TabApp[$i]['CheminComplet2']=$Repertoire.$row["NOTES_PERSO"].".txt";
	 $TabApp[$i]["REF_INV"]=$row["REF_INV"];
	 $TabApp[$i]["NOM_ITEM"]=$row["NOM_ITEM"];
	 $i++;
	}
	$template->assign("TabApp",$TabApp);
	if ($PrivateUse)
	{
	$template->assign("Private_Use",'Private_Use');
	$template->assign("RefInv",$RefInv);
	$template->assign("GenID",$GenID);
	}

	//Type de Materiel
	$SQLS="SELECT PK_TMAT, NOM_MAT FROM t_materiel ORDER BY NOM_MAT";  //$TabMat
	$template->assign("KindMat",$KindMat);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabMat",$tabresult);

	//Marques
	$template->assign("NameDev",$NameDev);
	$template->assign("Lapagedemande",$Lapagedemande);
	$template->assign("ExisteIl",$ExisteIl);
	$SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM t_marque ORDER BY NOM_MARQUE"; //$TabMarque
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabMarque",$tabresult);
	$template->assign("BrandDev",$BrandDev);

	//Categorie
	$SQLS="SELECT PK_APPAREIL, NOM_TAPP FROM t_appareil ORDER BY NOM_TAPP";  //$TabCat
	$template->assign("KindCam",$KindCam);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabCat",$tabresult);

	//Format
	$SQLS="SELECT PK_FORMAT, NOM_FORMAT FROM t_format ORDER BY NOM_FORMAT";
	$template->assign("FormatCam",$FormatCam);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabForm",$tabresult);

	//Film
	$SQLS="SELECT PK_FILM, NOM_FILM FROM t_film ORDER BY NOM_FILM";  //TabFilm
	$template->assign("KindFilm",$KindFilm);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabFilm",$tabresult);
	$template->assign("YearConst",$YearConst);

	//Periode
	$SQLS="SELECT PK_PERIODE, NOM_PERIODE FROM t_periode ORDER BY NOM_PERIODE";  //TabPeriode
	$template->assign("PeriodeC",$PeriodeC);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabPeriode",$tabresult);
	$template->assign("YearConst",$YearConst);

	//Obturateurs
	$SQLS="SELECT PK_OBTU, NOM_OBTU FROM t_obturateur ORDER BY NOM_OBTU"; //TabObtu
	$template->assign("ShutterCam",$ShutterCam);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabObtu",$tabresult);
	$template->assign("YearConst",$YearConst);

	//Monture
	$SQLS="SELECT PK_MONTURE, NOM_MONTURE FROM t_monture ORDER BY NOM_MONTURE";  //TabMont

	$template->assign("LensMount",$LensMount);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$template->assign("TabMont",$tabresult);
	$template->assign("YearConst",$YearConst);

	$template->assign("PhotoCam",$PhotoCam);
	if ($PrivateUse)
	{
	$template->assign("BuyPrice",$BuyPrice);
	$template->assign("StateCam",$StateCam);
	$template->assign("Mint",$Mint);
	$template->assign("Good",$Good);
	$template->assign("CLA",$CLA);
	$template->assign("Restore",$Restore);
	$template->assign("Wretch",$Wretch);
	}
	$template->assign("InfoCam",$InfoCam);
	if ($PrivateUse)
	{
	$template->assign("PersNote",$PersNote);
	}
	$template->assign("BoutonSupp",$BoutonSupp);
	$template->assign("BoutonMod",$BoutonMod);
	$template->assign("BoutonAdd",$BoutonAdd);
} //fin if session
else
{
	//On est pas en session
	$NomFichier='../templates/protege.tpl';
	$template->assign("Protected_Area",$Protected_Area);
}
	$template->assign("CheminIndex",$CheminIndex);
	$template->assign("LIndex",$LIndex);
	$template->assign("VersionNum",$VersionNum);
	$template->display($NomFichier);
?>