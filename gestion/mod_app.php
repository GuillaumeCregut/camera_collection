<?php
  /*
  Version  : 1.2 R3
  Date de modification : 17 Mai 2018.
  Validé fonctionnelle : non
  Validé W3C : non
  Nom : modapp.php
  Fonction : Affiche les informations d'un appareil afin de les modifier.
*/
//include files
session_start();
include "../include/config.inc.php";
include "../include/function.inc.php";
include "../include/typepage10.php";
$Langue=$Langue_Sys;
require("../include/smarty.class.php");
$template=new Smarty(); 
$CheminTpl='../templates/';
if(isset($_POST["ref_app"]))
{
$valeur=$_POST["ref_app"];
}
else
{
  $valeur=-1;
}
//inclusion des fichiers
$Lapagedemande="../consult/appareil.php";
switch ($Langue)
{
case "F" : include "../include/LangueFR.inc.php";
		   $Titre1Page=$TitrePageF;
		 //  $LeItemPage=$LeItemPageF;  //16/05/2018
		   break;
case "E" : include "../include/LangueEN.inc.php";
		   $Titre1Page=$TitrePageE;
		 //  $LeItemPage=$LeItemPageE; //concerne le textarea//16/05/2018
		   break;
}
if (isset($_SESSION['InSession_Photo']))
{
	if($valeur==-1)
	{
	  //Erreur
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit(); 
	}
	$NomFichier=$CheminTpl.'mode_app_gest.tpl';
	$Repertoire=$EnteteRep.$NomRepItem;
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
	$template->assign("ModifApp",$ModifApp);
	//Récupération des valeurs de l'appareil.
	$SQLS="SELECT Ref_inv,FK_Marque,FK_Film,FK_App,FK_Mat,FK_Obtu,FK_Monture,FK_Format,FK_Periode,Annee_Prod,Photos,Nom_Item, Prix_Achat,Etat,Hist_Item,Notes_Perso FROM t_item WHERE Ref_inv='$valeur'";
	$OK=FALSE;
	$sth=$connecter->prepare($SQLS);
	$OK=$sth->execute();
	$tabresult= $sth->fetchAll();
	if (!$OK)
	{
		$template->assign("Error","erreur");
		$template->assign("Erreur",$Erreur);
		$Message=$sth->errorInfo();
		$Erreur_Msg=$Erreur." N° ".$sth->errorCode()." : ".$Message[2];
		$template->assign("Error_msg",$Erreur_Msg);
		$template->assign("SQLS",$SQLS);
		$template->assign("BoutonMod",$BoutonMod);
		$template->assign("LIndex",$LIndex);
		$template->assign("CheminIndex",$CheminIndex);
		$template->assign("VersionNum",$VersionNum);
		$template->display($CheminTpl.'mode_app_gest.tpl');
		exit();
	}
	else
	{
			foreach($tabresult as $row)
			{
					$LaMarque=$row["FK_Marque"];
					$LeFilm=$row["FK_Film"];
					$LeApp=$row["FK_App"];
					$LeMat=$row["FK_Mat"];
					$Lobtu=$row["FK_Obtu"];
					$LaMonture=$row["FK_Monture"];
					$LeFormat=$row["FK_Format"];
					$LaPeriode=$row["FK_Periode"];
					$AnneProd=$row["Annee_Prod"];
					$LesPhotos=$row["Photos"];
					$LeNomI=$row["Nom_Item"];
					$lePrix=$row["Prix_Achat"];
					$Letat=$row["Etat"];
					$Hist=$row["Hist_Item"];
					$NotesP=$row["Notes_Perso"];
			}
			$DebugMode=false;
			if ($DebugMode)
			{
				echo "<p>$LaMarque</p>\n";
				echo "<p>$LeFilm</p>\n";
				echo "<p>$LeApp</p>\n";
				echo "<p>$LeMat</p>\n";
				echo "<p>$Lobtu</p>\n";
				echo "<p>$LaMonture</p>\n";
				echo "<p>$LeFormat</p>\n";
				echo "<p>$LaPeriode</p>\n";
				echo "<p>$AnneProd</p>\n";
				echo "<p>$LesPhotos</p>\n";
				echo "<p>$LeNomI</p>\n";
				echo "<p>$lePrix</p>\n";
				echo "<p>$Letat</p>\n";
				echo "<p>$Hist</p>\n";
				echo "<p>$NotesP</p>\n";
			}
	//Affichage des informations.

			$template->assign("Langue",$Langue);
			$template->assign("valeur",$valeur);
			if ($PrivateUse)
			{
				$template->assign("PrivateUse",$PrivateUse);
				$template->assign("RefInv",$RefInv);
			}
	//SQL  Materiel
		$SQLS="SELECT PK_TMAT, NOM_MAT FROM t_materiel ORDER BY NOM_MAT";
		$template->assign("KindMat",$KindMat);
		$OK=FALSE;
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabMat[$i]["PK_TMAT"] =$row["PK_TMAT"];
			$checked="";
			if ($row["PK_TMAT"]==$LeMat)
			{
				$checked="selected";
			}
			$tabMat[$i]["IsChecked"]=$checked;
			$tabMat[$i]["NOM_MAT"]=$row["NOM_MAT"];
			$i++;
		}
		$template->assign("TabMat",$tabMat);
	//fin Materiel
		$template->assign("NameDev",$NameDev);
		$template->assign("LeNom",$LeNomI);
		$template->assign("Lapagedemande",$Lapagedemande);
		$template->assign("Langue",$Langue);
		$template->assign("ExisteIl",$ExisteIl);

	//SQL Marque
		$SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM t_marque ORDER BY NOM_MARQUE";
		$template->assign("BrandDev",$BrandDev);
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabMarque[$i]["PK_MARQUE"] =$row["PK_MARQUE"];
			$checked="";
			if ($row["PK_MARQUE"]==$LaMarque)
			{
				$checked="selected";
			}
			$tabMarque[$i]["IsChecked"]=$checked;
			$tabMarque[$i]["NOM_MARQUE"]=$row["NOM_MARQUE"];
			$i++;
		}
		$template->assign("TabMarque",$tabMarque);

	//Categorie
		$SQLS="SELECT PK_APPAREIL, NOM_TAPP FROM t_appareil ORDER BY NOM_TAPP";
		$template->assign("KindCam",$KindCam);
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabTApp[$i]["PK_APPAREIL"] =$row["PK_APPAREIL"];
			$checked="";
			if ($row["PK_APPAREIL"]==$LeApp)
			{
				$checked="selected";
			}
			$tabTApp[$i]["IsChecked"]=$checked;
			$tabTApp[$i]["NOM_TAPP"]=$row["NOM_TAPP"];
			$i++;
		}
		$template->assign("TabTapp",$tabTApp);

	//Format
		$SQLS="SELECT PK_FORMAT, NOM_FORMAT FROM t_format ORDER BY NOM_FORMAT";
		$template->assign("FormatCam",$FormatCam);
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabFormat[$i]["PK_FORMAT"] =$row["PK_FORMAT"];
			$checked="";
			if ($row["PK_FORMAT"]==$LeFormat)
			{
				$checked="selected";
			}
			$tabFormat[$i]["IsChecked"]=$checked;
			$tabFormat[$i]["NOM_FORMAT"]=$row["NOM_FORMAT"];
			$i++;
		}
		$template->assign("TabFormat",$tabFormat);

	//Film
		$SQLS="SELECT PK_FILM, NOM_FILM FROM t_film ORDER BY NOM_FILM";
		$template->assign("KindFilm",$KindFilm);
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabFilm[$i]["PK_FILM"] =$row["PK_FILM"];
			$checked="";
			if ($row["PK_FILM"]==$LeFilm)
			{
				$checked="selected";
			}
			$tabFilm[$i]["IsChecked"]=$checked;
			$tabFilm[$i]["NOM_FILM"]=$row["NOM_FILM"];
			$i++;
		}
		$template->assign("TabFilm",$tabFilm);
	//Fin film	
		$AnneProd=substr($AnneProd,0,4);
		$template->assign("YearConst",$YearConst);
		$template->assign("AnneProd",$AnneProd);


	//Periode
		$SQLS="SELECT PK_PERIODE, NOM_PERIODE FROM t_periode ORDER BY NOM_PERIODE";
		$template->assign("PeriodeC",$PeriodeC);
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabPeriode[$i]["PK_PERIODE"] =$row["PK_PERIODE"];
			$checked="";
			if ($row["PK_PERIODE"]==$LaPeriode)
			{
				$checked="selected";
			}
			$tabPeriode[$i]["IsChecked"]=$checked;
			$tabPeriode[$i]["NOM_PERIODE"]=$row["NOM_PERIODE"];
			$i++;
		}
		$template->assign("TabPeriode",$tabPeriode);


	//Obturateurs
		$SQLS="SELECT PK_OBTU, NOM_OBTU FROM t_obturateur ORDER BY NOM_OBTU";
		$template->assign("ShutterCam",$ShutterCam);
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabObtu[$i]["PK_OBTU"] =$row["PK_OBTU"];
			$checked="";
			if ($row["PK_OBTU"]==$Lobtu)
			{
				$checked="selected";
			}
			$tabObtu[$i]["IsChecked"]=$checked;
			$tabObtu[$i]["NOM_OBTU"]=$row["NOM_OBTU"];
			$i++;
		}
		$template->assign("TabObtu",$tabObtu);


	//Monture
		$SQLS="SELECT PK_MONTURE, NOM_MONTURE FROM t_monture ORDER BY NOM_MONTURE";
		$template->assign("LensMount",$LensMount);
		$sth=$connecter->prepare($SQLS);
		$OK=$sth->execute();
		$tabresult= $sth->fetchAll();
		$i=0;
		foreach($tabresult as $row)
		{
			$tabMonture[$i]["PK_MONTURE"] =$row["PK_MONTURE"];
			$checked="";
			if ($row["PK_MONTURE"]==$LaMonture)
			{
				$checked="selected";
			}
			$tabMonture[$i]["IsChecked"]=$checked;
			$tabMonture[$i]["NOM_MONTURE"]=$row["NOM_MONTURE"];
			$i++;
		}
		$template->assign("TabMonture",$tabMonture);
		//Fin monture
		$template->assign("PhotoCam",$PhotoCam); 
		$template->assign("LesPhotos",$LesPhotos);
		if ($PrivateUse)
		{
			$template->assign("BuyPrice",$BuyPrice);
			$template->assign("lePrix",$lePrix);
			$template->assign("StateCam",$StateCam);
			$tab_etat[1]=$Mint;
			$tab_etat[2]=$Good;
			$tab_etat[3]=$CLA;
			$tab_etat[4]=$Restore;
			$tab_etat[5]=$Wretch;
			$i=0;
			foreach($tab_etat as $cle=>$donneeTab)
			{
				$IsChecked="";
				if ($cle==$Letat)
				{
					$IsChecked="checked";
				}
				$TabEtat[$i]["cle"]=$cle;
				$TabEtat[$i]["IsChecked"]=$IsChecked;
				$TabEtat[$i]["donneeTab"]=$donneeTab;
				$i++;
			}
			$template->assign("TabEtat",$TabEtat);
			$template->assign("PersNote",$PersNote);
			$NomFich=$Repertoire.$NotesP.'.txt';
			$fp=file_get_contents($NomFich);
			$fp=utf8_encode($fp);
			$template->assign("fp2",$fp);
		}
		$template->assign("InfoCam",$InfoCam);
		$NomFich=$Repertoire.$Hist.'.txt';
		$fp=file_get_contents($NomFich);
		$fp=utf8_encode($fp);
		$template->assign("fp1",$fp);
	}//fin else sql
	$template->assign("BoutonMod",$BoutonMod);
	$Lien=$LIndex;
	$LeChemin=$CheminIndex;
}//Fin if session
else
{
	//On est pas dans la session
	$NomFichier='../templates/protege.tpl';
	$Lien=$LIndex;
	$LeChemin=$CheminIndex;
	$template->assign("Protected_Area",$Protected_Area);
}
$template->assign("CheminIndex",$LeChemin);
$template->assign("VersionNum",$VersionNum);
$template->assign("LIndex",$Lien);
$template->display($NomFichier);
?>