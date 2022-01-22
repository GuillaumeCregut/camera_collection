<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<title>Gestion de collection-Collection manager</title>
<link rel="stylesheet" type="text/css" href="../include/index.css">
</head>
<body>
<?php
 //include files
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/typepage10.php";
  $Langue=$_GET["Language"];
  switch ($Langue)
  {
    case "F" : include "../include/LangueFR.inc.php";
               $Titre1Page=$TitrePageF;
               $LeItemPage=$LeItemPageF;
               break;
    case "E" : include "../include/LangueEN.inc.php";
               $Titre1Page=$TitrePageE;
               $LeItemPage=$LeItemPageE; //concerne le textarea
               break;
  }
  //Connexion à la base de données
  $connecter=connect_serveur($DBUser,$DBPass, $DBServer,$DBName,$BaseType);
  if ($BaseType==0)
  {
    $dbconn=connect_base($DBName,$connecter);
  }
//definition des langues
//tempo
  $Val1="Statistiques de la collection à la date du ";
  $Val2="Nombre d'appareils au total";
  $Val3="Classement par cat&eacute;gories";
  $Val4="D&eacute;signation";
  $Val5="Nombre";
  $Val6="Il y a";
  $Val7="type de film enregistr&eacute;s";
  $Val8=" type de format enregistr&eacute;s";
  $Val9="marques enregistr&eacute;es";
  $Val10="type de mat&eacute;riel enregistr&eacute;s";
  $Val11="type de d'objectifs enregistr&eacute;s";
  $Val12="type d'obturateurs enregistr&eacute;s";
  $Val13="pays enregistr&eacute;s";
  $Val14="p&eacute;riodes enregistr&eacute;es";
  $Val15="Valeur de la collection";
  $Val16="La collection &agrave une valeur estim&eacute;e &agrave;";
  $Val17="type d'appareils enregistr&eacute;s";
//Début du script
  echo "<H1 align=\"center\">$Val1  : ".date("j M Y")."</H1>\n";
  $Qtte_Totale_App=array();
  $Qtte_Totale_Materiel=array();
  $Qtte_Totale_Marque=array();
  $Qtte_Totale_Film=array();   //
  $Qtte_Totale_Obtu=array();
  $Qtte_Totale_Mont=array();
  $Qtte_Totale_Format=array();
  $Qtte_Totale_Periode=array();
  //Quantification totale
  $SQLS="SELECT COUNT(*) AS NBRE FROM T_ITEM";            //Item
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
  while ($row=get_Objet($query,$BaseType))
  {
    echo "<p><u>$Val2 :</u> <font color=\"red\">$row->NBRE</font></p>\n";
    $Qtte_Totale_Item=$row->NBRE;                                          //Item
  }
  $SQLS="SELECT COUNT (*) AS NBRE FROM T_FILM";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val7<br>\n";
    $Qtte_Totale_Film[0]=$row->NBRE;                                     //Film
  }
  //
  $SQLS="SELECT COUNT (*) AS NBRE FROM T_FORMAT";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val8<br>\n";
    $Qtte_Totale_Format[0]=$row->NBRE;                                    //Format
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_MARQUE";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val9<br>\n";
    $Qtte_Totale_Marque[0]=$row->NBRE;                                     //Marque
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_MATERIEL";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val10<br>\n";
    $Qtte_Totale_Materiel[0]=$row->NBRE;                                     //Materiel
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_MONTURE";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val11<br>\n";
    $Qtte_Totale_Mont[0]=$row->NBRE;                                     //Monture
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_OBTURATEUR";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val12<br>\n";
    $Qtte_Totale_Obtu[0]=$row->NBRE;                                     //Obturateur
  }
  $SQLS="SELECT COUNT (*) AS NBRE FROM T_PAYS";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val13<br>\n";                                     //Pays
  }
    $SQLS="SELECT COUNT (*) AS NBRE FROM T_PERIODE";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val14<br>\n";
    $Qtte_Totale_Periode[0]=$row->NBRE;                                     //Periode
  }
  $SQLS="SELECT COUNT (*) AS NBRE FROM T_APPAREIL";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val6 <font color=\"red\">$row->NBRE</font> $Val17<br>\n";
    $Qtte_Totale_App[0]=$row->NBRE;                                      //appareil
  }
  echo "<H2>$Val15</H2>\n";
  $SQLS="SELECT SUM(t_item.PRIX_ACHAT) AS NBRE FROM t_item";
  $query=requete_base($SQLS,$connecter,$BaseType);
  if (!$query)
  {
     echo "<br>$Erreur<br>";
     echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
     echo "SQLS = $SQLS .";
     die("$DBPb");
  }
   while ($row=get_Objet($query,$BaseType))
  {
    echo "$Val16 <font color=\"red\">$row->NBRE</font> euros</p>\n";
  }
