<?php
  /*
  Version  : 1.2 R3
  Date de modification : 21 Mai 2018.
  Validé fonctionnelle : oui
  Validé W3C : Oui
  Nom : stats3.php
  Fonction : Statistiques sur la collection.
*/
  session_start();
  define ("MATERIEL", 0);
  define ("APPAREIL", 1);
  define ("FORMAT", 2);
  define ("MONTURE", 3);
  define ("OBTU", 4);
  define ("MARQUE", 5);
  define ("FILM", 6);
  define ("PERIODE", 7);
 //include files
  require("../include/smarty.class.php");
  $template=new Smarty(); 
  $CheminTpl='../templates/'; 
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage10.php";
  include "../include/image.inc.php";
  $Langue=$Langue_Sys;
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
              // $LeItemPage=$LeItemPageF;
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               $LeItemPage=$LeItemPageE; //concerne le textarea
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
	exit();	
	//fin redirection*********************************************************************************************
  }
  //Suppression des fichiers images
  $TabFichier=array_diff(scandir('../exports/images'), array('..', '.'));
  foreach($TabFichier as $value)
  {
	$LeChemin='../exports/images/'.$value;
	//echo "<p>$LeChemin</p>\n";
	if (file_exists($LeChemin))
    {    
		$Ok=@unlink($LeChemin);
		if ($Ok)
		{
			//echo"<p>suppression de $LeChemin OK</p>";
		}
		else
		{
			//echo "<p>Erreur</p>";
		}
    }
	else
	{
		//echo "<p>Fichier n'existe pas</p>";
	}
  }
  //
  
  $template->assign('Thereis',$Thereis);
  $Val7=$TypeSupp.$Enregistrees;
  $Val8=$Forma.$Enregistrees;
  $Val9=$Mark.$Enregistrees;
  $Val10=$TypeMat.$Enregistrees;
  $Val11=$Montu.$Enregistrees;
  $Val12=$ShutterCam.$Enregistrees;
  $Val13=$Pays.$Enregistrees;
  $Val14=$PeriodeC.$Enregistrees;
  $Val17=$KindCam.$Enregistrees;

//Début du script
  $template->assign('TitreStat',$TitreStat);
  $DateJour=date("j M Y");
  $template->assign('DateJour',$DateJour);
  $Qtte_Totale_App=array();
  $Qtte_Totale_Materiel=array();
  $Qtte_Totale_Marque=array();
  $Qtte_Totale_Film=array();   //
  $Qtte_Totale_Obtu=array();
  $Qtte_Totale_Mont=array();
  $Qtte_Totale_Format=array();
  $Qtte_Totale_Periode=array();
  //Quantification totale
  $SQLS="SELECT count(*) AS NBRE FROM t_item";            
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('NbreAppTotal',$NbreAppTotal);	
	$template->assign('nbreApp',$row["NBRE"]);
    $Qtte_Totale_Item=$row["NBRE"];                                          
  }
  //Film
  $SQLS="SELECT count(*) AS NBRE FROM t_film";
  foreach($connecter->query($SQLS) as $row)
  { 
	$template->assign('Val7',$Val7);	
	$template->assign('Nbre_7',$row["NBRE"]);
    $Qtte_Totale[FILM]=$row["NBRE"];                                     
  }
  //Format
  $SQLS="SELECT count(*) AS NBRE FROM t_format";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_8',$row["NBRE"]);
	$template->assign('Val8',$Val8);
    $Qtte_Totale[FORMAT]=$row["NBRE"];                                    
  }
  //Marque
  $SQLS="SELECT count(*) AS NBRE FROM t_marque";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_9',$row["NBRE"]);
	$template->assign('Val9',$Val9);
    $Qtte_Totale[MARQUE]=$row["NBRE"];                                     
  }
  //Materiel
  $SQLS="SELECT count(*) AS NBRE FROM t_materiel";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_10',$row["NBRE"]);
	$template->assign('Val10',$Val10);
    $Qtte_Totale[MATERIEL]=$row["NBRE"];                                     
  }
  //Monture
  $SQLS="SELECT count(*) AS NBRE FROM t_monture";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_11',$row["NBRE"]);
	$template->assign('Val11',$Val11);
    $Qtte_Totale[MONTURE]=$row["NBRE"];                                     
  }
  //Obturateur
  $SQLS="SELECT count(*) AS NBRE FROM t_obturateur";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_12',$row["NBRE"]);
	$template->assign('Val12',$Val12);
    $Qtte_Totale[OBTU]=$row["NBRE"];                                     
  }
  //Pays
  $SQLS="SELECT count(*) AS NBRE FROM t_pays";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_13',$row["NBRE"]);
	$template->assign('Val13',$Val13);                                     
  }
  //Periode
  $SQLS="SELECT count(*) AS NBRE FROM t_periode";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_14',$row["NBRE"]);
	$template->assign('Val14',$Val14);
    $Qtte_Totale[PERIODE]=$row["NBRE"];                                     
  }
   //appareil
  $SQLS="SELECT count(*) AS NBRE FROM t_appareil";
  foreach($connecter->query($SQLS) as $row)
  {
    $template->assign('Nbre_17',$row["NBRE"]);
	$template->assign('Val17',$Val17);
    $Qtte_Totale[APPAREIL]=$row["NBRE"];                                     
  }
  if (isset($_SESSION['InSession_Photo']))
  {
	  $template->assign('ValeurCollec',$ValeurCollec);
	  $SQLS="SELECT SUM(t_item.PRIX_ACHAT) AS NBRE FROM t_item";
	  foreach($connecter->query($SQLS) as $row)
	  {
		$template->assign('ValEstim',$ValEstim);
		$template->assign('CoutTotal',$row["NBRE"]);
	  }
  }
