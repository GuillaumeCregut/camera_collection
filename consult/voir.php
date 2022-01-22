<?php
/*
  Version  : 1.2 R3
  Date de modification : 20 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : voir.php
  Fonction : Affichage d'un item.
*/
  //include files
  session_start();
  $DebugMode=False;
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  require("../include/smarty.class.php");
  $CheminTpl='../templates/';
  $Langue=$Langue_Sys;
  //Récupération des varaiables
  if (isset($_GET["TypePage"]))
	$Type_Page=$_GET["TypePage"];
  else
	$Type_Page="";  
  if (isset($_GET["CleAff"]))
	$CleP=$_GET["CleAff"];
  else
	$CleP="";  
//Ici verifier les infos :
  if (!(is_numeric($Type_Page)))
  {
    include('../include/erreur.php');
    //die('pb entree');
    exit;
  }
  $Type_Page=(int)$Type_Page;
 /* if (get_magic_quotes_gpc()==0) deprecated
  {
    addslashes($CleP);
  }*/
  if (!file_exists("../include/typepage$Type_Page.php"))
  {
    include('../include/erreur.php');
    exit;
  }
  include "../include/typepage$Type_Page.php";
//Choisi le fichier language
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
               $PageLangue="../include/LangueFR.inc.php";
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               $PageLangue="../include/LangueEN.inc.php";
               break;
    default  : include "../include/LangueFR.inc.php";    //On affiche en francais par defaut
               $Langue="F";
               $Titre1Page=$TitrePageF;
  }
//Definition des fonctions locales.
  function TPL_Simple($Lemoteur,$LeTitre,$LeNomS,$LaValeurS,$LIndex,$VersionNum,$Index)
  {
     $CheminTpl='../templates/';
	 $Lemoteur->assign('Titre_Page',$LeTitre);
     $Lemoteur->assign('Nom_Simple',$LeNomS);
     $Lemoteur->assign('Valeur_Simple',$LaValeurS);
	 $Lemoteur->assign('CheminIndex',"view.php?NumPage=$Index");
	 $Lemoteur->assign('VersionNum',$VersionNum);
	 $Lemoteur->assign('LIndex',$LIndex);
	 $Lemoteur->display($CheminTpl.'simple.tpl');
  }
  function TPL_Double($Lemoteur,$LeTitre,$LeNomS,$LaValeurS,$LaValeur2S,$Rien,$LIndex,$VersionNum,$Index)
  {
     $CheminTpl='../templates/';
//A Modifier pour supprimer les accents	
	$fd = @fopen ($LaValeur2S, "r");
     $buffer="";
     if ($fd)
     {
        while (!feof($fd))
        {
          $buffer = $buffer.fgets($fd, 4096);
        }
        fclose ($fd);
     }
     else
     {
        $buffer=$Rien;
     }
     $buffer=nl2br($buffer);  
	 $buffer=utf8_encode($buffer);	 
     $Lemoteur->assign('TitrePage',$LeTitre);
     $Lemoteur->assign('Nom_Double',$LeNomS);
     $Lemoteur->assign('Valeur_Double',$LaValeurS);
     $Lemoteur->assign('Informations',"Informations");
     $Lemoteur->assign('Info_Double',$buffer);
	 $Lemoteur->assign('CheminIndex',"view.php?NumPage=$Index");
	 $Lemoteur->assign('VersionNum',$VersionNum);
	 $Lemoteur->assign('LIndex',$LIndex);
	 $Lemoteur->display($CheminTpl.'double.tpl');
  }
  function TPL_Marque($Lemoteur,$LeTitre,$LeNomM,$LaValeurM,$LeNomP,$LaValeurP,$Contenu,$Rien,$LIndex,$VersionNum,$Index)
  {
     $CheminTpl='../templates/';
//A Modifier pour supprimer les accents	
	$fd = @fopen ($Contenu, "r");
     $buffer="";
     if ($fd)
     {
        while (!feof($fd))
        {
          $buffer = $buffer.fgets($fd, 4096);
        }
        fclose ($fd);
     }
     else
     {
        $buffer=$Rien;
     }
     $buffer=nl2br($buffer);
	 $buffer=utf8_encode($buffer);
     $Lemoteur->assign('TitrePage',"$LeTitre");
     $Lemoteur->assign('Nom_Marque',$LeNomM);
     $Lemoteur->assign('Nom_Pays',$LeNomP);
     $Lemoteur->assign('Valeur_Marque',$LaValeurM);
     $Lemoteur->assign('Valeur_Pays',$LaValeurP);
     $Lemoteur->assign('Informations',"Informations");
     $Lemoteur->assign('Info_Marque',$buffer);
	 $Lemoteur->assign('CheminIndex',"view.php?NumPage=$Index");
	 $Lemoteur->assign('VersionNum',$VersionNum);
	 $Lemoteur->assign('LIndex',$LIndex);
	 $Lemoteur->display($CheminTpl.'marque.tpl');
  }
