<?php
/*
  Version  : 1.2 R3
  Date de modification :21 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : presentation.php
  Fonction : affiche les catégories et les appareils.
*/
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  require("../include/smarty.class.php");
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  $Langue=$Langue_Sys;
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
    default :  include "../include/LangueFR.inc.php";
               $Lang="F";
  }
  if (!isset($_GET["Tri"]))
  {
    $Choix=1;
  }
  else
  {
	  $Choix=$_GET["Tri"];
  }
  switch($Choix)
  {
    case 1 : $SQLS="SELECT PK_APPAREIL AS cle, NOM_TAPP AS NOM FROM t_appareil ORDER BY NOM_TAPP";
             break;
    case 2 : $SQLS="SELECT PK_PERIODE AS cle, NOM_PERIODE AS NOM FROM t_periode ORDER BY NOM_PERIODE";
             break;
    case 3 : $SQLS="SELECT PK_MARQUE AS cle, NOM_MARQUE AS NOM FROM t_marque ORDER BY NOM_MARQUE";
             break;
  }
//Connexion à la base de données
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
		die();
	//fin redirection*********************************************************************************************
  }
  $template->assign('MesCams',$MesCams);
//Ici on traite
  $template->assign('Choix',$Choix);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('TabApp',$tabresult);
  $template->assign('DisplayOrdered',$DisplayOrdered);
  $template->assign('KindCam',$KindCam);
  $template->assign('PeriodeC',$PeriodeC);
  $template->assign('BrandDev',$BrandDev);
  $template->assign('Display',$Display);
  $template->assign('Retour',$Retour);
//Pied de page
  $template->assign('CheminIndex','index.php');
  $template->assign('VersionNum',$VersionNum);
  $template->assign('LIndex',$LIndex);
  $template->display($CheminTpl.'presentation.tpl');
?>
