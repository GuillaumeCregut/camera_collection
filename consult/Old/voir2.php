<?php
/*
  Version  : 1.2 R1
  Date de modification : 20 avril 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : voir.php
  Fonction : Affichage d'un item.
*/
  //include files
  $DebugMode=False;
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  $Type_Page=$_GET["TypePage"];
  $CleP=$_GET["CleAff"];
  $Langue=$_GET["Lan"];
//Ici verfier les infos :
  if (!(is_numeric($Type_Page)))
  {
    include('../include/erreur.php');
    //die('pb entree');
    exit;
  }
  $Type_Page=(int)$Type_Page;
  if (get_magic_quotes_gpc()==0)
  {
    addslashes($CleP);
  }
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
  function TPL_Simple($Lemoteur,$LeTitre,$LeNomS,$LaValeurS)
  {
     $Lemoteur->set_file('index','simple.tpl');
     $Lemoteur->set_var('Titre_Page',$LeTitre);
     $Lemoteur->set_var('Nom_Simple',$LeNomS);
     $Lemoteur->set_var('Valeur_Simple',$LaValeurS);
     $Lemoteur->pparse('resultat','index');
  }
  function TPL_Double($Lemoteur,$LeTitre,$LeNomS,$LaValeurS,$LaValeur2S,$Rien)
  {
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
     $Lemoteur->set_file('index','double.tpl');
     $Lemoteur->set_var('TitrePage',$LeTitre);
     $Lemoteur->set_var('Nom_Double',$LeNomS);
     $Lemoteur->set_var('Valeur_Double',$LaValeurS);
     $Lemoteur->set_var('Informations',"Informations");
     $Lemoteur->set_var('Info_Double',$buffer);
     $Lemoteur->pparse('resultat','index');
  }
  function TPL_Marque($Lemoteur,$LeTitre,$LeNomM,$LaValeurM,$LeNomP,$LaValeurP,$Contenu,$Rien)
  {
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
     $Lemoteur->set_file('index','marque.tpl');
     $Lemoteur->set_var('TitrePage',"$LeTitre");
     $Lemoteur->set_var('Nom_Marque',$LeNomM);
     $Lemoteur->set_var('Nom_Pays',$LeNomP);
     $Lemoteur->set_var('Valeur_Marque',$LaValeurM);
     $Lemoteur->set_var('Valeur_Pays',$LaValeurP);
     $Lemoteur->set_var('Informations',"Informations");
     $Lemoteur->set_var('Info_Marque',$buffer);
     $Lemoteur->pparse('resultat','index');
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
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  
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
  if ($query)
  {
    //Mise en place templates
    include_once ('../include/template.inc.php');
    $moteur=new template('../templates/');
    switch($Type_Page)
    {
      /*

      */
      case 1 :  foreach($connecter->query($SQLS) as $row)
				{
					TPL_Simple($moteur,"$DisplayOf $Pays",$LeNom,$row["NOM_PAYS"]);
				}
                break;
      case 2 :  foreach($connecter->query($SQLS) as $row)
				{
					TPL_Simple($moteur,"$DisplayOf $TypeSupp",$LeNom,$row["NOM_FILM"]);
				}
                break;
      case 3 :  foreach($connecter->query($SQLS) as $row)
				{
                TPL_Simple($moteur,"$DisplayOf $Perio",$LeNom,$row["NOM_PERIODE"]);
				}
                break;
      case 4 :  foreach($connecter->query($SQLS) as $row)
				{
               TPL_Simple($moteur,"$DisplayOf $Forma",$LeNom,$row["NOM_FORMAT"]);
				}
                break;
      case 5 :  foreach($connecter->query($SQLS) as $row)
				{
                TPL_Simple($moteur,"$DisplayOf $TypeMat",$LeNom,$row["NOM_MAT"]);
				}
                break;
      case 6 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["DESC_OBTU"].".txt";
                TPL_Double($moteur,"$DisplayOf $Obtu",$LeNom,$row["NOM_OBTU"],$Chemin,$AucuneInfo);
				}
                break;
      case 7 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["DESC_MONTURE"].".txt";
                TPL_Double($moteur,"$DisplayOf $Montu",$LeNom,$row["NOM_MONTURE"],$Chemin,$AucuneInfo);
				}
                break;
      case 8 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["DESC_APP"].".txt";
                TPL_Double($moteur,"$DisplayOf $TypeApp",$LeNom,$row["DESC_APP"],$Chemin,$AucuneInfo);
				}
                break;
      case 9 :  foreach($connecter->query($SQLS) as $row)
				{
                //Gerer l'affichage des textes
                $Chemin=$EnteteRep.$NomRepItem.$row["HIST_MARQUE"].".txt";
                TPL_Marque($moteur,"$DisplayOf $Mark",$LeNom,$row["NOM_MARQUE"],$LePaysMarque,$row["NOM_PAYS"],$Chemin,$AucuneInfo);
                }
				break;
      case 10 : foreach($connecter->query($SQLS) as $row)
				{
                //Ouverture des fichiers et lecture
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
                if ($PrivateUse)
                {
                  $moteur->set_file('index','appareil_pr.tpl');
                }
                else
                { 
                  $moteur->set_file('index','appareil.tpl');
                }
             //Mise en place du langage
                $moteur->set_var('Langue',"$Langue");
                $moteur->set_var('Gen_Info',"$GenInfo");
                $moteur->set_var('Type_Mat',"$KindMat");
                $moteur->set_var('Nom_M',"$LeNom");
                $moteur->set_var('Marques',"$Mark");
                $moteur->set_var('Annee_Const',"$YearConst");
                $moteur->set_var('Periode',"$Perio");
                $moteur->set_var('Tech_Info',"$TechInfo");
                $moteur->set_var('Type_App',"$KindCam");
                $moteur->set_var('Mont',"$LensMount");
                $moteur->set_var('Obtu',"$ShutterCam");
                $moteur->set_var('Format',"$FormatCam");
                $moteur->set_var('Type_Film',"$KindFilm");
                $moteur->set_var('Camera_Data',"$InfoAppShow");
                $moteur->set_var('Perso',"$LocalInfo");
                $moteur->set_var('Ref_Inv',"$RefInv");
                $moteur->set_var('Etat',"$StateCam");
                $moteur->set_var('Prix',"$BuyPrice");
                $moteur->set_var('Note_P',$PersNote);
                $moteur->set_var('money',"euros");
                $moteur->set_var('Photos',"Photos");
                $moteur->set_var('Titre_Page',"$DisplayOf $Titre1Page");
                $moteur->set_var('Info_Nom',$row["NOM_ITEM"]);
                $moteur->set_var('Cle_Type',$row["PK_TMAT"]);
                $moteur->set_var('Cle_Marque',$row["PK_MARQUE"]);
                $moteur->set_var('Cle_Per',$row["PK_PERIODE"]);
                $moteur->set_var('Cle_App',$row["PK_APPAREIL"]);
                $moteur->set_var('Cle_Mont',$row["PK_MONTURE"]);
                $moteur->set_var('Cle_Obt',$row["PK_OBTU"]);
                $moteur->set_var('Cle_Form',$row["PK_FORMAT"]);
                $moteur->set_var('Cle_Film',$row["PK_FILM"]);
                if ($PrivateUse)
                {
                  $moteur->set_var('Info_Inv',$CleP);
                  $moteur->set_var('Info_P',$LeTexte_Perso);
                  $moteur->set_var('Info_Prix',$row["PRIX_ACHAT"]);
                  $moteur->set_var('Info_Etat',$Phrase);
                }
                $moteur->set_var('Info_Date',$row["ANNEE_PROD"]);
                $moteur->set_var('lesphotos',$MesPhotos);
                $moteur->set_var('Info_H',$LeTexte_Info);
                $moteur->set_var('Info_App',$row["NOM_TAPP"]);
                $moteur->set_var('Info_Mat',$row["NOM_MAT"]);
                $moteur->set_var('Info_Mont',$row["NOM_MONTURE"]);
                $moteur->set_var('Info_Format',$row["NOM_FORMAT"]);
                $moteur->set_var('Periode_M',$row["NOM_PERIODE"]);
                $moteur->set_var('Info_Marque',$row["NOM_MARQUE"]);
                $moteur->set_var('Info_Film',$row["NOM_FILM"]);
                $moteur->set_var('Info_Obtu',$row["NOM_OBTU"]);
                $moteur->pparse('resultat','index');
				}
                break;
				
    }
  }//Fin requete OK
  else
   {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "<p>SQLS =\" $SQLS \".</p>\n";
     echo "$DBPb";
  }    /*
  
  */
//Pied de page
  echo "<p><a href=\"javascript:window.close()\">$Fermer</a></p>\n";
  include "../include/footer.php";
?>
