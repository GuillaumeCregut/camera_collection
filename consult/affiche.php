<?php
/*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : affiche.php
  Fonction : Affiche le sous dossier provenant de presentation.php.
*/
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  require("../include/smarty.class.php");
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  //Gestion des erreurs
  $Erreur=false;
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
  if (isset($_GET["TypePage"]))
  {
	$TypeRech=$_GET["TypePage"];
	//echo "<p>Type OK : $TypeRech</p>";
  }
  else
  {
	 $Erreur=true; 
	// echo "<p>indice 1</p>";
  }
  if (isset($_GET["Cle"]))
  {
	$CleRech=$_GET["Cle"];
	//echo "<p>Cle OK : $CleRech</p>";
   }
  else
  {
	 $Erreur=true; 
	// echo "<p>indice 2</p>";
  }
  if (isset($_GET["LeNom"]))
  {
	$NomAff=$_GET["LeNom"];
   }
  else
  {
	 $Erreur=true; 
  }
  if ($Erreur===true)
  {
	$template->assign('Erreur_Base',$Erreur_Num_Page);
	$template->assign('CheminIndex',$CheminIndex);
	$template->assign('VersionNum',$VersionNum);
	$template->assign('LIndex',$LIndex);
	$template->display($CheminTpl.'erreur_base.tpl');
	exit();
  }
  else
  {
	  //
	$template->assign('DisplayOf',$DisplayOf);
	$template->assign('NomAff',$NomAff);
	$template->assign('Lang',$Lang);
	$CleRech=(int)$CleRech;
	$SQLS="SELECT REF_INV AS REFERENCE,NOM_ITEM AS NOM,PHOTOS FROM t_item WHERE ";
	$Erreur=false;
	if (isset($TypeRech))
	{
		switch ($TypeRech)
		{
			case 1 : $SQLS2="FK_APP=$CleRech";
					break;
			case 2 : $SQLS2="FK_PERIODE=$CleRech";
					break;
			case 3 : $SQLS2="FK_MARQUE=$CleRech";
					break;
			default : $Erreur=true;
		}
	}
	if($Erreur)
	{
		$template->assign('Erreur_Base',$Erreur_Num_Page);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');
		exit();
	}
	$SQLS.=$SQLS2;
	//Connexion a a base de données
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
	//Création du tableau à transmettre à la page web;
	$CompteurTab=0;
    foreach($connecter->query($SQLS) as $row)
    {
  //A mettre au bon endroit
		$LaCle=$row["REFERENCE"];
		$TabResultat[$CompteurTab]['cle']=$LaCle;
		$TabResultat[$CompteurTab]['type']=10;
		$LaPhoto=$row["PHOTOS"];
		$pos = strpos($LaPhoto, ';');
		$LaPhoto=substr($LaPhoto,$pos+1,200);
    //$LaPhoto.="mini.jpg";
		$BasePhoto="../photos/";
		$CheminPhoto=$BasePhoto.$LaPhoto;
    //On essai de voir si le fichier mini existe
		if (!file_exists($CheminPhoto."mini.jpg"))
		{
      //Sinon on la crée.
			if (file_exists($CheminPhoto."1.jpg"))
			{
				$ImageMini=imagecreatefromjpeg($CheminPhoto."1.jpg");
				$size=getimagesize($CheminPhoto."1.jpg");
				$Larg=$size[0];
				$Long=$size[1];
				$Larg=$Larg*20/100;
				$Long=$Long*20/100;
				$imgdest = imagecreatetruecolor($Larg,$Long);
				$copy=imagecopyresampled($imgdest,$ImageMini,0,0,0,0,$Larg,$Long,$size[0],$size[1]);
				imagejpeg($imgdest,$CheminPhoto."mini.jpg");
				imagedestroy($imgdest);
				imagedestroy($ImageMini);
			}
			else
			{
				$CheminPhoto="../include/images/noimg-"; 
			}
		}
		$CheminPhoto.="mini.jpg";
		$TabResultat[$CompteurTab]['chemin']= $CheminPhoto;
		$TabResultat[$CompteurTab]['nom']=$row["NOM"];
		$CompteurTab++;
	}  //Fin du foreach
  //affectation du tableau
	if (isset($TabResultat))
		$template->assign('liste_infos',$TabResultat);
	else
	{
		$template->assign('AucunRes',$AucunRes);
	}
//Fin traitement
	$template->assign('TypeRech',$TypeRech);
	$template->assign('VersionNum',$VersionNum);
	$template->assign('Retour',$Retour);
	//Assignation de la page web
	$template->display($CheminTpl.'affiche.tpl');
  //Fin du else de test d'erreur.
  }
?>

