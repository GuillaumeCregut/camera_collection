<?php
/*
  Version  : 1.2 R3
  Date de modification : 20 Mai 2018.
  Valid� fonctionnelle : Oui
  Valid� W3C : Oui
  Nom : appareil.php
  Fonction : Recherche des appareils par crit�res.
*/
  session_start();
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  require("../include/Smarty.class.php");
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  $Langue=$Langue_Sys;
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
//Connexion � la base de donn�es
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
  $template->assign('RechApp',$RechApp);
  $template->assign('HowUseIt',$HowUseIt);

  if (isset($_SESSION['InSession_Photo'])) 
  {
    $template->assign('RefInv',$RefInv);
  }
  
  //SQL  Materiel
  $SQLS="SELECT PK_TMAT, NOM_MAT FROM t_materiel ORDER BY NOM_MAT";
  $template->assign('KindMat',$KindMat);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_mat',$tabresult);
  $template->assign('NameDev',$NameDev);
  
  //SQL Marque
  $SQLS="SELECT PK_MARQUE, NOM_MARQUE FROM t_marque ORDER BY NOM_MARQUE";
  $template->assign('BrandDev',$BrandDev);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_marque',$tabresult);
  
  //Categorie
  $SQLS="SELECT PK_APPAREIL, NOM_TAPP FROM t_appareil ORDER BY NOM_TAPP"; 
  $template->assign('KindCam',$KindCam);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_kind',$tabresult);
  
  //Format
  $SQLS="SELECT PK_FORMAT, NOM_FORMAT FROM t_format ORDER BY NOM_FORMAT";
  $template->assign('FormatCam',$FormatCam);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_format',$tabresult);
  
  //Film
  $SQLS="SELECT PK_FILM, NOM_FILM FROM t_film ORDER BY NOM_FILM";
  $template->assign('KindFilm',$KindFilm);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_film',$tabresult);
  
  //Periode
  $SQLS="SELECT PK_PERIODE, NOM_PERIODE FROM t_periode ORDER BY NOM_PERIODE";
  $template->assign('PeriodeC',$PeriodeC);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_periode',$tabresult);
  
  //Obturateurs
  $SQLS="SELECT PK_OBTU, NOM_OBTU FROM t_obturateur ORDER BY NOM_OBTU";
  $template->assign('ShutterCam',$ShutterCam);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_obtu',$tabresult);
  
  //Monture
  $SQLS="SELECT PK_MONTURE, NOM_MONTURE FROM t_monture ORDER BY NOM_MONTURE"; 
  $template->assign('LensMount',$LensMount);
  $sth=$connecter->prepare($SQLS);
  $sth->execute();
  $tabresult= $sth->fetchAll();
  $template->assign('list_mount',$tabresult);
  if (isset($_SESSION['InSession_Photo'])) //A g�rer autrement
  {
	$template->assign('StateCam',$StateCam);
    $template->assign('Mint',$Mint);
    $template->assign('Good',$Good);
    $template->assign('CLA',$CLA);
    $template->assign('Restore',$Restore);
    $template->assign('Wretch',$Wretch);
  }
  $template->assign('Search',$Search);
  $template->assign('Fermer',$Fermer);
  $template->assign('CheminIndex','search.php');
  $template->assign('LIndex',$LIndex);
  $template->assign("VersionNum",$VersionNum);
  $template->display($CheminTpl.'rech_appareil.tpl'); 
?>