//Affichage des tableaux
  echo "<H2><u>$Val3 :</u></H2>\n";
  $SQLS_Tab[0]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_materiel.nom_mat AS DESIGNATION FROM t_item INNER JOIN t_materiel ON t_item.fk_mat=t_materiel.pk_tmat GROUP BY t_materiel.nom_mat"; //Appareils
  $SQLS_Tab[1]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_appareil.nom_tapp AS DESIGNATION FROM t_item INNER JOIN t_appareil ON t_item.fk_app=t_appareil.pk_appareil GROUP BY t_appareil.nom_tapp"; //Catégories
  $SQLS_Tab[2]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_format.nom_format AS DESIGNATION FROM t_item INNER JOIN t_format ON t_item.fk_format=t_format.pk_format GROUP BY t_format.nom_format"; //Formats
  $SQLS_Tab[3]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_monture.nom_monture AS DESIGNATION FROM t_item INNER JOIN t_monture ON t_item.fk_monture=t_monture.pk_monture GROUP BY t_monture.nom_monture"; //Objectifs
  $SQLS_Tab[4]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_obturateur.nom_obtu AS DESIGNATION FROM t_item INNER JOIN t_obturateur ON t_item.fk_obtu=t_obturateur.pk_obtu GROUP BY t_obturateur.nom_obtu"; //Obturateurs
  $SQLS_Tab[5]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_marque.nom_marque AS DESIGNATION FROM t_item INNER JOIN t_marque ON t_item.fk_marque=t_marque.pk_marque GROUP BY t_marque.nom_marque"; //Marques
  $SQLS_Tab[6]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_film.nom_film AS DESIGNATION FROM t_item INNER JOIN t_film ON t_item.fk_film=t_film.pk_film GROUP BY t_film.nom_film"; //Type de film
  $SQLS_Tab[7]="SELECT COUNT(T_ITEM.nom_item) AS NBRE, t_periode.nom_periode AS DESIGNATION FROM t_item INNER JOIN t_periode ON t_item.fk_periode=t_periode.pk_periode GROUP BY t_periode.nom_periode"; //Periode
  for ($i=0;$i<8;$i++)
  {
    echo "<p><u>$ParBy $TitreTab[$i] :</u></p>\n";
    echo "<Table border=\"1\" bgcolor=\"white\"><TR><TD align=\"center\">$Val4</TD><TD align=\"center\">$Val5</TD></TR>";
    $SQLS=$SQLS_Tab[$i];
    $query=requete_base($SQLS,$connecter,$BaseType);
    if (!$query)
    {
       echo "<br>$Erreur<br>";
       echo "<p>$Erreur N° ".mysql_errno()." : ".mysql_error()."<br>\n";
       echo "SQLS = $SQLS .";
       die("$DBPb");
    }
    while ($row=get_Objet($query,$BaseType))
    {
      echo "<TR><TD align=\"center\">$row->DESIGNATION</TD><TD align=\"center\">$row->NBRE</TD></TR>\n";
    }
    echo "</TABLE>\n";
  }
  //Fin du script
  include "../include/footer.php";
?>