//Affichage des tableaux
  $template->assign('ClassCat',$ClassCat);
  $SQLS_Tab[MATERIEL]="SELECT count(t_item.nom_item) AS NBRE, t_materiel.nom_mat AS DESIGNATION FROM t_item INNER JOIN t_materiel ON t_item.fk_mat=t_materiel.pk_tmat GROUP BY t_materiel.nom_mat"; //Appareils
  $SQLS_Tab[APPAREIL]="SELECT count(t_item.nom_item) AS NBRE, t_appareil.nom_tapp AS DESIGNATION FROM t_item INNER JOIN t_appareil ON t_item.fk_app=t_appareil.pk_appareil GROUP BY t_appareil.nom_tapp"; //Catégories
  $SQLS_Tab[FORMAT]="SELECT count(t_item.nom_item) AS NBRE, t_format.nom_format AS DESIGNATION FROM t_item INNER JOIN t_format ON t_item.fk_format=t_format.pk_format GROUP BY t_format.nom_format"; //Formats
  $SQLS_Tab[MONTURE]="SELECT count(t_item.nom_item) AS NBRE, t_monture.nom_monture AS DESIGNATION FROM t_item INNER JOIN t_monture ON t_item.fk_monture=t_monture.pk_monture GROUP BY t_monture.nom_monture"; //Objectifs
  $SQLS_Tab[OBTU]="SELECT count(t_item.nom_item) AS NBRE, t_obturateur.nom_obtu AS DESIGNATION FROM t_item INNER JOIN t_obturateur ON t_item.fk_obtu=t_obturateur.pk_obtu GROUP BY t_obturateur.nom_obtu"; //Obturateurs
  $SQLS_Tab[MARQUE]="SELECT count(t_item.nom_item) AS NBRE, t_marque.nom_marque AS DESIGNATION FROM t_item INNER JOIN t_marque ON t_item.fk_marque=t_marque.pk_marque GROUP BY t_marque.nom_marque"; //Marques
  $SQLS_Tab[FILM]="SELECT count(t_item.nom_item) AS NBRE, t_film.nom_film AS DESIGNATION FROM t_item INNER JOIN t_film ON t_item.fk_film=t_film.pk_film GROUP BY t_film.nom_film"; //Type de film
  $SQLS_Tab[PERIODE]="SELECT count(t_item.nom_item) AS NBRE, t_periode.nom_periode AS DESIGNATION FROM t_item INNER JOIN t_periode ON t_item.fk_periode=t_periode.pk_periode GROUP BY t_periode.nom_periode"; //Periode
  for ($i=0;$i<8;$i++)
  {
    $SQLS=$SQLS_Tab[$i];
	$j=0;
    foreach($connecter->query($SQLS) as $row)
    {
      $SuperTab[$i][$j]=$row["DESIGNATION"].';'.$row["NBRE"];
      $j++;
    }
  }
  for ($i=0;$i<7;$i++)
  {
    $TabGraf[$i]=Dessine_Camembert($i,$SuperTab[$i]);
  }
  $template->assign('liste_graf',$TabGraf);
  $BarGraf=Dessine_Barre(PERIODE,$SuperTab[PERIODE]);
  $template->assign('BarGraf',$BarGraf);
  $template->assign('CheminIndex',$CheminIndex);
  $template->assign('LIndex',$LIndex);
  $template->assign('VersionNum',$VersionNum);
  $template->display($CheminTpl.'stat3.tpl');
?>