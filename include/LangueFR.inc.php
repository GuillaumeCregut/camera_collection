<?php
/*
  Version  : 1.2 R3
  Date de modification : 19 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : LangueFr.inc.php
  Fonction : Fichier définition langages.
*/
/*International Language.
  In French, but should be changed.
  Only item with 'Should not be changed;' can't be changed to new language.
*/
//Regarding Index page
  $LIndex="Index";    //Should be changed; 
  $HomeTitle="Gestion : (acc&egrave;s prot&eacute;g&eacute;)";  //Should be changed;
  $Pays="Pays";  //Should be changed;
  $TypeSupp="Type de support";  //Should be changed;
  $Perio="P&eacute;riode"; //Should be changed;
  $Forma="Format";  //Should be changed;
  $TypeMat="Type de mat&eacute;riel"; //Should be changed;
  $Obtu="Obturateurs";  //Should be changed;
  $Montu="Objectif/Monture";  //Should be changed;
  $TypeApp="Type d'appareils"; //Should be changed;
  $Mark="Marque";  //Should be changed;
  $Appar="Appareils";  //Should be changed;
  $Recherche="Recherche";  //Should be changed;
  $ConfSys="Configuration syst&egrave;me";
  $GestionColl = "Gestion de la collection";
  $Diconnect="Logout";
//Regarding management pages
  $StyleExist="D&eacute;j&agrave; existant :";  //Should be changed;
  $LeNom="Nom ";      //Should be changed;
  $LePaysMarque="Pays ";
  $UsedDBase="Moteur utilis&eacute; : ";   //Should be changed;
  $CheminIndex="index.php";  //Should not be changed;
  $CheminIndexConsult="index.php?Lan=F";  //Should not be changed; //Voir si utile en fin
  $Mgmt="Gestion des ";   //Should be changed;
  $Erreur="Erreur";    //Should be changed;
  $DBPb="un probleme de requete a eu lieu, veuillez contacter l'administrateur du systeme"; //Should be changed;
  $Mot1="sur";  //Should be changed;
  $BoutonAdd="Ajouter";
  $BoutonSupp="Supprimer";
  $BoutonMod="Modifier";
  $Retour="Retour";
  $TitreMarques="Marques";
  $LeMarquePage=" la marque";
  $TitreAppareils="Appareils";
  $RefInv="R&eacute;f&eacute;rence Inventaire";
  $KindMat="Type de mat&eacute;riel";
  $NameDev="Nom de l'appareil";
  $BrandDev="Marque";
  $KindCam="Type d'appareil";
  $FormatCam="Format";
  $KindFilm="Type de surface sensible";
  $YearConst="Ann&eacute;e de construction";
  $PeriodeC="P&eacute;riode";
  $ShutterCam="Obturateur";
  $LensMount="Objectif/Monture";
  $PhotoCam="Photos (Nbre;base)";
  $BuyPrice="Prix d'achat";
  $StateCam="Etat";
  $Mint="Neuf";
  $Good="Bon";
  $CLA="Necessite une r&eacute;vision";
  $Restore="A restaurer";
  $Wretch="Epave";
  $InfoCam="Information sur l'appareil";
  $PersNote="Notes personnelles";
  $ExisteIl="Cet appareil existe t'il dans la base ?";
  $Display="Affichage";
  $DisplayOf="Affichage des";
  $Fermer="Fermer";
  //page info appareil
  $GenInfo="Informations g&eacute;n&eacute;rales";
  $TechInfo="Informations techniques";
  $LocalInfo="Cet appareil";
  $InfoAppShow="Informations sur l'appareil";
  //Recherche
  $RechApp="Rechercher un appareil";
  $HowUseIt="Cocher les cases correspondantes aux recherches. Vous pouvez en cocher plusieures.";
  $ResultRechApp="R&eacute;sultat de la recherche d'appareils.";
  $FinResultApp="Fin des r&eacute;sultats";
  $Search="Rechercher";
  $NoChoiceMade="Aucun choix effectu&eacute;";
  $RechMark="Rechercher une marque par pays";
  $ResultRechMark="R&eacute;sultat de la recherche de la marque par pays.";
  $Aucune="Aucune";
  $SearchFor="Recherche par nom de : ";
  $ResultRech_Gen="Resultat de la recherche par nom de : ";
  $ParBy="Par";
  $TitreTab[0]=$KindMat;
  $TitreTab[1]=$TypeApp;
  $TitreTab[2]=$Forma;
  $TitreTab[3]=$Montu;
  $TitreTab[4]=$Obtu;
  $TitreTab[5]=$Mark;
  $TitreTab[6]=$TypeSupp;
  $TitreTab[7]=$Perio;
  //Ajout du 16 oct
  $MesCams="Mes appareils photos";
  $AucunRes="Aucun r&eacute;sultat";
  $AucuneInfo="Aucune informations.";
  $ModifApp="Modification de l'appareil";
  $DisplayOrdered="Afficher les appareils class&eacute;s par";
  $TitreStat="Statistiques de la collection &agrave; la date du ";
  $NbreAppTotal="Nombre d'appareils au total";
  $ClassCat="Classement par cat&eacute;gories";
  $Thereis="Il y a";
  $Enregistrees=" enregistr&eacute;s";
  $ValeurCollec="Valeur de la collection";
  $ValEstim="La collection &agrave; une valeur estim&eacute;e &agrave;";
  $GenID="G&eacute;n&eacute;rateur de num&eacute;ro d'inventaire";
  $Presentation="<p>Vous &ecirc;tes sur un syt&egrave;me de gestion et de pr&eacute;sentation de collection d'appareils photos.</p>
