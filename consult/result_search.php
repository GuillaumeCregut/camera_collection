<?php
 /*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Valid� fonctionnelle : Oui
  Valid� W3C : oui
  Nom : result_search.php
  Fonction : affiche les resultats par rapport a search_name.
*/
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  require("../include/Smarty.class.php");
  $Langue=$Langue_Sys;
  if (isset($_POST["NumPage"]))
  {
	$LaPage=$_POST["NumPage"];
  }
  else
  {
	$template->assign('Erreur_Base',$Erreur_Num_Page);
	$template->assign('CheminIndex',$CheminIndex);
	$template->assign('VersionNum',$VersionNum);
	$template->assign('LIndex',$LIndex);
	$template->display($CheminTpl.'erreur_base.tpl');	  
	exit();
  }
  if (isset($_POST["nom_rech"]))
  {
	$LeNomRech=$_POST["nom_rech"];
  }
  else
  {
	  $LeNomRech='';
  }
 
  $template=new Smarty(); 
  $CheminTpl='../templates/';
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               break;
  }
  $Erreur=false;
  switch ($LaPage)
  {
    case 1 :  $TitreRech=$Pays;
              break;
    case 2 :  $TitreRech=$TypeSupp;
              break;
    case 3 :  $TitreRech=$Perio;
              break;
    case 4 :  $TitreRech=$Forma;
              break;
    case 5 :  $TitreRech=$TypeMat;
              break;
    case 6 :  $TitreRech=$Obtu;
              break;
    case 7 :  $TitreRech=$Montu;
              break;
    case 8 :  $TitreRech=$TypeApp;
              break;
    case 9 :  $TitreRech=$Mark;
              break;
    case 10 : $TitreRech=$Appar;
              break;
	default : $Erreur=true;	
  }
  if ($Erreur)
  {
	$template->assign('Erreur_Base',$Erreur_Num_Page);
	$template->assign('CheminIndex',$CheminIndex);
	$template->assign('VersionNum',$VersionNum);
	$template->assign('LIndex',$LIndex);
	$template->display($CheminTpl.'erreur_base.tpl');	  
	exit();	
  }
  $template->assign('ResultRech_Gen',$ResultRech_Gen);
  $template->assign('TitreRech',$TitreRech);
  $template->assign('Langue',$Langue);
  
  if ($LeNomRech<>"")
  {
	  $LeNomRech=strtoupper($LeNomRech);
      include "../include/typepage$LaPage.php";
	  switch ($LaPage)
      {
        case 1 :  $SQLS="SELECT  PK_PAYS AS PK_GEN, NOM_PAYS AS NOM_GEN FROM t_pays WHERE UPPER(NOM_PAYS) LIKE '%$LeNomRech%' ORDER BY NOM_PAYS";; //PAYS
                  break;
        case 2 :  $SQLS="SELECT  PK_FILM AS PK_GEN, NOM_FILM AS NOM_GEN FROM t_film WHERE UPPER(NOM_FILM) LIKE '%$LeNomRech%' ORDER BY NOM_FILM";//FILM
                  break;
        case 3 :  $SQLS="SELECT  PK_PERIODE AS PK_GEN, NOM_PERIODE AS NOM_GEN FROM t_periode WHERE UPPER(NOM_PERIODE) LIKE '%$LeNomRech%' ORDER BY NOM_PERIODE"; //PERIODE
                  break;
        case 4 :  $SQLS="SELECT  PK_FORMAT AS PK_GEN, NOM_FORMAT AS NOM_GEN FROM t_format WHERE UPPER(NOM_FORMAT) LIKE '%$LeNomRech%' ORDER BY NOM_FORMAT";//FORMAT
                  break;
        case 5 :  $SQLS="SELECT  PK_TMAT AS PK_GEN, NOM_MAT AS NOM_GEN FROM t_materiel WHERE UPPER(NOM_MAT) LIKE '%$LeNomRech%' ORDER BY NOM_MAT"; //TYPE MAT
                  break;
        case 6 :  $SQLS="SELECT  PK_OBTU AS PK_GEN, NOM_OBTU AS NOM_GEN FROM t_obturateur WHERE UPPER(NOM_OBTU) LIKE '%$LeNomRech%' ORDER BY NOM_OBTU"; //Obturateur
                  break;
        case 7 :  $SQLS="SELECT  PK_MONTURE AS PK_GEN, NOM_MONTURE AS NOM_GEN FROM t_monture WHERE UPPER(NOM_MONTURE) LIKE '%$LeNomRech%' ORDER BY NOM_MONTURE";  //Monture
                  break;
        case 8 :  $SQLS="SELECT  PK_APPAREIL AS PK_GEN, NOM_TAPP AS NOM_GEN FROM t_appareil WHERE UPPER(NOM_TAPP) LIKE '%$LeNomRech%' ORDER BY NOM_TAPP"; //Appareil
                  break;
        case 9 :  $SQLS="SELECT  PK_MARQUE AS PK_GEN, NOM_MARQUE AS NOM_GEN FROM t_marque WHERE UPPER(NOM_MARQUE) LIKE '%$LeNomRech%' ORDER BY NOM_MARQUE";  //Marque
                  break;
        case 10 : $SQLS="SELECT  REF_INV AS PK_GEN, NOM_ITEM AS NOM_GEN FROM t_item WHERE UPPER(NOM_ITEM) LIKE '%$LeNomRech%' ORDER BY NOM_ITEM";   //Item
                  break;
      }
    //Connexion � la base de donn�es
	$connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName);
	if (!$connecter)
	{
    //Redirection vers page d'erreur******************************************************************************
		$template->assign('Erreur_Base',$Erreur_db_Connexion);
		$template->assign('CheminIndex',$CheminIndex);
		$template->assign('VersionNum',$VersionNum);
		$template->assign('LIndex',$LIndex);
		$template->display($CheminTpl.'erreur_base.tpl');	
	//fin redirection*********************************************************************************************
	}
    $query=requete_base($SQLS,$connecter,$BaseType);
	$sth=$connecter->prepare($SQLS);
	$sth->execute();
	$tabresult= $sth->fetchAll();
	$i=0;
	foreach($tabresult as $row)
	{
		$tabListe[$i]['PK_GEN']=$row['PK_GEN'];
		$tabListe[$i]['NOM_GEN']=$row['NOM_GEN'];
		$tabListe[$i]['Icone_View']=$Icone_View;
		$i++;
	}
	if(isset($tabListe))
		$template->assign('liste_item',$tabListe);
  }
  else
  {
	 
  }
  $template->assign('LaPage',$LaPage);
  $template->assign('Retour',$Retour);
  $template->assign('VersionNum',$VersionNum);
  $template->assign('LIndex',$LIndex);
  $template->display($CheminTpl.'result_search.tpl');
?>