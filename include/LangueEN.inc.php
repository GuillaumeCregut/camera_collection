<?php
/*
  Version  : 1.2 R3
  Date de modification : 19 Mai 2018.
  Validé fonctionnelle : Oui
  Validé W3C : Oui
  Nom : LangueEn.inc.php
  Fonction : Fichier définition langages.
*/
/*International Language.
  In English, but should be changed.
  Only item with 'Should not be changed;' can't be changed to new language.
*/
//Regarding home page
  $LIndex="Home";      //Should be changed;
  $HomeTitle="Management : (restricted access)"; //Should be changed;
  $Pays="Countries"; //Should be changed;
  $TypeSupp="Kind of support";   //Should be changed;
  $Perio="Period";  //Should be changed;
  $Forma="Format";   //Should be changed;
  $TypeMat="kind of hardware"; //Should be changed;
  $Obtu="Shutters";   //Should be changed;
  $Montu="Lens mount/Lens Name"; //Should be changed;
  $TypeApp="kind of camera"; //Should be changed;
  $Mark="Brand";    //Should be changed;
  $Appar="Camera/Hardware"; //Should be changed;
  $Recherche="Search"; //Should be changed;
  $ConfSys="System configuration";
  $GestionColl = "Collection management";
  $Diconnect="D&eacute;connexion";
//Regarding management pages
  $StyleExist="Still exists :"; //Should be changed;
  $LeNom="Name ";      //Should be changed;
  $LePaysMarque="Country ";
  $UsedDBase="Database used : ";    //Should be changed;
  $CheminIndex="../index.php";  //Should not be changed; 
  $Mgmt="Management of ";         //Should be changed;
  $Erreur="Error";               //Should be changed;
  $DBPb="A query error occured ! Please contact Administrator";  //Should be changed;
  $Mot1="on";  //Should be changed;
  $BoutonAdd="Add";
  $BoutonSupp="Delete";
  $BoutonMod="Modify";
  $Retour="Back";
  $TitreMarques="Brands";
  $LeMarquePage=" the brand";
  $TitreAppareils="Cameras";
  $RefInv="Inventory reference";
  $KindMat="Kind of Hardware";
  $NameDev="Device Name";
  $BrandDev="Device Brand";
  $KindCam="Kind of camera";
  $FormatCam="Format";
  $KindFilm="Kind of Support";
  $YearConst="Year of contruction";
  $PeriodeC="Periode";
  $ShutterCam="Shutter";
  $LensMount="Lens/Lens mount";
  $PhotoCam="Pictures (Number; basename)";
  $BuyPrice="Price";
  $StateCam="State";
  $Mint="Mint";
  $Good="Good";
  $CLA="Need CLA";
  $Restore="To restore";
  $Wretch="Wretch";
  $InfoCam="Informations on device";
  $PersNote="Personnal notes";
  $ExisteIl="Is this camera already in ?";
  $Display="Display";
  $DisplayOf="Display of";
  $Fermer="Close";
  //page info appareil
  $GenInfo="General informations";
  $TechInfo="Technical informations";
  $LocalInfo="This camera/Device";
  $InfoAppShow="Informations on devices";
  $RechApp="Find a Camera/Device";
  $HowUseIt="Please, check the box for item you search. You ca choose more than one";
  $ResultRechApp="Result for camera/device search.";
  $FinResultApp="End of results.";
  $Search="Search";
  $NoChoiceMade=" No choice made";
  $RechMark="Search a brand by country";
  $ResultRechMark="Result of brand by country search.";
  $Aucune="None";
  $SearchFor="Search by name for :";
  $ResultRech_Gen="Result for name search of : ";
  $ParBy="By";
  $TitreTab[0]=$KindMat;
  $TitreTab[1]=$TypeApp;
  $TitreTab[2]=$Forma;
  $TitreTab[3]=$Montu;
  $TitreTab[4]=$Obtu;
  $TitreTab[5]=$Mark;
  $TitreTab[6]=$TypeSupp;
  $TitreTab[7]=$Perio;
  //Ajout du 16 octobre.
  $MesCams="My cameras";
  $AucunRes="No results";
  $AucuneInfo="No informations.";
  $ModifApp="Modify the camera";
  $DisplayOrdered="Display ordered by";
  $TitreStat="Collection's statistics at the date of ";
  $NbreAppTotal="Total number of items";
  $ClassCat="Order by category";
  $Thereis="There is";
  $Enregistrees=" recorded";
  $ValeurCollec="Collection value";
  $ValEstim="The collection is estimated at";
  $GenID="ID Generator";
  //Presentation
  $Presentation="<p>This is a system allowing management and presentation of cameras collection.</p>
<p>With this software, you would be able to order and display your cameras using several criterion.</p>
<p>Through different menus, vous will add, update cameras and things regarding it.</p>
<p>It is also possible to use a search menu by name and criterion, allowing you searching in your collection your cameras and other.</p>";
//New for management page
$TitreSQL="Database configuration";
$Login_Texte="User name";
$Passe_Texte="Password";
$Serveur_Texte="Server Name";
$Base_Text="Database Name";
$TitreLogin="Software Login";
$Config_Titre="Configuration";
$Creation_Message="Configuration file successfully created";
$Creation_Message_failed="Fail to create configuration file";
$Langue_Used="Language";
$Langue1="French";
$Langue2="English";
$Protected_Area="Protected area. Please, login";
$Disconnected="You are now disconnected. Goodbye !";
$Erreur_db_Connexion="Database connection error. Please check configuration";
$Erreur_Num_Page="File not found";
$ParCritere="By criterion";
$ResultatExport="Export successfully done";
$XML_File="Data in XML format";
$Export_Datas="Data Export";
$ResultatExportFailed="Failed to export datas";
$Genere_Catalogue="Catalog generator";
$StatistiquesPage='Statistics';
$Validation_Btn='validate';
$Connexion_OK="You are now connected";
$UserConnection='User Connection';
?>