<p>Ce logiciel permet le stockage, le tri et l'affichage de vos appareils en fonctions de plusieurs crit&egrave;res.</p>
<p>Via les diff&eacute;rents menus, vous pourrez ajouter, modifier un appareil photo, ainsi que tout ce qui le concerne.</p>
<p>Vous y trouverez aussi un syt&egrave;me de recherche par nom ou par crit&egrave;res, permettant d'effectuer vos recherches dans votre collection.</p>";
//Nouvelle page de gestion
$TitreSQL="Acc&egrave;s &agrave; la base de donn&eacute;es";
$Login_Texte="Nom d'utilisateur";
$Passe_Texte="Mot de passe";
$Serveur_Texte="Nom du serveur";
$Base_Text="Nom de la base";
$TitreLogin="Acc&egrave;s au logiciel";
$Config_Titre="Configuration";
$Creation_Message="Fichier de configuration cr&eacute;&eacute; avec succ&eacute;s";
$Creation_Message_failed="Echec &agrave; la cr&eacute;ation du fichier de configuration";
$Langue_Used="Langue";
$Langue1="Fran&ccedil;ais";
$Langue2="Anglais";
$Protected_Area="Acc&egrave;s prot&eacute;g&eacute;. Veuillez vous connecter.";
$Disconnected="Vous &ecirc;tes maintenant d&eacute;connect&eacute;. Au revoir !";
$Erreur_db_Connexion="Erreur de connexion aux donn&eacute;es. V&eacute;rifier la configuration.";
$Erreur_Num_Page="Le fichier demand&eacute; n'existe pas.";
$ParCritere="Par crit&egrave;res";
$ResultatExport="Exportation temin&eacute;e";
$XML_File="Fichier d'exportation au format XML";
$Export_Datas="Export des donn&eacute;es de la base";
$ResultatExportFailed="Echec de l'export des donn&eacute;es";
$Genere_Catalogue="G&eacute;n&eacute;ration du catalogue";
$StatistiquesPage='Statistiques';
$Validation_Btn='Valider';
$Connexion_OK="Vous &ecirctes maintenant connect&eacute;";
$UserConnection='Connexion utilisateur';
?>