//Ici c'est le nouvel affichage, pour le moment appareil photo uniquement
 //Initialisation du template

//Choix de la requete SQL
  $SQLS=$RequeteAffiche.$CleP;
  if ($Type_Page==10)
  {
    $SQLS=$SQLS."'";
  }
//Connexion a la base de données
  $OK=FALSE;
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
//Execution de la requete
  if ($DebugMode)
  {
    $couleur="yellow";
    echo "<div align=\"center\"><table border=\"1\" bgcolor=\"blue\">\n";
    echo "<tr><td bgcolor=\"green\">\n";
    echo "<H1>Debug Mode ON</H1>\n";
    echo "<p>CLé primaire : <font color=\"$couleur\">\"$CleP\"</font></p>\n";
    echo "<p>Requete : <font color=\"$couleur\">$SQLS</font></p>\n";
    echo "<p>Page : <font color=\"$couleur\">$Type_Page</font></p>\n";
    echo "<p>Fin de debug mode</p>\n";
    echo "</td></tr></table></div>\n";
  }
  
    $query=True;
    //Mise en place templates
    $moteur=new Smarty(); 
    switch($Type_Page)
    {
      /*

      */
      case 1 :  foreach($connecter->query($SQLS) as $row)
				{
					TPL_Simple($moteur,"$DisplayOf $Pays",$LeNom,$row["NOM_PAYS"],$Retour,$VersionNum,1);
				}
                break;
      case 2 :  foreach($connecter->query($SQLS) as $row)
				{
					TPL_Simple($moteur,"$DisplayOf $TypeSupp",$LeNom,$row["NOM_FILM"],$Retour,$VersionNum,2);
				}
                break;
      case 3 :  foreach($connecter->query($SQLS) as $row)
				{
                TPL_Simple($moteur,"$DisplayOf $Perio",$LeNom,$row["NOM_PERIODE"],$Retour,$VersionNum,3);
				}
                break;
      case 4 :  foreach($connecter->query($SQLS) as $row)
				{
               TPL_Simple($moteur,"$DisplayOf $Forma",$LeNom,$row["NOM_FORMAT"],$Retour,$VersionNum,4);
				}
                break;
      case 5 :  foreach($connecter->query($SQLS) as $row)
				{
                TPL_Simple($moteur,"$DisplayOf $TypeMat",$LeNom,$row["NOM_MAT"],$Retour,$VersionNum,5);
				}
                break;
      case 6 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["DESC_OBTU"].".txt";
                TPL_Double($moteur,"$DisplayOf $Obtu",$LeNom,$row["NOM_OBTU"],$Chemin,$AucuneInfo,$Retour,$VersionNum,6);
				}
                break;
      case 7 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["DESC_MONTURE"].".txt";
                TPL_Double($moteur,"$DisplayOf $Montu",$LeNom,$row["NOM_MONTURE"],$Chemin,$AucuneInfo,$Retour,$VersionNum,7);
				}
                break;
      case 8 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["DESC_APP"].".txt";
                TPL_Double($moteur,"$DisplayOf $TypeApp",$LeNom,$row["DESC_APP"],$Chemin,$AucuneInfo,$Retour,$VersionNum,8);
				}
                break;
      case 9 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["HIST_MARQUE"].".txt";
                TPL_Marque($moteur,"$DisplayOf $Mark",$LeNom,$row["NOM_MARQUE"],$LePaysMarque,$row["NOM_PAYS"],$Chemin,$AucuneInfo,$Retour,$VersionNum,9);
                }
				break;
      case 10 : 
	  //echo "<p>$SQLS</p>";
	  foreach($connecter->query($SQLS) as $row)
				{
                //Ouverture des fichiers et lecture
				  //A Modifier pour supprimer les accents
                $fd = @fopen ($EnteteRep.$NomRepItem.$row["HIST_ITEM"].".txt", "r");
                $LeTexte_Info="";
                if ($fd)
                {
                   while (!feof($fd))
                   {
                     $LeTexte_Info = $LeTexte_Info.fgets($fd, 4096)."<br>";
                   }
                   fclose ($fd);
                }
                else
                {
                  $LeTexte_Info="";
                }
                
                //$LeTexte_Perso
                $fd = @fopen ($EnteteRep.$NomRepItem.$row["NOTES_PERSO"].".txt", "r");
                $LeTexte_Perso="";
                if ($fd)
                {
                   while (!feof($fd))
                   {
                     $LeTexte_Perso = $LeTexte_Perso.fgets($fd, 4096)."<br>";
                   }
                   fclose ($fd);
                }
                else
                {
                  $LeTexte_Perso="";
                }
                //Cas de l'état
                $Phrase="";
                switch($row["ETAT"])
                {
                   case 1 :  $Phrase=$Mint;
                             break;
                   case 2 :  $Phrase=$Good;
                             break;
                   case 3 :  $Phrase=$CLA;
                             break;
                   case 4 :  $Phrase=$Restore;
                             break;
                   case 5 :  $Phrase=$Wretch;
                             break;
                 }
               //Traitement des photos.
                $MesPhotos=$row["PHOTOS"];
                $ArrayPhoto=explode(';',$MesPhotos);
                $Nombrephoto=(int) $ArrayPhoto[0];
                $CheminBase= "../photos/".$ArrayPhoto[1];
                $MesPhotos="";
                for ($i=1;$i<($Nombrephoto+1);$i++)
                {
                   $MesPhotos=$MesPhotos."<img src=\"$CheminBase$i.jpg\" alt=\"photo\"/>\n";
                }
                if (isset($_SESSION['InSession_Photo']))
                {
                  $fichier_tpl='appareil_pr.tpl';
                }
                else
                { 
                  $fichier_tpl='appareil.tpl';
                }
             //Mise en place du langage
                $moteur->assign('Langue',"$Langue");
                $moteur->assign('Gen_Info',"$GenInfo");
                $moteur->assign('Type_Mat',"$KindMat");
                $moteur->assign('Nom_M',"$LeNom");
                $moteur->assign('Marques',"$Mark");
                $moteur->assign('Annee_Const',"$YearConst");
                $moteur->assign('Periode',"$Perio");
                $moteur->assign('Tech_Info',"$TechInfo");
                $moteur->assign('Type_App',"$KindCam");
                $moteur->assign('Mont',"$LensMount");
                $moteur->assign('Obtu',"$ShutterCam");
                $moteur->assign('Format',"$FormatCam");
                $moteur->assign('Type_Film',"$KindFilm");
                $moteur->assign('Camera_Data',"$InfoAppShow");
                $moteur->assign('Perso',"$LocalInfo");
                $moteur->assign('Ref_Inv',"$RefInv");
                $moteur->assign('Etat',"$StateCam");
                $moteur->assign('Prix',"$BuyPrice");
                $moteur->assign('Note_P',$PersNote);
                $moteur->assign('money',"euros");
                $moteur->assign('Photos',"Photos");
                $moteur->assign('Titre_Page',"$DisplayOf $Titre1Page");
                $moteur->assign('Info_Nom',$row["NOM_ITEM"]);
                $moteur->assign('Cle_Type',$row["PK_TMAT"]);
                $moteur->assign('Cle_Marque',$row["PK_MARQUE"]);
                $moteur->assign('Cle_Per',$row["PK_PERIODE"]);
                $moteur->assign('Cle_App',$row["PK_APPAREIL"]);
                $moteur->assign('Cle_Mont',$row["PK_MONTURE"]);
                $moteur->assign('Cle_Obt',$row["PK_OBTU"]);
                $moteur->assign('Cle_Form',$row["PK_FORMAT"]);
                $moteur->assign('Cle_Film',$row["PK_FILM"]);
                if (isset($_SESSION['InSession_Photo']))
				{
                  $moteur->assign('Info_Inv',$CleP);
				  $LeTexte_Perso=utf8_encode($LeTexte_Perso);
                  $moteur->assign('Info_P',$LeTexte_Perso);
                  $moteur->assign('Info_Prix',$row["PRIX_ACHAT"]);
                  $moteur->assign('Info_Etat',$Phrase);
                }
                $moteur->assign('Info_Date',$row["ANNEE_PROD"]);
                $moteur->assign('lesphotos',$MesPhotos);
				$LeTexte_Info=utf8_encode($LeTexte_Info);
                $moteur->assign('Info_H',$LeTexte_Info);
                $moteur->assign('Info_App',$row["NOM_TAPP"]);
                $moteur->assign('Info_Mat',$row["NOM_MAT"]);
                $moteur->assign('Info_Mont',$row["NOM_MONTURE"]);
                $moteur->assign('Info_Format',$row["NOM_FORMAT"]);
                $moteur->assign('Periode_M',$row["NOM_PERIODE"]);
                $moteur->assign('Info_Marque',$row["NOM_MARQUE"]);
                $moteur->assign('Info_Film',$row["NOM_FILM"]);
                $moteur->assign('Info_Obtu',$row["NOM_OBTU"]);
				$moteur->assign('CheminIndex',$_SERVER['HTTP_REFERER']);
				$moteur->assign('VersionNum',$VersionNum);
				$moteur->assign('LIndex',$Retour);
				$moteur->display($CheminTpl.$fichier_tpl);
				}
                break;
				
    }
?>
