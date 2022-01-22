<?php

  /*
  Version  : 1.2 R3
  Date de modification : 21 avril 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : export.php
  Fonction : Exporte les données de la base en XML.
*/
session_start();
//Inclusion
include "../include/config.inc.php";
include "../include/function.inc.php";
//Recuperation des variables et mises en forme
require("../include/smarty.class.php");
$template=new Smarty();
$Lang=$Langue_Sys;
switch ($Lang)
{
case "F" : include "../include/LangueFR.inc.php";
		   break;
case "E" : include "../include/LangueEN.inc.php";
		   break;
default :  include "../include/LangueFR.inc.php";
		   $Lang="F";
		   break;
}
if (isset($_SESSION['InSession_Photo']))
{
	$NomPage='../templates/export.tpl';
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
	// Creation du tableau d'extraction
	$ListeXML=array(0=>'pays',1=>'periode',2=>'materiel',3=>'film',4=>'format',5=>'appareil',6=>'monture',7=>'obturateur',8=>'marque',9=>'item');
	$ListeSQL=array();
	$ListeSQL[0]='SELECT PK_PAYS AS KEY_GEN,NOM_PAYS AS NOM_GEN FROM t_pays ORDER BY NOM_PAYS';
	$ListeSQL[1]='SELECT PK_PERIODE AS KEY_GEN,NOM_PERIODE AS NOM_GEN FROM t_periode ORDER BY NOM_PERIODE';
	$ListeSQL[2]='SELECT PK_TMAT AS KEY_GEN,NOM_MAT AS NOM_GEN FROM t_materiel ORDER BY NOM_MAT';
	$ListeSQL[3]='SELECT PK_FILM AS KEY_GEN,NOM_FILM AS NOM_GEN FROM t_film ORDER BY NOM_FILM';
	$ListeSQL[4]='SELECT PK_FORMAT AS KEY_GEN,NOM_FORMAT AS NOM_GEN FROM t_format ORDER BY NOM_FORMAT';
	$ListeSQL[5]='SELECT PK_APPAREIL AS KEY_GEN, NOM_TAPP AS NOM_GEN, DESC_APP AS DESC_GEN FROM t_appareil ORDER BY NOM_TAPP';
	$ListeSQL[6]='SELECT PK_MONTURE AS KEY_GEN, NOM_MONTURE AS NOM_GEN, DESC_MONTURE AS DESC_GEN FROM t_monture ORDER BY NOM_MONTURE';
	$ListeSQL[7]='SELECT PK_OBTU AS KEY_GEN, NOM_OBTU AS NOM_GEN, DESC_OBTU AS DESC_GEN FROM t_obturateur ORDER BY NOM_OBTU';
	$ListeSQL[8]='SELECT PK_MARQUE AS KEY_GEN, NOM_MARQUE AS NOM_GEN, FK_PAYS, HIST_MARQUE FROM t_marque ORDER BY NOM_MARQUE';
	$ListeSQL[9]='SELECT REF_INV, FK_MARQUE, FK_FILM, FK_APP, FK_MAT, FK_OBTU, FK_MONTURE, FK_FORMAT, FK_PERIODE, ANNEE_PROD, PHOTOS, NOM_ITEM, PRIX_ACHAT, ETAT, HIST_ITEM, NOTES_PERSO FROM t_item ORDER BY NOM_ITEM';
	$Liste_Champ[0][0]='ID_Pays';
	$Liste_Champ[0][1]='Nom_Pays';
	$Liste_Champ[1][0]='ID_Periode';
	$Liste_Champ[1][1]='Nom_Periode';
	$Liste_Champ[2][0]='ID_Materiel';
	$Liste_Champ[2][1]='Nom_Materiel';
	$Liste_Champ[3][0]='ID_Film';
	$Liste_Champ[3][1]='Nom_Film';
	$Liste_Champ[4][0]='ID_Format';
	$Liste_Champ[4][1]='Nom_Format';
	//3 champs
	$Liste_Champ[5][0]='ID_Appareil';
	$Liste_Champ[5][1]='Nom_Apapreil';
	$Liste_Champ[5][2]='Description_Apapreil';
	$Liste_Champ[6][0]='ID_Monture';
	$Liste_Champ[6][1]='Nom_Monture';
	$Liste_Champ[6][2]='Description_Monture';
	$Liste_Champ[7][0]='ID_Obturateur';
	$Liste_Champ[7][1]='Nom_Obturateur';
	$Liste_Champ[7][2]='Description_Obturateur';
	//Autres
	$Liste_Champ[8][0]='ID_Marque';
	$Liste_Champ[8][1]='Nom_Marque';
	$Liste_Champ[8][2]='Ref_Pays';
	$Liste_Champ[8][3]='Historique_Marque';
	$Liste_Champ[9][0]='ID_Item';
	$Liste_Champ[9][1]='Ref_Marque';
	$Liste_Champ[9][2]='Ref_Film';
	$Liste_Champ[9][3]='Ref_Appareil';
	$Liste_Champ[9][4]='Ref_Materiel';
	$Liste_Champ[9][5]='Ref_Obturateur';
	$Liste_Champ[9][6]='Ref_Monture';
	$Liste_Champ[9][7]='Ref_Format';
	$Liste_Champ[9][8]='Ref_Periode';
	$Liste_Champ[9][9]='Annee_Prod';
	$Liste_Champ[9][10]='Photos_Item';
	$Liste_Champ[9][11]='Nom_Item';
	$Liste_Champ[9][12]='Prix_Achat';
	$Liste_Champ[9][13]='Etat_Item';
	$Liste_Champ[9][14]='Historique_Item';
	$Liste_Champ[9][15]='Notes_perso';
	//Premier Fichier XML Pays
	$xml = new XMLWriter();
	$xml->openURI('../base.xml');
	$xml->setIndent(true);
	$xml->StartDocument('1.0','utf-8');
	$xml->StartElement(utf8_encode('Liste_Globale'));
	//Recuperation des info
	for ($j=0;$j<10;$j++)
	{
	$xml->StartElement(utf8_encode($ListeXML[$j]));
	$SQLS=$ListeSQL[$j];
	$i=0;
	foreach($connecter->query($SQLS) as $row)
	{
	   if ($j<5)
	   {
		 $xml->StartElement(utf8_encode($ListeXML[$j].$i));
		 //echo "<p>$ID1,$ID2</p>";
		 $xml->WriteElement(utf8_encode($Liste_Champ[$j][0]), utf8_encode($row["KEY_GEN"]));
	   $xml->WriteElement(utf8_encode($Liste_Champ[$j][1]) , utf8_encode($row["NOM_GEN"]));
		 $xml->EndElement();
		 $i++;
		}
		if (($j>4) AND($j<8))
	   {
		 $xml->StartElement($ListeXML[$j].$i);
		 $ID1=$Liste_Champ[$j][0];
		 $xml->WriteElement(utf8_encode($Liste_Champ[$j][0]) , utf8_encode($row["KEY_GEN"]));
		 $xml->WriteElement(utf8_encode($Liste_Champ[$j][1]) , utf8_encode($row["NOM_GEN"]));
		 $xml->WriteElement(utf8_encode($Liste_Champ[$j][2]) , utf8_encode($row["DESC_GEN"]));
		 $xml->EndElement();
		 $i++;
		}
		if ($j==8)
		{
		  $xml->StartElement($ListeXML[$j].$i);
		  $ID1=$Liste_Champ[$j][0];
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][0]) , utf8_encode($row["KEY_GEN"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][1]) , utf8_encode($row["NOM_GEN"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][2]) , utf8_encode($row["FK_PAYS"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][3]) , utf8_encode($row["HIST_MARQUE"]));
		  $xml->EndElement();
		  $i++;
		}
		if ($j==9)
		{
		  $xml->StartElement($ListeXML[$j].$i);
		  $ID1=$Liste_Champ[$j][0];
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][1]) , utf8_encode($row["FK_MARQUE"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][2]) , utf8_encode($row["FK_FILM"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][3]) , utf8_encode($row["FK_APP"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][4]) , utf8_encode($row["FK_MAT"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][5]) , utf8_encode($row["FK_OBTU"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][6]) , utf8_encode($row["FK_MONTURE"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][7]) , utf8_encode($row["FK_FORMAT"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][8]) , utf8_encode($row["FK_PERIODE"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][9]) , utf8_encode($row["ANNEE_PROD"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][10]) , utf8_encode($row["PHOTOS"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][11]) , utf8_encode($row["NOM_ITEM"]));
		  $xml->WriteElement(utf8_encode($Liste_Champ[$j][14]) , utf8_encode($row["HIST_ITEM"]));
		  if($PrivateUse)
		  {
			$xml->WriteElement(utf8_encode($Liste_Champ[$j][0]) , utf8_encode($row["REF_INV"]));
			$xml->WriteElement(utf8_encode($Liste_Champ[$j][12]) , utf8_encode($row["PRIX_ACHAT"]));
			$xml->WriteElement(utf8_encode($Liste_Champ[$j][13]) , utf8_encode($row["ETAT"]));
			$xml->WriteElement(utf8_encode($Liste_Champ[$j][15]) , utf8_encode($row["NOTES_PERSO"]));
		  }
		  $xml->EndElement();
		  $i++;
		}
	 }

	$xml->EndElement();
	}
	$xml->EndElement();
	$OK=$xml->Flush();
	if($OK)
	{
		$template->assign('ResultatExport',$ResultatExport);
		$template->assign('XML_File',$XML_File);
	}
	else
	{
		$template->assign('ResultatExport',$ResultatExportFailed);	
	}
	$template->assign('ResultatExport',$ResultatExport);
	$template->assign('Export_Datas',$Export_Datas);
}
else  
{
  //On est pas en session
	$NomPage='../templates/protege.tpl';
	$template->assign("Protected_Area",$Protected_Area);	
}
$template->assign("VersionNum",$VersionNum);
$template->assign("CheminIndex","index.php");
$template->assign("LIndex",$Retour);
$template->display($NomPage);
?>